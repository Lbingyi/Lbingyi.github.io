<?php
namespace app\user\validate;

use think\Validate;

class User extends Validate
{
    protected $rule = [
        'name'      => 'require|alphaDash',
        'password'  =>'require',
        'passworden'=>'require|confirm:password',
        'email'     =>'email',
        'valcode'   =>'require',       
    ];

    protected $message = [
        'name.require'        => ['code'=>40001,'message'=>'error','content'=>'用户名是必须的!'],
        'name.alphaDash'      => ['code'=>40002,'message'=>'error','content'=>'用户名必须是 字母或数字或下划线！'],
        'password.require'    => ['code'=>40003,'message'=>'error','content'=>'密码不能为空'],
        'passworden.require'  => ['code'=>40004,'message'=>'error','content'=>'确认密码不能为空'],
        'passworden.confirm'  => ['code'=>40005,'message'=>'error','content'=>'确认密码不相同'],
        'email.email'         => ['code'=>40006,'message'=>'error','content'=>'邮箱格式不正确'],
        'valcode.require'     => ['code'=>40007,'message'=>'error','content'=>'验证无法通过'],
    ];

    protected $scene = [
        'register'   =>  ['name','password','passworden','email'],
        //'login'   =>  ['name','password','passworden','email'],          
    ];
}