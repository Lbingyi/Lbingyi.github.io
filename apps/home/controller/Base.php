<?php
namespace app\home\controller;
use think\Session;
use think\Controller;
use think\Db;
use think\Request;
use think\auth\Auth;

class Base extends controller {
	public function __construct ()
	{
		parent::__construct();
		$request = Request::instance();  
    	$module=$request->module();//当前模块名
        $controller=$request->controller();//当前控制器
    	$aabb = Db::name('user_menu')->where('controller',$module.'/'.$controller)->value('name');
	    if($aabb){
	      $this->assign('seo',['title'=>$aabb,'keywords'=>'','description'=>'']);
	    }
	}
	public function _initialize() {
		if (!is_file(APP_PATH . 'install/data/install.lock')) {
			$installurl=URL('install/Index/index');
            echo "<script language='javascript' type='text/javascript'>";  
            echo "window.location.href='".$installurl."'";  
            echo "</script>";
	        exit;	   
        }
        $request = Request::instance();		
	    $root=$request->root();//程序目录
		$module=$request->module();//当前模块名
        $controller=$request->controller();//当前控制器
		$action=$request->action();//当前操作名
		$vurls=$module.'/'.$controller;
		$vurl=$module.'/'.$controller.'/'.$action;
		$theme=config('theme');
		
		
		$banner=Db::name('page_index')->where('name','banner')->find();
		$service=Db::name('page_index')->where('name','service')->find();
		$footer=Db::name('page_index')->where('name','footer')->find();
		$indexdb=['banner'=>$banner,'service'=>$service,'footer'=>$footer];
		$this->assign('indexdb',$indexdb);
		
		
		$this->view->config('view_path',config('template.view_path').$theme.'/');
		$netcon=config('global_config');
		$this -> assign('netcon', $netcon);
		
		if($vurl === 'home/Login/index' || $vurl === 'home/Login/login' || $vurl === 'home/Login/vals'){
			
		}else{
			if($netcon['site_status'] != 1){
			    $loginurl=URL('home/Login/index');
			    echo "<script type=\"text/javascript\">window.location.href='".$loginurl."';</script>";
			    exit;
			}
		}
				
		
		
		$myurl=$request->URL(true);
		$this -> assign('myurl', $myurl);
		$seo=[
		        'title'=>'',
		        'keywords'=>'',
		        'description'=>'',
		    ];	
		$this -> assign('seo', $seo);	      
		if($this->loginurl($vurls)){
			$loginurl=URL('home/Login/index');
			echo "<script type=\"text/javascript\">window.location.href='".$loginurl."';</script>";
			exit;
		}				
		$loginuid=Session('uid');
		$scores='';
		if($loginuid){
			$userfn=new \app\common\controller\UserFn();			
			$scorename=$userfn->tradeType();
			if($scorename){
				$score=$userfn->getScore($loginuid);
				$score=ceil($score);
				$scores=$scorename.':'.$score;
			}
		    
		}
		$fns=new \app\common\controller\Fn();		
		$newarticle=$fns->newarticle(10);
		
		foreach($newarticle as $key=>$val){
			
			$sorts=$this->getsort($newarticle[$key]['id']);			
			$s = ('t' . rand(1, 20) . '.png');
			$newarticle[$key]['simgs'] = $s;
			$newarticle[$key]['urls']=URL('home/Article/index',['id'=>$newarticle[$key]['id']]);
			if($sorts){
				$newarticle[$key]['sort']=$sorts['sort_name'];
				$newarticle[$key]['sort_id']=$sorts['id'];
				$newarticle[$key]['menu_url']=$sorts['menu_url'];
			}else{
				$newarticle[$key]['sort']='未分类';
				$newarticle[$key]['sort_id']=1;
			}
			
			$newarticle[$key]['add_time']=timeTodate($newarticle[$key]['add_time']);		
		}
		$this->assign('newarticle',$newarticle);
		$this->assign('scores',$scores);		
		$auth = new Auth();		
		//$res=$this->authCheck($authName, $uid);
		$loginuser = Session::get('user.name');
		$loginuid = Session::get('user.user_id');
				
		$this -> assign('loginuser', $loginuser);
		$this -> assign('loginuid', $loginuid);
		$body='page-theme';
		if($controller=='Index'){
			$body='page-home';
		}
		if($controller=='GoodsList'){
			$body='page-theme';
		}
		if($controller=='Goods'){
			$body='page-theme-item';
		}
		if($controller=='Register'){
			$body='page-register';
		}
		if($controller=='Login'){
			$body='page-login';
		}
		if($vurls=='index/Article/index'){
			$body='page-post';
		}
        $fn=new \app\common\controller\Fn();
		$menu=$fn->getMenu();
		$this -> assign('menu', $menu);
		$menuname = Db::name('user_menu') -> where('controller', '/'.$module.'/'.$controller) -> value('name');		
		$this -> assign('menuname', $menuname);
		$menu1 = Db::name('user_menu') -> where('group',1)-> order('sort asc')->select();
		$menu2 = Db::name('user_menu') -> where('group',2)-> order('sort asc')->select();
		$newar=Db::name('article')->where('status',1)->select();				
		$this -> assign('menu1', $menu1);
		$this -> assign('menu2', $menu2);						
        $this -> assign('body', $body);
		$cservice=config('global_config.site_cservice');
		$comment=config('comment');
		if(!$comment){
			$comment['name']='';
			$comment['status']='0';
		}
		$this->assign('comment',$comment);		
		$this -> assign('cservice', $cservice);
		
		$agenturl=null;
		$agenttitle=null;
		$files=glob(APP_PATH.'agents/admin/Agents.php');		
		if($files){
			$agetndb=Db::name('agents')->where('uid',session('user.user_id'))->find();
			$agenttitle='我要代理';
			if($agetndb){
				$agenttitle='代理入口';
			}
			$agenturl=URL('agents/Index/index');
			
		}
		
		$this->assign('agenttitle',$agenttitle);
        $this->assign('agenturl',$agenturl);
	}

	public function authCheck($authName, $uid) {
		$auth = new Auth();
		if ($auth -> check(strtolower($authName), $uid)) {
			return true;
		} else {
			return false;
		}
	}
	
    public function loginurl($vurl) {
		if(!session('?user')){
			$arrdate = array(
			    'home/User',
			    'home/Repwd',
			    'home/UserGoods',
			    'home/Order',
			    'home/Goods',
			    'app/UserCard',
			    'app/UserAcard',
			);
		    return in_array($vurl,$arrdate);						
		}else{
			return FALSE;
		}
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
}
