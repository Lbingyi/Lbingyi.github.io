<?php
namespace app\admin\controller;
use think\Session;
use think\Controller;
use think\Db;
use think\Config;
use think\Request;
use think\Cache;

class Module extends Base {

	/**
    * @cc 模块管理
    *    
    */
    public function index(){

        return $this->fetch(); 
          

    }
	/**
    * @cc 模块例表
    *    
    */
    
    public function lists(){
    	$name=[];
		foreach(glob(APP_PATH.'*/info.php') as $module_info){
			// 格式化路径信息
            $info = pathinfo($module_info);
			// 获取模块目录名
            $name = pathinfo($info['dirname'], PATHINFO_FILENAME);
			$resconfig[]=Config::load($module_info,$name.'_module');
		}
		//var_dump($con);	
		return $resconfig;   	   	
    }


}
