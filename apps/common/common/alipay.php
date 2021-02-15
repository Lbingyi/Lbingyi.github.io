<?php
use \think\Loader;
use \think\Db;
use \think\Config;
use app\common\controller\UserFn;

function alipayDirectPay($order = array())
{
	if (!(isset($order['total_fee']) && $order['total_fee'])) {
		$order['total_fee'] = 0.01;
	}
	if (!(isset($order['subject']) && $order['subject'])) {
		$order['subject'] = '测试订单';
	}
	if (!(isset($order['out_trade_no']) && $order['out_trade_no'])) {
		$order['out_trade_no'] = date('ymdHis',time()).rand(100000,999999);
	}
	if (!(isset($order['body']) && $order['body'])) {
		$order['body'] = '加速哟网游加速器';
	}

	$alipay_config = Config::get('alipay');

	$parameter = array(
		"service"       => $alipay_config['service'],
		"partner"       => $alipay_config['partner'],
		"seller_id"  => $alipay_config['seller_id'],
		"payment_type"	=> $alipay_config['payment_type'],
		"notify_url"	=> $alipay_config['notify_url'],
		"return_url"	=> $alipay_config['return_url'],
		"anti_phishing_key"=>$alipay_config['anti_phishing_key'],
		"exter_invoke_ip"=>$alipay_config['exter_invoke_ip'],
		"out_trade_no"	=> $order['out_trade_no'],
		"subject"	=> $order['subject'],
		"total_fee"	=> $order['total_fee'],
		"body"	=> $order['body'],
		"_input_charset"	=> trim(strtolower($alipay_config['input_charset']))		
	);

	Loader::import("Alipay.lib.alipay_submit");
    $alipaySubmit = new \AlipaySubmit($alipay_config);
    $html_text = $alipaySubmit->buildRequestForm($parameter,"get", "确认");
	return $html_text;
}
function alipayDirectPayReturn()
{
	$res = $_GET;
	Loader::import("Alipay.lib.alipay_notify");
	$alipayNotify = new \AlipayNotify(Config::get('alipay'));
	$verify_result = $alipayNotify->verifyReturn();
	if ($verify_result) {
		writeLog('验证成功','alipayReturn');
		writeLog($res,'alipayReturn');
		save_mx_pay_status(1,$res['out_trade_no']);
		return 1;
	}else{
		writeLog('验证失败','alipayReturn');
		writeLog($res,'alipayReturn');
		save_mx_pay_status(0,$res['out_trade_no']);
		return 0;
	}
}
function alipayDirectPayNotify()
{
	$res = $_POST;
	Loader::import("Alipay.lib.alipay_notify");
	$alipayNotify = new \AlipayNotify(Config::get('alipay'));
	$verify_result = $alipayNotify->verifyNotify();
	if ($verify_result) {
		writeLog('验证成功','alipayNotify');
		writeLog($res,'alipayNotify');
		//此处添加业务逻辑
		save_mx_pay_status(1,$res['out_trade_no']);
		return $_POST;
	}else{
		writeLog('验证失败','alipayNotify');
		writeLog($res,'alipayNotify');
		save_mx_pay_status(0,$res['out_trade_no']);
		return false;
	}
}
?>