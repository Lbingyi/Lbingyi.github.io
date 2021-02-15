<?php
namespace app\user\admin;


class Menu {
	/**
    * @cc 菜单栏
    *    
    */
	public function menu() 
	{
		$menu=[
		    ['id'=>600,'type'=>'user','sort'=>20,'name'=>'用户','url'=>'','parent_id'=>0,'icon'=>'fa fa-user','status'=>1,'class'=>''],		    
		    ['id'=>610,'sort'=>10,'name'=>'用户管理','url'=>'admin/User/index','parent_id'=>600,'icon'=>'fa fa-user-o','status'=>1,'class'=>''],
		    ['id'=>620,'sort'=>20,'name'=>'角色管理','url'=>'admin/Role/index','parent_id'=>600,'icon'=>'fa fa-users','status'=>1,'class'=>''],
		    ['id'=>630,'sort'=>30,'name'=>'权限控制','url'=>'admin/AuthRule/index','parent_id'=>600,'icon'=>'fa fa-th','status'=>1,'class'=>''],		    			
		];	
        return $menu;
	}

}	