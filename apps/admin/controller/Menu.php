<?php
namespace app\admin\controller;
use think\Session;
use think\Controller;
use think\Db;
use think\Request;

class Menu extends controller{
	/**
    * @cc 读取菜单数据
    *    
    */
	public function menu() 
	{
			
		$menu=[
		    ['id'=>1,'type'=>'system','sort'=>1,'name'=>'系统','url'=>'','parent_id'=>0,'icon'=>'fa fa-gear','status'=>1,'class'=>''],		    
		    ['id'=>10,'sort'=>10,'name'=>'网站设置','url'=>'admin/Settings/index','parent_id'=>1,'icon'=>'fa fa-cog','status'=>1,'class'=>''],
		    ['id'=>20,'sort'=>20,'name'=>'数据备份','url'=>'admin/Databak/index','parent_id'=>1,'icon'=>'fa fa-database','status'=>1,'class'=>''],
		    ['id'=>30,'sort'=>30,'name'=>'邮箱设置','url'=>'admin/Email/index','parent_id'=>1,'icon'=>'fa fa-envelope','status'=>1,'class'=>''],	
		    ['id'=>40,'sort'=>40,'name'=>'积分设置','url'=>'admin/Score/index','parent_id'=>1,'icon'=>'fa fa-sheqel','status'=>1,'class'=>''],
		    ['id'=>50,'sort'=>50,'name'=>'支付设置','url'=>'admin/Pay/index','parent_id'=>1,'icon'=>'fa fa-paypal','status'=>1,'class'=>''],	
		    ['id'=>50,'sort'=>50,'name'=>'支付账单','url'=>'admin/Order/index','parent_id'=>1,'icon'=>'fa fa-jpy','status'=>1,'class'=>''],	    			
			['id'=>1000,'type'=>'extend','sort'=>1000,'name'=>'扩展','url'=>'','parent_id'=>0,'icon'=>'fa fa-cogs','status'=>1,'class'=>''],
			['id'=>1010,'sort'=>1010,'name'=>'应用中心','url'=>'admin/AppCenter/index','parent_id'=>1000,'icon'=>'fa fa-cloud-download','status'=>1,'class'=>''],
		    ['id'=>1020,'sort'=>1020,'name'=>'模块','url'=>'admin/Module/index','parent_id'=>1000,'icon'=>'fa fa-microchip','status'=>1,'class'=>''],
		    ['id'=>1030,'sort'=>1030,'name'=>'插件','url'=>'admin/Plug/index','parent_id'=>1000,'icon'=>'fa fa-plug','status'=>1,'class'=>''],
		    
		];
		$menum=array_merge($menu,$this->moduleMenu());//合并模块管理菜单
		$menus=array_merge($menum,$this->addonsMenu());
		//菜单按字段 sort 排序
		$sort = ['direction' => 'SORT_ASC','field' => 'sort',];
		$arrSort = [];  
		foreach($menus AS $uniqid => $row){
            foreach($row AS $key=>$value){
                $arrSort[$key][$uniqid] = $value;
            }
        }
		if($sort['direction']){
            array_multisort($arrSort[$sort['field']], constant($sort['direction']), $menus);
        }
		//	排序结束
        return $menus;
	}

    //取模块菜单
    private function moduleMenu(){
    	$menu=array();
		foreach(glob(APP_PATH.'*/info.php') as $module_info){
			// 格式化路径信息
            $info = pathinfo($module_info);
			// 获取模块目录名
            $name = pathinfo($info['dirname'], PATHINFO_FILENAME);
			// 实例化模块后台菜单
			$classname ="\\app\\$name\\admin\\Menu"; 
			if (class_exists($classname)) {
				$menus=new $classname;
			    //$menus=new \app\user\admin\Menu();
			    $menu=array_merge($menu,$menus->menu());
			}			
			
		}
		//var_dump($con);	
		return $menu;
    }
	//取插件后台菜单
	private function addonsMenu(){
    	$menu=array();
		foreach(glob(ADDON_PATH.'*/*.php') as $plug_info){
			// 格式化路径信息
            $info = pathinfo($plug_info);
			if($info['basename'] !== 'config.php'){
			    //echo '<pre>';			
                $filename=$info['filename'];
			    // 获取模块目录名
                $name = pathinfo($info['dirname'], PATHINFO_FILENAME);
			//var_dump($info);
			    $class="\\addons\\$name\\admin\\Menu";
				
			    if(class_exists($class)){
					$menus=new $class;
					$menu=array_merge($menu,$menus->menu());
				}

				
			}

		}
		//var_dump($con);	
		return $menu;

    }
}	