<?php
namespace app\app\admin;


class Menu {
	/**
    * @cc 菜单栏
    *    
    */
	public function menu() 
	{
		$menu=[
		    ['id'=>300,'type'=>'app','sort'=>7,'name'=>'应用(APP)','url'=>'','parent_id'=>0,'icon'=>'fa fa-app','status'=>1,'class'=>''],		    
		    ['id'=>310,'sort'=>10,'name'=>'应用管理','url'=>'admin/App/index','parent_id'=>300,'icon'=>'fa fa-paper-plane-o','status'=>1,'class'=>''],
		    ['id'=>320,'sort'=>20,'name'=>'授权码','url'=>'admin/AuthCode/index','parent_id'=>300,'icon'=>'fa fa-key','status'=>1,'class'=>''],
		   // ['id'=>322,'sort'=>22,'name'=>'设备认证','url'=>'admin/MacCode/index','parent_id'=>300,'icon'=>'fa fa-bluetooth-b','status'=>1,'class'=>''],
		    ['id'=>325,'sort'=>25,'name'=>'卡类管理','url'=>'admin/RechargeCard/type','parent_id'=>300,'icon'=>'fa fa-share-alt','status'=>1,'class'=>''],
		    ['id'=>330,'sort'=>30,'name'=>'充值卡','url'=>'admin/RechargeCard/index','parent_id'=>300,'icon'=>'fa fa-credit-card','status'=>1,'class'=>''],
		    ['id'=>340,'sort'=>40,'name'=>'应用销售','url'=>'admin/AppGoods/index','parent_id'=>300,'icon'=>'fa fa-shopping-cart','status'=>1,'class'=>''],		    			
		];	
        return $menu;
	}

}	