<?php
namespace app\admin\controller;
use think\Session;
use think\Controller;
use think\Db;
use think\Config;
use think\Request;
use think\Cache;

class Plug extends Base {

	/**
    * @cc 插件管理
    *    
    */
    public function index(){
        
        return $this->fetch(); 
          

    }
	/**
    * @cc 插件列表
    *    
    */
    
    public function lists(){
    	$name=[];
		foreach(glob(ADDON_PATH.'*/*.php') as $plug_info){
			// 格式化路径信息
            $info = pathinfo($plug_info);
			if($info['basename'] !== 'config.php'){
			    //echo '<pre>';			
                $filename=$info['filename'];
			    // 获取模块目录名
                $name = pathinfo($info['dirname'], PATHINFO_FILENAME);
			//var_dump($info);
			    $class="\\addons\\$name\\$filename";
		        $action=new $class;
				$action->info['install_status']=TRUE;
				if(method_exists($action,'isinstall')){
					$action->info['install_status']=$action->isinstall();
				}
				
			    $resconfig[]=$action->info;
				
				
			}

		}

		//var_dump($con);	
		return $resconfig;   	   	
    }
	public function installAddon(){
		$name=input('get.name');
		$dirname=strtolower($name);
    	$class="\\addons\\$dirname\\$name";
		$action=new $class;
		$res =$action->install();
		if($res){
			return '安装完成';
		}
		return '安装失败';
		//var_dump($con);	
		   	   	
    }


}
