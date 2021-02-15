<?php
namespace app\admin\controller;
use think\Session;
use think\Controller;
use think\Db;
use think\Request;
use think\auth\Auth;
use app\common\controller\Fn;

class Base extends controller {
	
	public function _initialize() {
		$request = Request::instance();
		if(is_login()==FALSE){//是否登录
			$this->redirect('home/Login/index');//跳转到登录页
		}		
		$fn      = new fn;
		
		$node    = $fn->getNode();
		$Controller  = $fn->getController();

		$auth    = new Auth();
		$auths   = $auth -> check(strtolower($node), Session('user.user_id'));		
		if(Session('user.user_id') == config('global_config.admin_id')){
			$auths=TRUE;
		}else{
			
		}
		//$auths==FALSE;
		if($auths==FALSE){
			if (Request::instance()->isAjax()){
				echo '没有权限！';
				exit;
			}else{
				$this->error('没有访问权限');
			    exit;
			}
		}
		$menu=new Menu();
		$menu=$menu->menu();
		$parent_id='';
		//echo '<pre>';
		//var_dump($menu);
		foreach($menu as $key=>$val){
			if($menu[$key]['url'] == $node){				
				$menu[$key]['class']='active';
				$parent_id=$menu[$key]['parent_id'];
			}
			//echo $menu[$key]['url'].'='.$Controller.'<br>';
			if(false !== strpos($menu[$key]['url'],$Controller)){
				$parent_id=$menu[$key]['parent_id'];
			}
		}

		$this->assign('parent_id',$parent_id);
		$this->assign('menu',$menu);
	}

}
