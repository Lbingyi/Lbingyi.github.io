<?php

namespace addons\devteam;

use think\Addons;

/**
 * 系统环境信息插件
 * @package plugins\DevTeam
 * @author 蔡伟明 <314013107@qq.com>
 */
class Devteam extends Addons
{
    /**
     * @var array 插件信息
     */
    public $info = [
        'name' => 'devteam',
        'title' => '产品信息',
        'description' => '产品信息',
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
     * @author 蔡伟明 <314013107@qq.com>
     */
    public function adminIndexIndexC()
    {
        
        $this->fetch('devteam');
       
    }

    /**
     * 安装方法
     * @author 蔡伟明 <314013107@qq.com>
     * @return bool
     */
    public function install(){
        return true;
    }

    /**
     * 卸载方法必
     * @author 蔡伟明 <314013107@qq.com>
     * @return bool
     */
    public function uninstall(){
        return true;
    }
}