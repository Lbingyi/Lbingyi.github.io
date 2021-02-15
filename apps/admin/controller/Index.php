<?php
namespace app\admin\controller;

use think\Session;
use think\Controller;
use think\Db;
use think\Request;
use org\File;
use org\PclZip;

class index extends Base {
	/**
    * @cc 管理首页
    *    
    */
	public function index() {
		
       	//$version = $this->checkVersion();
		
		//$this->update($version);
		//var_dump($version);					
        return $this -> fetch();		
		
	}
 
	/**
    * @cc 管理员修改密码页
    *    
    */
	public function myEdit() {
		$loginuserdb=Db::name('member')->where('uid',session('user.user_id'))->find();
		return $this -> fetch();		
	}
	/**
    * @cc 管理员确认修改密码
    *    
    */
	public function inMyEdit() {
        if(input('post.password') == null) return '原密码不能为空';
        if(input('post.newpassword') == null) return '新密码不能为空';
        if(input('post.newpassworden') == null) return '再次输入密码不能为空';
        if(input('post.newpassword') != input('post.newpassworden')) return '二次密码输入不相同！';
        $pwd=md5(input('post.password'));
		if($pwd != session('password')) return '原密码不正确';
		$uloginid=Session::get('uid');
		$newpwd=md5(input('post.newpassword'));
		Db::name('member')->where('uid',$uloginid)->update(['password'=>$newpwd,'email'=>input('post.email')]);
		session('password',$newpwd);
		return '修改成功!';
			
       
	}
	
}
