<?php
namespace app\home\controller;
use think\Session;
use think\Controller;
use think\Db;
use think\View;
use app\common\controller\Payfn;
use think\Request;

class Index extends Base {
	public function index() {      		
		$goods = Db::name('goods') -> where('status', 1) -> order('count desc') -> limit(8) -> select();
		foreach ($goods as $key => $val) {
			$goods[$key]['appname'] = Db::name('app') -> where('appid', $goods[$key]['appid']) -> value('app_name');
			$s = ('t' . rand(1, 20) . '.png');
			$goods[$key]['simgs'] = $s;

		}
		$article=Db::name('article')->where('status',1)->order('id desc')->paginate(12);		
		$arrys=objectToarray($article);				
		foreach($arrys as $key=>$val){
			$s = ('t' . rand(1, 20) . '.png');
			$arrys[$key]['simgs'] = $s;
			$arrys[$key]['urls']=URL('home/Article/index',['id'=>$article[$key]['id']]);
			$arrys[$key]['sort_name']=$this->getsort($arrys[$key]['id'])['sort_name'];
			$arrys[$key]['sort_url']=$this->getsort($arrys[$key]['id'])['menu_url'];			
			$arrys[$key]['add_time']=timeTodate($arrys[$key]['add_time']);			
		}
		$this->assign('arrys',$arrys);			
		$this->assign('article',$article);      
		$this -> assign('goods', $goods);
		//echo '<pre>';
		//var_dump($arrys);
		$seo=[
		    'title'=>config('global_config.site_name'),
		    'keywords'=>config('global_config.site_keyword'),
		    'description'=>config('global_config.site_description'),
		];
		$this -> assign('seo', $seo);
		return $this -> fetch();
	}
	private function getsort($articleid){
		$sortid=Db::name('article_relation')->where('article_id',$articleid)->value('sort_id');
		$res=Db::name('sort')->where('id',$sortid)->find();
		if(!$res){
			$res['sort_name']='未分类';
		    $res['id']=1;
		}	
		$res['menu_url']=URL('home/Article/sorts',['id'=>$sortid]);			
		return $res;
		
	}

    public function test(){
         $res=Db::name('addon_appfn_user')->where('use_id',1)->where('fn_id',1)->value('fn_data');
		 return '';
    }

}
