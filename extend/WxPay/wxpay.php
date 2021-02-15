<?php
require_once "lib/WxPay.Api.php";
require_once "lib/WxPay.Exception.php";
require_once "lib/WxPay.Data.php";
require_once "lib/WxPay.JsApiPay.php";
class wxpay{

	function __construct()
	{
		# code...
	}

	public function getOpenId()
	{
		$jsApiPay = new \JsApiPay();
		return $jsApiPay->GetOpenid();
	}

	public function jsApiPay($order)
	{
		$str = 'WXPAY';
		$input = new \WxPayUnifiedOrder();
		//openid
		if (isset($order['openid']) && $order['openid']) {
			$input->SetOpenid($order['openid']);
		}else{
			return false;
		}

		//订单总额
		if (isset($order['total_fee']) && is_int($order['total_fee'])) {
			$input->SetTotal_fee(strval(intval($order['total_fee'])));
		}else{
			$input->SetTotal_fee("1");
		}

		//订单号
		if (isset($order['out_trade_no']) && $order['out_trade_no']) {
			$input->SetOut_trade_no(($order['out_trade_no']));
		}else{
			$input->SetOut_trade_no($this->appid.date("YmdHis"));
		}

		//商品描述，128长度的字符串
		if (isset($order['body']) && $order['body'] && strlen($order['body']) <= 128) {
			$input->SetBody($order['body']);
		}else{
			$input->SetBody($str);
		}

		//附加数据
		if (isset($order['attach']) && $order['attach'] && strlen($order['attach']) <= 127) {
			$input->SetAttach($order['attach']);
		}else{
			$input->SetAttach($str);
		}

		//商品编号，32长度字符串
		if (isset($order['product_id']) && $order['product_id'] && strlen($order['product_id']) <= 32) {
			$input->SetProduct_id($order['product_id']);
		}else{
			$input->SetProduct_id($str);
		}
		
		$input->SetTime_start(date("YmdHis"));
		$input->SetTime_expire(date("YmdHis", time() + 600));
		$input->SetTrade_type("JSAPI");
		$order = WxPayApi::unifiedOrder($input);
		$tools = new \JsApiPay();
		$jsApiParameters = $tools->GetJsApiParameters($order);
		return $jsApiParameters;
	}

	public function payNative2($order)
	{
		$str = 'TMJWXPAY';
		$input = new \WxPayUnifiedOrder();

		//订单总额
		if (isset($order['total_fee']) && is_int($order['total_fee'])) {
			$input->SetTotal_fee(strval(intval($order['total_fee'])));
		}else{
			$input->SetTotal_fee("1");
		}

		//订单号
		if (isset($order['out_trade_no']) && $order['out_trade_no']) {
			$input->SetOut_trade_no(($order['out_trade_no']));
		}else{
			$input->SetOut_trade_no($this->appid.date("YmdHis"));
		}

		//商品描述，128长度的字符串
		if (isset($order['body']) && $order['body'] && strlen($order['body']) <= 128) {
			$input->SetBody($order['body']);
		}else{
			$input->SetBody($str);
		}

		//附加数据
		if (isset($order['attach']) && $order['attach'] && strlen($order['attach']) <= 127) {
			$input->SetAttach($order['attach']);
		}else{
			$input->SetAttach($str);
		}

		//商品编号，32长度字符串
		if (isset($order['product_id']) && $order['product_id'] && strlen($order['product_id']) <= 32) {
			$input->SetProduct_id($order['product_id']);
		}else{
			$input->SetProduct_id($str);
		}

		$input->SetTime_start(date("YmdHis"));
		$input->SetTime_expire(date("YmdHis", time() + 600));
		$input->SetTrade_type("NATIVE");
		$result = WxPayApi::unifiedOrder($input);
		$url = $result["code_url"];
		return $url;//"http://paysdk.weixin.qq.com/example/qrcode.php?data=$url";
	}

	public function notify($callBack)
	{
		$msg = "OK";
		$result = \WxpayApi::notify($callBack, $msg);
		return $result;
	}

	public function queryOrder($transaction_id)
	{
		$input = new \WxPayOrderQuery();
		$input->SetTransaction_id($transaction_id);
		$result = WxPayApi::orderQuery($input);
		if(array_key_exists("return_code", $result)
			&& array_key_exists("result_code", $result)
			&& $result["return_code"] == "SUCCESS"
			&& $result["result_code"] == "SUCCESS")
		{
			return true;
		}
		return false;
	}

	//查询订单
	public function queryOrder_sn($ordersn)
	{
		$input = new WxPayOrderQuery();
		//$input->SetTransaction_id($transaction_id);
		$input->SetOut_trade_no($ordersn);
		$result = WxPayApi::orderQuery($input);
		writeLog('wxpay',$result);
		if(array_key_exists("return_code", $result)
			&& array_key_exists("result_code", $result)
			&& $result["return_code"] == "SUCCESS"
			&& $result["result_code"] == "SUCCESS")
		{
			return true;
		}
		return false;
	}

