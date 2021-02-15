<?php

namespace addons\systeminfo;

use think\Addons;

/**
 * 系统环境信息插件
 * @package plugins\SystemInfo
 * @author 鸿煊 <643125846@qq.com>
 */
class Systeminfo extends addons
{
    /**
     * @var array 插件信息
     */
    public $info = [
        'name' => 'systeminfo',
        'title' => '系统信息',
        'description' => '系统信息',
        'status' => 0,
        'author' => 'By 乐游',
        'version' => '1.0',
        'appcenter_id'=>22
    ];

    /**
     * @var array 插件钩子
     */
    public $hooks = [
        'admin_index'
    ];

    /**
     * 后台首页钩子
     * @author 鸿煊 <643125846@qq.com>
     */
    public function adminIndexIndexC()
    {
        
        $this->fetch('widget');
        
    }

    /**
     * 安装方法
     * @author 鸿煊 <643125846@qq.com>
     * @return bool
     */
    public function install(){
        return true;
    }

    /**
     * 卸载方法必
     * @author 鸿煊 <643125846@qq.com>
     * @return bool
     */
    public function uninstall(){
        return true;
    }
}