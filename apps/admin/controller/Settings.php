<?php
namespace app\admin\controller;
use think\Session;
use think\Controller;
use think\Db;
use org;
use think\Request;
use think\Cache;

class Settings extends Base {
	/**
    * @cc 网站设置
    *    
    */
	public function index() {
		
		return $this -> fetch();


	}
	/**
    * @cc 保存网站设置
    *    
    */
	public function update(Request $request){
		if(Request::instance()->isAjax()){
			$updata=$request->param();
			$gconfig=APP_PATH.'config.php';			
			update_config($gconfig, 'app_debug', $updata['app_debug'],$type='int');
							
		    $file=APP_PATH.'extra/global_config.php';
		    update_config($file, 'site_status', $updata['site_status'],$type='int');
		    update_config($file, 'site_name', $updata['site_name']);
		    update_config($file, 'site_keyword', $updata['site_keyword']);
		    update_config($file, 'site_description', $updata['site_description']);
		    update_config($file, 'site_copyright', $updata['site_copyright']);
		    update_config($file, 'site_record', $updata['site_record']);
			update_config($file, 'site_key', $updata['site_key']);
			if(!$updata['site_key_expiry']) $updata['site_key_expiry'] = 0;
		    if(!$updata['register_time']) $updata['register_time'] = 0;
			if(!$updata['register_num']) $updata['register_num'] = 0;
			if(!$updata['register_black_count']) $updata['register_black_count'] = 0;
			if(!$updata['email_repwb_time']) $updata['email_repwb_time'] = 0;
			if(!$updata['email_repwb_num']) $updata['email_repwb_num'] = 0;
			if(!$updata['email_repwb_black_count']) $updata['email_repwb_black_count'] = 0;
			update_config($file, 'site_key_expiry', $updata['site_key_expiry'],$type='int');
		    update_config($file, 'register_time',  $updata['register_time'],$type='int');
		    update_config($file, 'register_num', $updata['register_num'],$type='int');
		    update_config($file, 'register_black_count', $updata['register_black_count'],$type='int');
		    update_config($file, 'email_repwb_time', $updata['email_repwb_time'],$type='int');
		    update_config($file, 'email_repwb_num', $updata['email_repwb_num'],$type='int');
		    update_config($file, 'email_repwb_black_count', $updata['email_repwb_black_count'],$type='int');           
		    return '修改成功!';
						
		}
	}

}
