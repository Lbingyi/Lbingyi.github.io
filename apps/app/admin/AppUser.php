<?php
namespace app\app\admin;
use think\Session;
use think\Controller;
use think\Db;
use app\admin\controller\Base;

class AppUser extends Base {
	/**
     * @cc 应用用户管理
     *    
     */
	public function index() {
			        
		
		$appdb=Db::name('app')->where('appid',input('get.appid'))->find();
		$this->assign('appid',input('get.appid'));
		$this->assign('appdb',$appdb);
		return $this -> fetch();
	}
    /**
     * @cc 应用用户列表
     *    
     */
    public function lists() {
		$appuserlist = Db::name('user_app')-> where('appid',input('get.appid')) -> select();				
	    foreach ($appuserlist as $key => $val) {
	    	$appuserlist[$key]['user']=Db::name('member')->where('uid',$appuserlist[$key]['uid'])->value('name');
			
		    if (!empty($appuserlist[$key]['active_time'])) {
			    $appuserlist[$key]['active_time'] = date('Y-m-d H:i:s', $appuserlist[$key]['active_time']);
						//格式化时间
		    }
			if($appuserlist[$key]['bind'] == 1){
				$appuserlist[$key]['bind']='IP';
			}elseif($appuserlist[$key]['bind'] == 2){
				$appuserlist[$key]['bind'] = '机器码';
			}elseif($appuserlist[$key]['bind'] == 3){
				$appuserlist[$key]['bind'] = 'IP+机器码';
			}else{
				$appuserlist[$key]['bind'] = '不绑定';
			}
		    if (!empty($appuserlist[$key]['expire_time'])) {
			    $appuserlist[$key]['expire_time'] = date('Y-m-d H:i:s', $val['expire_time']);
						//格式化时间
		    }

		    if ($appuserlist[$key]['status'] == 1) {
			    $appuserlist[$key]['status'] = '<span style="color:#0099FF">已启用</span>';
		    } else {
			    $appuserlist[$key]['status'] = '<span style="color:#CC0000">已停用</span>';
		    }
	    }
	    $jsonsoft = json($appuserlist);
	    return $jsonsoft;			

	} 


    /**
     * @cc 用户应用启停删
     *    
     */
    public function set(){
    	if(input('?get.appop')){
    		$where=['uid'=>input('get.uid'),'appid'=>input('get.appid')];
			$appid=input('get.appid');
			if(input('get.appop')=='stop'){
				Db::name('user_app') -> where($where)-> setField('status',0);
				return '禁用成功！';
            }elseif(input('get.appop')=='start'){
               	Db::name('user_app') -> where($where)-> setField('status',1);
			    return '启用成功！';              	
            }elseif(input('get.appop')=='del'){
               	Db::name('user_app') -> where($where)-> delete();							
				return '删除成功';
            }			
			
		}
    }
	/**
    * @cc 编辑用户应用信息
    *    
    */
    public function edit(){
    	if(input('?get.set') && input('get.set')=='appedit'){
    		$bindcount=input('get.bind_count');
    		
			if(input('get.expire_time') < 1){
				$getdata['expire_time']=0;
			}else{
				$expiretime=input('get.expire_time');
			    $getdata['expire_time']=strtotime($expiretime);	
			}    		
			$getdata['status']=input('get.status');
			$getdata['bind']=input('get.bind');
			$getdata['user_data']=input('get.user_data');
			DB::name('user_app')->where('uid',input('get.uid'))->where('appid',input('get.appid'))->update($getdata);
			return '修改成功!';
			
    	}
    	if(input('?get.uid') && input('?get.appid')){
    		$uid=input('get.uid');
			$appid=input('get.appid');
			$username=DB::name('member')->where('uid',$uid)->value('name');
			$appname=DB::name('app')->where('appid',$appid)->value('app_name');
    	    if($username && $appname){
    	    	$this->assign('username',$username);
    		    $this->assign('uid',$uid);
			    $this->assign('appid',$appid);
				$this->assign('app_name',$appname);
    	    	$resapp=Db::name('user_app')->where('uid',$uid)->where('appid',$appid)->find();
				$activetime='未激活';
				if($resapp['active_time']){
					$activetime=date('Y-m-d H:i',$resapp['active_time']);
				}
				
				if($resapp['expire_time'] < 1){
					$expiretime=0;
				}else{
				    $expiretime=date('Y-m-d H:i',$resapp['expire_time']);	
				}

				$this->assign('resapp',$resapp);
				$this->assign('activetime',$activetime);						
			    $this->assign('expiretime',$expiretime);
			    return $this->fetch();
    	    }
			return 'error';
			
    	}elseif(input('?get.sid') && input('?get.uid')){
    		$sid=input('get.sid');
			$uid=input('get.uid');
			$exptime = strtotime(input('get.exptime'));
			Db::name('user_soft')->where('uid', $uid)->where('sid', $sid)->update(['expire_time' => $exptime]);
			return '修改成功';
    		
    	}else{
    		return '错误，请重试！';
    	}
    }
	

}
