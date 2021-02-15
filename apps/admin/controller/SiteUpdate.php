<?php
// +----------------------------------------------------------------------
// | TwoThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016 http://www.twothink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 艺品网络
// +---------------------------------------------------------------------- 

namespace app\admin\controller;
use org\File;
use org\Zip;
use think\Request;

/**
 * 在线更新
 * @author rain  <rain68.com>
 */
class SiteUpdate extends Base{

	/**
	 *@cc 网站更新
	 * @author rain  <rain68.com>
	 */
	public function index(){ 
		$this->assign('meta_title','在线更新');
		if(request()->isPost()){
			echo $this->fetch();
			//检查新版本
			$version = $this->checkVersion();
			//在线更新
			$this->update($version);
		}else{
			return $this->fetch();
		}
	}

	/**
	 * 检查新版本
	 * @author rain  <rain68.com>
	 */
	private function checkVersion(){ 
		if(extension_loaded('curl')){
			$url = 'http://server.rain68.com/appapi/get_app/raincms';
			$params = array(
					'version' => config('rain.version'),
					'domain'  => $_SERVER['HTTP_HOST'],
					'auth'    => sha1(config('global_config.auth_key')),
			);
			$vars = http_build_query($params);   
			//获取版本数据
			$data = $this->getRemoteUrl($url, 'post', $vars);  
			if(!empty($data) && strlen($data)<400 ){
				$this->showMsg('发现新版本：'.$data, 'success');
				return $data;
			}else{
				$this->showMsg("未发现新版本", 'error');
				exit;
			}
		}else{
			$this->error('请配置支持curl');
		}
	}

	/**
	 * 在线更新
	 * @author 艺品网络  <twothink.cn>
	 */
	private function update($version){
		//PclZip类库不支持命名空间
		//echo $this->fetch();
        //$version='v2.2.1';
		$date  = date('YmdHis');
		$backupFile = input('post.backupfile');
		$backupDatabase = input('post.backupdatabase');
		sleep(1);

		$this->showMsg('当前版本:'.config('rain.version'));
		$this->showMsg('RainCms在线更新日志：');
		$this->showMsg('开始更新时间:'.date('Y-m-d H:i:s'));
		sleep(1);

		/* 建立更新文件夹 */
		$folder = 'public/'.$this->getUpdateFolder();  
		File::mk_dir($folder);
		$folder = $folder.'/'.$date;
		File::mk_dir($folder);

		//备份重要文件
		if($backupFile){
			$this->showMsg('开始备份文件...');
			debug('start1'); 
			$backupallPath =$folder.'/backupall.zip'; 
			$zip = new Zip($backupallPath);   
			$dd=$zip->SaveZip('./'.$folder.'/','./apps/','backupall','zip');  
			$this->showMsg('成功完成备份:<a href=\''.get_root().'/'.$dd.'\'>文件下载</a>, 耗时:'.debug('start1','stop1').'s','success');
		} 
		/* 获取更新包 */
		//获取更新包地址
		$updatedUrl = '#';
		$params = array('version' => config('rain.version'));
		$getupdatedUrl = $this->getRemoteUrl($updatedUrl, 'post', http_build_query($params));
		if(empty($getupdatedUrl)){
			$this->showMsg('未获取到更新包地址', 'error');
			exit;
		}
		//下载并保存
		$this->showMsg('开始获取远程更新包...');
		sleep(1);

		$zipPath = $folder.'/update.zip'; 
		$downZip = getFile($getupdatedUrl,ROOT_PATH.$folder,'update.zip');
		if(empty($downZip)){
			$this->showMsg('下载更新包出错，请重试！', 'error');
			exit;
		}
		//File::write_file($zipPath, $downZip);
		$this->showMsg('获取远程更新包成功：<a href=\''.'/'.get_root().ltrim($zipPath,'.').'\'>更新包下载</a>', 'success');
		sleep(1);
 
		/* 解压缩更新包 */ //TODO: 检查权限
		$this->showMsg('更新包解压缩...');
		sleep(1);
		$zip = new Zip();
		$res = $zip->UnZip($zipPath,'./',true,false);
		if($res === 0){
			$this->showMsg('解压缩失败：'.$zip->errorInfo(true).'------更新终止', 'error');
			exit;
		}
		$this->showMsg('更新包解压缩成功', 'success');
		sleep(1);
		$this->showMsg('获取远程更新包成功：<a href=\''.get_root().'/'.ltrim($zipPath,'.').'\'>更新包下载</a>', 'success');
		/* 更新数据库 *///后期扩展
// 		$updatesql = './update.sql';
// 		if(is_file($updatesql))
// 		{
// 			$this->showMsg('更新数据库开始...');
// 			if(file_exists($updatesql))
// 			{
// 				$Model = db();
// 				$sql = File::read_file($updatesql);
// 				$sql = str_replace("\r\n", "\n", $sql);
// 				foreach(explode(";\n", trim($sql)) as $query)
// 				{
// 					$Model->query(trim($query));
// 				}
// 			}
// 			unlink($updatesql);
// 			$this->showMsg('更新数据库完毕', 'success');
// 		}

		/* 系统版本号更新 */
//		$file = File::read_file(APP_PATH.'common/common/function.php');  
//		$file = str_replace(TWOTHINK_VERSION, $version, $file); 
//		$res = File::write_file(APP_PATH.'common/common/function.php', $file);
//		if($res === false){
//			$this->showMsg('更新系统版本号失败', 'text-danger');
//		}else{
//			$this->showMsg('更新系统版本号成功', 'text-primary');
//		}
		sleep(1);

		$this->showMsg('>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>');
		$this->showMsg('如有出现数据库问题，请输入    http://域名/install/update升级数据库');
		$this->showMsg('在线更新全部完成，如有备份，请及时将备份文件移动至非web目录下！', 'success');
	}

	/**
	 * 获取远程数据
	 * @author rain  <rain68.com>
	 */
	private function getRemoteUrl($url = '', $method = '', $param = ''){
		$opts = array(
			CURLOPT_TIMEOUT        => 20,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_URL            => $url,
			CURLOPT_USERAGENT      => $_SERVER['HTTP_USER_AGENT'],
		);
		if($method === 'post'){
			$opts[CURLOPT_POST] = 1;
			$opts[CURLOPT_POSTFIELDS] = $param;
		}

		/* 初始化并执行curl请求 */
		$ch = curl_init();
		curl_setopt_array($ch, $opts);
		$data  = curl_exec($ch);
		$error = curl_error($ch);
		//var_dump($error);
		curl_close($ch);
		return $data;
	}
    
	/**
	 * 实时显示提示信息
	 * @param  string $msg 提示信息
	 * @param  string $class 输出样式（success:成功，error:失败）
	 * @author 艺品网络  <twothink.cn>
	 */
	private function showMsg($msg, $class = ''){
		echo "<script type=\"text/javascript\">showmsg(\"{$msg}\",\"{$class}\")</script>";
		flush();
		ob_flush();
	}

	/**
	 * 生成更新文件夹名
	 * @author 艺品网络  <twothink.cn>
	 */
	private function getUpdateFolder(){
		$key = sha1(config('auth_key'));
		return 'update_'.$key;
	}
}