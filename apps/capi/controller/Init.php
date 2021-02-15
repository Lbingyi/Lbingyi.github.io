<?php

namespace app\capi\controller;

use think\Controller;
use think\Request;

class Init extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //hook('checkallcapi');
        return 'ok';
    }

}
