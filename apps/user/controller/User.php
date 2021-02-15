<?php
namespace app\user\controller;

use think\Session;
use think\Controller;
use think\Request;
use think\Db;
use app\user\model\User as Users;

class User extends Controller
{
    
	public function _initialize() {
	    $request = Request::instance();				
		if(Session('user') && $request->action() != 'quit'){
			if(Session('user.user_id') == config('global_config.admin_id')){
				$this->redirect('admin/Index/index');
				exit;
			}
			$this->redirect('home/Index/index');			
			exit;            
		}
	}
	
    public function index()
    {        

        return $this->fetch();
    }
    public function login()
    {        

        return $this->fetch();
    }
    public function quit(){
		session(null);
    	return $this->redirect('home/Index/index');
    }

	public function inLogin(Users $user, $name, $password)
    {        	
        hook('linput',$this->request);
        if(request()->isAjax()){
        	$login_ip  = $this->request->ip();
			$login_time= time();	
            $result = $user->login($name, $password,$login_ip,$login_time);
            return $result;

		}
    }
    public function register()
    {
        return $this->fetch();
    }

    public function inRegister(Users $user)
    {
        	
        $data   = $this->request->param();
		$data['create_ip']  = $this->request->ip();
        $result = $user->register($data);
        return $result;
        
    }

    public function getUserInfo(Users $user, $uid)
    {
        $info = $user->info($uid);
        if ($info) {
            $this->assign('user', $info);
            return $this->fetch();
        } else {
            return '用户不存在';
        }
    }

    protected function getUserRole()
    {
        $uid  = Session::get('user.user_id');
        $user = User::get($uid);
        return $user->role();
    }
	
	public function passwordFind()
	{
		return $this->fetch();
	}
	
	
	public function inPasswordFind(Users $user, $email)
	{			
		$result = $user->passwordFind($email);
		if($result['code'] == 1){
			//var_dump($result['data']);			
            $ressend=$this->sendEmail($result['data']);			
			return $ressend;
		}
      
        return $result;

	}

	public function sendEmail($userinfo)
	{
		//var_dump($userinfo)	;      				
		if ($userinfo) {				
	    	$key = md5 ( $userinfo->username . '+' . $userinfo->password ); // MD5不可逆，验证$string中username，防止URL更改username
			$string = base64_encode ( $userinfo->username . '+' . $key ); // 加密，可解密
			$time = time ();
		    $code=md5 ( 'mytime'.$time );
     		// 生成URL			
		    $findpwd = URL('user/User/resetPassword','','',true) . '?key=' . $key . '&info=' . $string . '&time='.$time.'&code=' .$code; // code是用来检验time是否有修改过
		    $username = $userinfo ->username;
		    $title="找回密码";		
		    $content="<h3>亲爱的：$username 用户</h3>
		    <br><br>通过以下链接找回您的密码
		    <br><br>$findpwd 
		    <br><br><br><h4>有效期30分钟</h4>
		    <br><br>";			
		    //$from=config('emailcon.replyemali'); //修改为你的发送邮箱
		    $to=$userinfo->email;
			$sendmail=new \app\common\controller\Fn(); 			
		    $sendstatus = $sendmail->sendMail ($to,$username,$title,$content );
			//var_dump($to);
		    if($sendstatus == 1){
		    	$res=['code'=>1,'message'=>'success','content'=>'密码重置邮件发送成功'];
			    return json($res);
		    }else{
			    $res=['code'=>40022,'message'=>'error','content'=>'邮件发送失败，请联系管理员'];
			    return json($res);			    
		    }
		} else {
		    $res=['code'=>40023,'message'=>'error','content'=>'邮件发送失败，邮箱不正确'];
			return json($res);
	    }			
    }
    //用户重置密码地址
    public function resetPassword(){    	
		session('key',input('get.key'));
		session('info',input('get.info'));
		session('code',input('get.code'));
		session('time',input('get.time'));					
		return $this->fetch ();
    }
	//用户重置密码
	public function inResetPassword(){
		$str = base64_decode (session('info'));
		$arr = explode ( '+', $str );
		$user ['name'] = $arr [0];
		$reinfo = Db::name ('member')->where ($user)->find ();		
		// 判断是否在有效期，这里用时间戳判断，还可以用SESSION有效期判断,这里设置为30分钟
		$retime = time ();
		if ((session('code') == md5 ( 'mytime' . session('time'))) && (((session('time')) + (60 * 30)) >= $retime)) {			
			if (md5 ( $reinfo ['username'] . '+' . $reinfo ['password'] ) == session('key')) { // 判断URL传输中username是否更改				
				$upid ['id'] = $reinfo ['uid'];								
				if (input('post.password') == input('post.passworden') && input('post.password') != '') {
					
					$data = ['password'=>md5 ( trim ( $_POST ['password'] ))];
					$edit = Db::name ( 'member' )->where ('uid',$upid ['id'])->update ($data);
					if ($edit) {						
						session(null);
						$res=['code'=>1,'message'=>'success','content'=>'密码重置成功'];
				        return json($res);
					} else {
						$res=['code'=>40024,'message'=>'error','content'=>'重置失败,用户不存在'];
				        return json($res);
					}
				} else {
					$res=['code'=>40025,'message'=>'error','content'=>'两次输入不相同'];
				    return json($res);
				}
			} else {
				$res=['code'=>40026,'message'=>'error','content'=>'无效链接地址'];
				return json($res);
			}
		} else {			
			// session_destroy();
			$res=['code'=>40027,'message'=>'error','content'=>'链接地址已失效'];
			return json($res);
		}
	}
}

