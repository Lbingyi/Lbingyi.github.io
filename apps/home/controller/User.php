<?php
namespace app\home\controller;
use think\Session;
use think\Controller;
use think\Db;


class User extends Base
{
    public function index()
    {        
        $user=Db::name('member')->field('uid,name,email,createtime')->where('uid',Session('user.user_id'))->find();
        $user['expire_time']=Db::name('user_app')->where('uid',$user['uid'])->where('appid',1)->limit(1)->value('expire_time');
        $user['createtime'] = date('Y-m-d H:i:s', $user['createtime']);
        if($user['expire_time']){
			$user['expire_time']=date('Y-m-d H:i:s', $user['expire_time']);
        }else{
        	$user['expire_time']='您尚未开通会员';
        }
        $this -> assign('userinof', $user);	
        return $this->fetch();
    }
    
}

