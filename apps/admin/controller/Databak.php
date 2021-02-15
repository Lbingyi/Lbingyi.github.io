<?php
namespace app\admin\controller;
use think\Session;
use think\Controller;
use think\Db;
use org;
use think\Request;
use think\Cache;

class Databak extends Base {

	/**
    * @cc 备份数据库
    *    
    */
    public function index(){
        $type=input("tp");
        $name=input("name");
        $sql=new \org\Baksql(\think\Config::get("database"));
        switch ($type)
        {
            case "backup": //备份
                return $sql->backup();
                break;  
            case "dowonload": //下载
                $sql->downloadFile($name);
                break;  
            case "restore": //还原
                return $sql->restore($name);
                break; 
            case "del": //删除
                return $sql->delfilename($name);
                break;          
            default: //获取备份文件列表
            return $this->fetch("",["list"=>$sql->get_filelist()]); 
          
        }
        
    }
	/**
    * @cc 数据库备份列表
    *    
    */
    public function baklist(){
    	$sql=new \org\Baksql(\think\Config::get("database"));
    	$bakfilelist=$sql->get_filelist();
		$jsondata=json($bakfilelist);	
		return $jsondata;   	   	
    }

	

}
