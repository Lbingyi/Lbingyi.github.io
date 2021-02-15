<?php
// +----------------------------------------------------------------------
// | raincms [ rain ]
// +----------------------------------------------------------------------
// | 版权所有 2016~2017 Raincms [ http://www.rain68.com ]
// +----------------------------------------------------------------------
// | 官方网站: http://rain.com
// +----------------------------------------------------------------------
// | 开源协议 ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------

namespace addons\allinfo;

use think\Db;
use think\Addons;

/**
 * 系统环境信息插件
 * @package plugins\DevTeam
 * @author Rain <80692285@qq.com>
 */
class Allinfo extends Addons
{
    /**
     * @var array 插件信息
     */
    public $info = [
        'name' => 'allinfo',
        'title' => '统计信息',
        'description' => '统计信息',
        'status' => 0,
        'author' => 'By Rain',
        'version' => '1.0',
        'appcenter_id'=>21
    ];

    /**
     * @var array 插件钩子
     */
    public $hooks = [
        'admin_index'
    ];

    /**
     * 后台首页钩子
     * @author Rain <80692285@qq.com>
     */
    public function adminIndexIndexC()
    {
        	
        $usercount=Db::name('member')->count();
		$appcount=Db::name('app')->count();
		$acardcount=Db::name('acard')->count();
		$cardcount=Db::name('card')->count();
		$infonum=['usercount'=>$usercount,'appcount'=>$appcount,'acardcount'=>$acardcount,'cardcount'=>$cardcount];
		$this->assign('infonum',$infonum);
        $this->fetch('widget');
        
    }

    /**
     * 安装方法
     * @author Rain <80692285@qq.com>
     * @return bool
     */
    public function install(){
        return true;
    }

    /**
     * 卸载方法必
     * @author Rain <80692285@qq.com>
     * @return bool
     */
    public function uninstall(){
        return true;
    }
}