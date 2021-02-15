<?php
namespace app\admin\controller;
use think\Session;
use think\Controller;
use think\Db;
use think\Request;

class Email extends Base {
	/**
    * @cc 邮件设置
    *    
    */
	public function index() {
		
		return $this->fetch();
	}
	/**
    * @cc 邮件设置保存
    *    
    */
	public function update(){
		if (Request::instance()->isAjax()){
		    $host=input('post.email_host');
			$port=input('post.email_port/d');
			$username=input('post.email_username');
			$password=input('post.email_password');
			$replyemail=input('post.email_replyemail');
			$replyuser=input('post.email_replyuser');			
			$file=APP_PATH.'extra/email.php';
			update_config($file, 'host', $host);
			update_config($file, 'port', $port,$type='int');			
			update_config($file, 'username', $username);
			update_config($file, 'password', $password);
			update_config($file, 'replyemail', $replyemail);
			update_config($file, 'replyuser', $replyuser);
			
			return '更新成功！';
		}
	}
   
}	