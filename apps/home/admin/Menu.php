<?php
namespace app\home\admin;


class Menu {
	/**
    * @cc 菜单栏
    *    
    */
	public function menu() 
	{
		$menu=[
		    ['id'=>200,'type'=>'page','sort'=>3,'name'=>'页面','url'=>'','parent_id'=>0,'icon'=>'fa fa-user','status'=>1,'class'=>''],		    
		    ['id'=>210,'sort'=>10,'name'=>'网站内容','url'=>'admin/Home/index','parent_id'=>200,'icon'=>'fa fa-globe','status'=>1,'class'=>''],
		    ['id'=>220,'sort'=>20,'name'=>'页面管理','url'=>'admin/Page/index','parent_id'=>200,'icon'=>'fa fa-file-text-o','status'=>1,'class'=>''],
		    ['id'=>230,'sort'=>30,'name'=>'分类设置','url'=>'admin/Page/sorts','parent_id'=>200,'icon'=>'fa fa-paste','status'=>1,'class'=>''],
		    ['id'=>240,'sort'=>40,'name'=>'导航菜单','url'=>'admin/NavMenu/index','parent_id'=>200,'icon'=>'fa fa-navicon','status'=>1,'class'=>''],		    	
		];	
        return $menu;
	}

}	