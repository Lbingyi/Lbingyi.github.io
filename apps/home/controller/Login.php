<?php
namespace app\home\controller;
use think\Session;
use think\Controller;
use think\Db;
use think\Request;


class Login extends Base {
    public function index()
    {
    	
        return $this->fetch();
    }
    
    //退出登录
    public function quit(){
        $request = Request::instance();
		session(null);
    	return $this->fetch();
    }
    
    public function login() {
		$request = Request::instance();

		if(input('?post.username')){			
		    $name = input('post.username/s');
		    $password = md5(input('post.password/s'));
			
		    $userdb=Db::name('member')->where('name',$name)->where('password',$password)->find();
			if(!captcha_check(input('post.captcha'))){
                $res=['msg'=>'error','code'=>12];
            	return json($res);
            }
            if($userdb == null){
            	$res=['msg'=>'error','code'=>10];
            	return json($res);
            }
            
            if($userdb['status'] == 0){
        	    $res=['msg'=>'error','code'=>11];
            	return json($res);	    		    
		    }else{//登录成功设置session	
		        Session::set('user', ['user_id'=>$userdb['uid'],'name'=>$userdb['name'],'email'=>$userdb['email']]);	        										
				$data['logintime'] = time();//取登录时间
				$data['lastlogintime']=Db::name('member')->where('uid',$userdb['uid'])->value('logintime');//取上次登录时间
                $data['loginip'] = $_SERVER["REMOTE_ADDR"];//登录IP
				$data['lastloginip']=Db::name('member')->where('uid',$userdb['uid'])->value('loginip');//上次登录IP
				Db::name('member')->where('uid',$userdb['uid'])->update($data);//登录更新数据库
                Db::name('member')->where('uid', $userdb['uid'])->setInc('logincount');//等录次数加1
                if($userdb['uid'] != '1'){
                	$res=['msg'=>'success','code'=>2];
                	return json($res);               
                }
				
			    $res=['msg'=>'success','code'=>1];
                	return json($res);
		    }
		}else{
			$res=['msg'=>'error','code'=>0];
            	return json($res);	
		}		
	}

}