<?php
namespace app\common\controller;
use think\Session;
use think\Controller;
use think\Db;
use think\Request;
use think\Config;

class Fn extends controller
{
    /*
	 * 取操作节点
	 * 
	 * */
    public function getNode(){
    	$request = Request::instance();	    		
		return $request->module().'/'.$request->controller().'/'.$request->action();	
		
    }
	public function getController(){
    	$request = Request::instance();	    		
		return '/'.$request->controller().'/';	
		
    }
	/**
     * 系统邮件发送函数
    * @param string $tomail 接收邮件者邮箱
    * @param string $name 接收邮件者名称
    * @param string $subject 邮件主题
    * @param string $body 邮件内容
    * @param string $attachment 附件列表
    * @return boolean
    * @author static7 <static7@qq.com>
    */
	
	public function sendMail($tomail, $name, $subject = '', $body = '', $attachment = null) {
        $mail = new \PHPMailer();           //实例化PHPMailer对象
        $mail->CharSet = 'UTF-8';           //设定邮件编码，默认ISO-8859-1，如果发中文此项必须设置，否则乱码
        $mail->IsSMTP();                    // 设定使用SMTP服务
        $mail->SMTPDebug = 0;               // SMTP调试功能 0=关闭 1 = 错误和消息 2 = 消息
        $mail->SMTPAuth = true;             // 启用 SMTP 验证功能
        $mail->SMTPSecure = config('email.secure');          // 使用安全协议
        $mail->Host = config('email.host'); // SMTP 服务器
        $mail->Port = config('email.port');                  // SMTP服务器的端口号
        $mail->Username = config('email.username');    // SMTP服务器用户名
        $mail->Password = config('email.password');     // SMTP服务器密码
        $mail->SetFrom(config('email.replyemali'), config('email.replyuser'));
        $replyEmail = config('email.replyemali');                   //留空则为发件人EMAIL
        $replyName = config('email.replyuser');                    //回复名称（留空则为发件人名称）
        $mail->AddReplyTo($replyEmail, $replyName);
        $mail->Subject = $subject;
        $mail->MsgHTML($body);
        $mail->AddAddress($tomail, $name);
        if (is_array($attachment)) { // 添加附件
            foreach ($attachment as $file) {
                is_file($file) && $mail->AddAttachment($file);
            }
        }
        return $mail->Send() ? true : $mail->ErrorInfo;
    }

    	//取前端菜单数据	
	public function getMenu(){
		$res=Db::name('menu')->where('status',1)->order('id asc')->select();		
		return $res;
	}
	//取最新文章
	public function newarticle($num){
		$res=Db::name('article')->where('status',1)->order('id desc')->limit($num)->select();
		return $res;
	}
}
