<?php
namespace app\user\model;

use think\Session;
use think\Model;

class User extends Model
{
	protected $name = 'member';
	//protected $autoWriteTimestamp = true;
	//protected $createTime = 'createtime';
    //protected $updateTime = 'updatetime';

	/**
     * 注册一个新用户
     * @param  array $data 用户注册信息
     * @return integer|bool  注册成功返回主键，注册失败-返回false
     */
    public function register($data = [])
    {
        if($data['password']){
        	$data['password']   = md5($data['password']);
			$data['passworden'] = md5($data['passworden']);
			$data['createtime'] = time();			
        }		
	    $resuser  = $this->where('name',$data['name'])->find();
		$resemail = $this->where('email',$data['email'])->find();
		if($resuser){
			return ['code'=>40008,'message'=>'error','content'=>'用户已存在'];
		}
		if($resemail){
			return ['code'=>40009,'message'=>'error','content'=>'邮箱已被使用'];
		}
        $result = $this->validate('User.register')->allowField(true)->save($data);		        
        if ($result) {
        	$auth=['uid',$this->uid,'group_id'=>3];
        	$this->inAuthGroupAccess($this->uid);
        	return ['code'=>1,'message'=>'success','content'=>'注册成功','data'=>$this];
        } 
		return $this->error;
    }

    /**
     * 用户登录认证
     * @param  string  $username 用户名
     * @param  string  $password 用户密码
     * @return integer 登录成功-用户ID，登录失败-返回0或-1
     */
    public function login($name, $password,$login_ip,$login_time)
    {
        $where['name'] = $name;
        $where['status']   = 1;
        /* 获取用户数据 */
        $user = $this->where($where)->find();
        if ($user) {
            if (md5($password) != $user->password) {
                return ['code'=>40010,'message'=>'error','content'=>'密码错误'];
            } else {
            	$save=['loginip'=>$login_ip,'logintime'=>$login_time];
            	$this->where($where)->setInc('logincount');
            	$this->where($where)->update($save);
            	Session::set('user', ['user_id'=>$user->uid,'name'=>$user->name,'email'=>$user->email]);
                return ['code'=>1,'message'=>'success','content'=>'登录成功','data'=>['name'=>$user->name,'user_id'=>$user->uid,'email'=>$user->email]];				
            }
        } else {
            return ['code'=>40011,'message'=>'error','content'=>'用户不存在或已禁用'];
        }
    }

    /**
     * 获取用户信息
     * @param  integer  $uid 用户主键
     * @return array|integer 成功返回数组，失败-返回-1
     */
    public function info($uid)
    {
        $user = $this->where('uid', $uid)->field('uid,name,email,status')->find();
        if ($user && 1 == $user->status) {
            // 返回用户数据
            return $user->hidden('status')->toArray();
        } else {
            $this->error = '用户不存在或被禁用';
            return ['code'=>40012,'message'=>'error','content'=>'用户不存在或已禁用'];;
        }
    }
	/**
	 * 邮箱找回密码
	 * @param email  $email 用户邮箱
	 * @return json
	 * */
    public function passwordFind($email)
    {
        $userinfo=$this->where('email',$email)->find();
		
		if ($userinfo && 1 == $userinfo->status) {
            // 返回用户数据
            return ['code'=>1,'message'=>'success','content'=>'成功','data'=>$userinfo];
        } else {
            $this->error = '用户不存在或被禁用';
            return ['code'=>40014,'message'=>'error','content'=>'不存在用户此邮箱'];
        }
    }
    /**
     * 获取用户角色
     * @return integer 返回角色信息或者返回-1
     */
    public function role()
    {
        $uid = $this->getData('id');
        if ($uid) {
            $role = $this->getUserRole($uid);
            if ($role) {
                return $role;
            } else {
                $this->error = '用户未授权';
                return 0;
            }
        } else {
            $this->error = '请先登录';
            return -1;
        }
    }

    protected function inAuthGroupAccess($uid)
    {
        return $this->name('auth_group_access')->insert(['uid'=>$uid,'group_id'=>3]);
    }
	
	/**
	 * 用户例表
	 * */
	public function userList($limit,$offset,$search){
		
		$count   = $this->where('uid','>',1)
		         ->where('name','like',$search.'%')
		         ->count();
		$user_db = $this->where('uid','>',1)
		         ->order('uid desc')
		         ->where('name','like',$search.'%')
		         ->limit($offset.','.$limit)
		         ->select();
		foreach($user_db as $key => $val){
			$user_db[$key]['login_time']=timeTodate($user_db[$key]['logintime']);
		}		 
		return $res_db=['count'=>$count,'user_db'=>$user_db];
	}
	
}
