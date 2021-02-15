<?php
namespace app\admin\controller;
use think\Session;
use think\Controller;
use think\Db;
use org;
use think\Request;
use think\Cache;

class AppCenter extends Base {
	/**
    * @cc 应用中心
    *    
    */
	public function index() {
		
		return $this -> fetch();


	}
	

}
