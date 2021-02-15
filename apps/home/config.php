<?php
	
	return [	
	    'view_replace_str'       => [
	        '__ROOT__'   =>  \think\request::instance()->root(),
            '__PUBLIC__' =>  \think\request::instance()->root() . '/public',           
            '__STATIC__' =>  \think\request::instance()->root() . '/public/static',
            '__PLUG__'   =>  \think\request::instance()->root() . '/public/static/plug',
            '__THEME__'    =>  \think\request::instance()->root() . '/theme',
            '__CSS__'    =>  \think\request::instance()->root() . '/theme/default/index/resources/css',
            '__JS__'     =>  \think\request::instance()->root() . '/theme/default/index/resources/js',
            '__IMG__'    =>  \think\request::instance()->root() . '/theme/default/index/resources/img',            
        ],
        
        'template'               => [
            // 模板引擎类型 支持 php think 支持扩展
            'type'         => 'Think',
            // 模板路径
            'view_path'    => './theme/default/index/',
            // 模板后缀
            'view_suffix'  => 'html',
            // 模板文件名分隔符
            'view_depr'    => DS,
            // 模板引擎普通标签开始标记
            'tpl_begin'    => '{',
            // 模板引擎普通标签结束标记
            'tpl_end'      => '}',
            // 标签库标签开始标记
            'taglib_begin' => '{',
            // 标签库标签结束标记
            'taglib_end'   => '}',
        ],
               
	];
