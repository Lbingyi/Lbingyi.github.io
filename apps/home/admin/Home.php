<?php
namespace app\home\admin;
use think\Session;
use think\Controller;
use think\Db;
use org;
use app\admin\controller\Base;

class Home extends Base {
	/**
     * @cc 首页管理
     *    
     */
	public function index() {
		
		$banner=Db::name('page_index')->where('name','banner')->find();
		$service=Db::name('page_index')->where('name','service')->find();
		$footer=Db::name('page_index')->where('name','footer')->find();
		$indexdb=['banner'=>$banner,'service'=>$service,'footer'=>$footer];
		$this->assign('indexdb',$indexdb);
		return $this -> fetch();
	}
	/**
     * @cc 保存首页管理
     *    
     */
	public function saves(){
		if(request()->isAjax()){
			Db::name('page_index')->where('name','banner')->update(['title'=>input('banner_title','',null),'content'=>input('banner_content','',null)]);
			Db::name('page_index')->where('name','service')->update(['title'=>input('service_title','',null),'content'=>input('service_content','',null),'url'=>input('service_url','',null)]);
			Db::name('page_index')->where('name','footer')->update(['content'=>input('footer_content','',null)]);
			return '保存成功';
		}
	}

}