	public function payToUser($order)
	{
		$input = new WxPayPayToUser();
		writeLog('wxPayToUser',$order);
		//商户订单号
		if (isset($order['partner_trade_no']) && $order['partner_trade_no']) {
			$input->SetPartner_trade_no($order['partner_trade_no']);
		}else{
			return false;
		}

		//用户openid
		if (isset($order['openid']) && $order['openid']) {
			$input->SetOpenid($order['openid']);
		}else{
			return false;
		}

		//是否需要实名认证检测
		$input->SetCheck_name();

		//用户姓名
		if ($input->GetCheck_name() != 'NO_CHECK' && isset($order['re_user_name']) && $order['re_user_name']) {
			$input->SetRe_user_name($order['re_user_name']);
		}

		//转账金额
		if (isset($order['amount']) && is_int($order['amount']) && intval($order['amount'])) {
			$input->SetAmount($order['amount']);
		}else{
			return false;
		}

		//付款说明
		if (isset($order['desc']) && $order['desc']) {
			$input->SetDesc($order['desc']);
		}else{
			return false;
		}

		$res = WxPayApi::payToUser($input);
		writeLog('wxPayToUser',$res);
		return $res;
	}

	public function sendRedPack($order)
	{
		$input = new \WxPaySendRedPack();

		//订单号
		if (isset($order['mch_billno']) && $order['mch_billno'] && strlen($order['mch_billno']) <= 28) {
			$input->SetMch_billno($order['mch_billno']);
		}else{
			return false;
		}

		//用户openid
		if (isset($order['re_openid']) && $order['re_openid'] && strlen($order['re_openid']) <= 32) {
			$input->SetOpenid($order['re_openid']);
		}else{
			return false;
		}

		//红包金额
		if (isset($order['total_amount']) && is_int($order['total_amount']) && intval($order['total_amount'])) {
			$input->SetTotal_amount(strval(intval($order['total_amount'])));
		}else{
			return false;
		}
		
		//红包祝福语
		if (isset($order['wishing']) && $order['wishing'] && strlen($order['wishing']) <= 128 ) {
			$input->SetWishing($order['wishing']);
		}else{
			return false;
		}
		
		//活动名称
		if (isset($order['act_name']) && $order['act_name'] && strlen($order['wishing']) <= 32 ) {
			$input->SetAct_name($order['act_name']);
		}else{
			return false;
		}

		//备注
		if (isset($order['remark']) && $order['remark'] && strlen($order['remark']) <= 256 ) {
			$input->SetRemark($order['remark']);
		}else{
			return false;
		}

		//场景
		if (isset($order['scene_id']) && $order['scene_id'] && strlen($order['scene_id']) <= 32 ) {
			$input->SetScene_id($order['scene_id']);
		}

		$res = \WxPayApi::sendRedPack($input);
		writeLog($res,'wxSendRedPack');
		return $res;
	}

	public function sendGroupRedPack($order)
	{
		$input = new \WxPaySendRedPack();

		//订单号
		if (isset($order['mch_billno']) && $order['mch_billno'] && strlen($order['mch_billno']) <= 28) {
			$input->SetMch_billno($order['mch_billno']);
		}else{
			return false;
		}

		//用户openid
		if (isset($order['re_openid']) && $order['re_openid'] && strlen($order['re_openid']) <= 32) {
			$input->SetOpenid($order['re_openid']);
		}else{
			return false;
		}

		//红包金额
		if (isset($order['total_amount']) && is_int($order['total_amount']) && intval($order['total_amount'])) {
			$input->SetTotal_amount(strval(intval($order['total_amount'])));
		}else{
			return false;
		}

		//红包人数
		if (isset($order['total_num']) && is_int($order['total_num']) && intval($order['total_num'])) {
			$input->SetTotal_num(strval(intval($order['total_num'])));
		}else{
			return false;
		}
		
		//红包祝福语
		if (isset($order['wishing']) && $order['wishing'] && strlen($order['wishing']) <= 128 ) {
			$input->SetWishing($order['wishing']);
		}else{
			return false;
		}
		
		//活动名称
		if (isset($order['act_name']) && $order['act_name'] && strlen($order['wishing']) <= 32 ) {
			$input->SetAct_name($order['act_name']);
		}else{
			return false;
		}

		//备注
		if (isset($order['remark']) && $order['remark'] && strlen($order['remark']) <= 256 ) {
			$input->SetRemark($order['remark']);
		}else{
			return false;
		}

		//场景
		if (isset($order['scene_id']) && $order['scene_id'] && strlen($order['scene_id']) <= 32 ) {
			$input->SetScene_id($order['scene_id']);
		}

		$res = \WxPayApi::sendGroupRedPack($input);
		writeLog($res,'wxSendGroupRedPack');
		return $res;
	}

	public function queryRedPack($orderSn)
	{
		$input = new \WxPaySendRedPack();
		$input->SetMch_billno($orderSn);
		$res = WxPayApi::queryRedPack($input);
		return $res;
	}
}
