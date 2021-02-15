<?php
namespace app\user\admin;
use think\Controller;
use think\Db;
use think\Request;
use think\auth\Auth;
use \app\admin\controller\Base;
use \app\user\model\User as Users;


class User extends Base {
	/**
    * @cc 用户管理
    *    
    */
	public function index() {
		return $this -> fetch();
	}
	/**
    * @cc 添加用户
    *    
    */
    public function add(){
    	return $this -> fetch();
    }
    /**
    * @cc 确认添加用户
    *    
    */
    public function inAdd(){
    	$request = Request::instance();
    	$data    = $request->param();        
		$data['create_ip']  = $request->ip();
		$user    = new Users();
        $result  = $user->register($data);
        return $result;    			   	
    }
	/**
    * @cc 编辑用户
    *    
    */
    public function edit(){
    	if(input('?get.id') && input('get.id')){//修改用户密码		
		    $uid=input('get.id');
		    if($uid!=1){
			    $userdb=Db::name('member')->where('uid',$uid)->find();
			    $groupinfo = Db::name('auth_group') -> where('status',1)->where('id','>',1) -> select();
				$auth = new Auth();
			    $user_group=$auth->getGroups($uid);//取用户所在组

			    $this -> assign('userdb', $userdb);
			    $this -> assign('uid', $uid);
			    $this -> assign('groupinfo', $groupinfo);
				if($user_group){
				    $this -> assign('usergroup', $user_group[0]['title']);	
				}else{
					$this -> assign('usergroup', '普通用户');
				}
			    
			    return $this -> fetch();
		    }
		}
    }
    /**
    * @cc 确认编辑用户
    *    
    */
    public function inEdit(){
    	if(input('?get.uid') && input('?get.password') && input('?get.passworden')){
    		$uid=input('get.uid');
			$password=input('get.password');
			$password2=input('get.passworden');
			$usergroup=input('get.usergroup');
			$comments=input('get.comments');	  			
    		if($password==$password2){
    			$username=Db::name('member')->where('uid',$uid)->value('name');
				if($username){
					Db::name('member')->where('uid',$uid)->setField('score',input('get.score'));
					Db::name('member')->where('uid',$uid)->setField('comments',$comments);
					if($password==null){						
    			        $username=Db::name('auth_group_access')->where('uid',$uid)->setField('group_id',$usergroup);
						return '修改成功！';
    		        }else{
    		        	$username=Db::name('member')->where('uid',$uid)->setField('password',md5($password));
					    $username=Db::name('auth_group_access')->where('uid',$uid)->setField('group_id',$usergroup);
						return '修改成功！';
    		        }
					
					
				}
				return '修改失败，用户不存在！';
    		}
			return '修改失败，确认密码不相同！';
			
    	}
		
    	
    }
    /**
    * @cc 启/停/删用户
    *    
    */
	public function set(){
		if(input('?post.userset')){
			$uid=input('post.uid');
			if(input('post.userset')=='stop' && $uid!=1){
				$username=Db::name('member')->where('uid',$uid)->value('name');
			    Db::name('member')->where('uid', $uid)->update(['status' => '0']);													
                return '用户  "'.$username.'"  已停用！';	
			}elseif(input('post.userset')=='start' && $uid!=1){
				$username=Db::name('member')->where('uid',$uid)->value('name');
			    Db::name('member')->where('uid', $uid)->update(['status' => '1']);													
	            return '用户  "'.$username.'"  已启用！';	
			}elseif(input('post.userset')=='dellist'){
				$arruser=input('post.data/a');
				$users=array();
				foreach($arruser as $k=>$v){
					$users[]=$arruser[$k]['uid'];
				}			
				Db::name('member')->where('uid','in',$users)->delete();
				return '删除成功！';
			}
			
		}

	}

	/**
    * @cc 用户列表
    *    
    */
	public function lists(){
		//取出用户加入列表
        $auth   = new Auth();
		$limit  = input('get.limit');
		$offset = input('get.offset');
		$search = input('get.search');
		$user   = new Users();
		$res_db= $user->userList($limit,$offset,$search);
	
									
		foreach($res_db['user_db'] as $key=>$val){
			$useruid=$res_db['user_db'][$key]['uid'];
			if($res_db['user_db'][$key]['createtime']){
				$res_db['user_db'][$key]['createtime']=timeTodate($res_db['user_db'][$key]['createtime']);
			}
			if($res_db['user_db'][$key]['logintime']){
				$res_db['user_db'][$key]['logintime']=timeTodate($res_db['user_db'][$key]['logintime']);
			}
			if($res_db['user_db'][$key]['lastlogintime']){
				$res_db['user_db'][$key]['lastlogintime']=timeTodate($res_db['user_db'][$key]['lastlogintime']);
			}
		    $userarray=$auth->getGroups($useruid);//取用户所在组
		    $usergroup='';
		    foreach($userarray as $k=>$v){
		    	$usergroup.=$userarray[$k]['title'].',';
		    	
            }							
			$res_db['user_db'][$key]['usergroup'] = $usergroup;		
            if($res_db['user_db'][$key]['status']==1){
                $res_db['user_db'][$key]['status']='<span style="color:#0099FF">启用</span>';                  	
            }else{
                $res_db['user_db'][$key]['status']='<span style="color:#CC0000">停用</span>';
            }															
		}
        $jsondata['total']=$res_db['count'];
				//$jsondata['page']=$page;
		$jsondata['rows']=$res_db['user_db'];
		return json($jsondata);
	}	
}
