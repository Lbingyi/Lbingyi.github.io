<?php
use \think\Loader;
use \think\Db;
use app\common\controller\UserFn;
function wxGetOpenId()
{
	Loader::import('WxPay.wxpay');
    $wxpay = new \wxpay();
    return $wxpay->getOpenId();
}

function wxJsApiPay($order)
{
	Loader::import('WxPay.wxpay');
    $wxpay = new \wxpay();
    return $wxpay->jsApiPay($order);
}
/*
 *扫码支付模式一
 */
function wxPayNative1()
{
	# code...
}
 /**
 * 
 * 扫码支付模式二
 * @param array $order
 * 		Array(
 *		'total_fee'	=>	int,	//订单总额，缺省默认1，即一分钱，建议传入
 *		'out_trade_no'	=>	string,	//订单号，最长32位长度，缺省自动生成，建议传入
 *		'product_id'	=>	string,	//商品编号，最长32位长度，否则使用缺省，缺省默认'TMJWXPAY'，建议传入
 *		'body'	=>	string,	//商品描述，最长128长度，否则使用缺省，缺省默认'TMJWXPAY'，建议传入
 *		'attach'	=>	string, //附加数据，最长127长度，否则使用缺省，缺省默认'TMJWXPAY'，支付结果会原样返回，如需传入
 *	)
 * @author ftian
 * @return 成功时返回，其他返回false
 */
function wxPayNative2($order)
{
	Loader::import('WxPay.wxpay');
    $wxpay = new \wxpay();
    return $wxpay->payNative2($order);
}
function wxPayNotify()
{
	Loader::import('WxPay.wxpay');
	$wxpay = new \wxpay();
	//调用回调函数
    return $wxpay->notify('wxPayNotifyCallBack');
}
/*
 *查询订单真实性
 */
function wxPayQueryOrder($transaction_id)
{
	Loader::import('WxPay.wxpay');
	$wxpay = new \wxpay();
	//调用回调函数
    return $wxpay->queryOrder($transaction_id);
}
/**
 * 
 * 发送微信普通红包
 * @param array $order
 * 		Array(
 *			'mch_billno'	=>	string,	//订单号，最长28个字符，必填
 *			're_openid'	=>	string,	//用户的openid，最长32个字符，必填
 *			'total_amount'	=>	int, //红包金额，单位是分，必填，范围100~20000
 *			'wishing'	=>	string,	//祝福语，最长128个字符，必填
 *			'act_name'	=>	string,	//活动名称，最长32个字符，必填
 *			'remark'	=>	string, //备注，最长256个字符，必填
 *			'scene_id'	=>	string, //需要微信后台进行相关设置，金额大于200元是需要填，建议不填，可选值 PRODUCT_1=>商品促销，PRODUCT_2=>抽奖，PRODUCT_3=>虚拟物品兑奖，PRODUCT_4=>企业内部福利，PRODUCT_5=>渠道分润，PRODUCT_6=>保险回馈，PRODUCT_7=>彩票派奖，PRODUCT_8=>税务刮奖，
 *			)
 * @author ftian
 * @return 成功时返回，其他返回false
 */
function wxSendRedPack($order)
{
	Loader::import('WxPay.wxpay');
	$wxpay = new \wxpay();
    return $wxpay->sendRedPack($order);
}

/**
 * 
 * 发送微信裂变红包
 * @param array $order
 * 		Array(
 *			'mch_billno'	=>	string,	//订单号，最长28个字符，必填
 *			're_openid'	=>	string,	//用户的openid，最长32个字符，必填
 *			'total_amount'	=>	int, //红包金额，单位是分，必填，范围100~20000
 *			'total_num'	=>	int, //红包人数，单位是分，必填，范围3~20
 *			'wishing'	=>	string,	//祝福语，最长128个字符，必填
 *			'act_name'	=>	string,	//活动名称，最长32个字符，必填
 *			'remark'	=>	string, //备注，最长256个字符，必填
 *			'scene_id'	=>	string, //需要微信后台进行相关设置，金额大于200元是需要填，建议不填，可选值 PRODUCT_1=>商品促销，PRODUCT_2=>抽奖，PRODUCT_3=>虚拟物品兑奖，PRODUCT_4=>企业内部福利，PRODUCT_5=>渠道分润，PRODUCT_6=>保险回馈，PRODUCT_7=>彩票派奖，PRODUCT_8=>税务刮奖，
 *			)
 * @author ftian
 * @return 成功时返回，其他返回false
 */
function wxSendGroupRedPack($order)
{
	Loader::import('WxPay.wxpay');
	$wxpay = new \wxpay();
    return $wxpay->sendGroupRedPack($order);
}

function wxQueryRedPack($orderSn)
{
	Loader::import('WxPay.wxpay');
	$wxpay = new \wxpay();
    return $wxpay->queryRedPack($orderSn);
}

function wxPayToUser($order)
{
	Loader::import('WxPay.wxpay');
	$wxpay = new \wxpay();
    return $wxpay->payToUser($order);
}
function save_mx_pay_status($status,$ordersn){
    if ($status) {//支付成功
        //修改到期时间和状态
        $data = Db::name('record')
        ->where(['ordersn'=>$ordersn])
        // ->fetchSql(true)
        ->find();
        writeLog($data,'save_mx_pay');
        if($data){
            if($data['pay_status'] != 1){   
                $appid = 1;
                $uid  =$data['user_id'];
                $typeid =$data['typeid'];
                $ores =$data['id'];
                $num =$data['num'];
                $goods_id =$data['goods_id'];
                $userfn=new \app\common\controller\UserFn();
                $userfn->sendcard($appid,$uid,$typeid,$ores,$num);
                Db::name('goods')->where('goods_id',$goods_id)->setInc('buy_count',$num); 
                $updata = $userfn->Recharge($ores);
                if($updata){
                    Db::name('record')
                    ->where('ordersn',$ordersn)
                    ->update(  ['pay_status' => 1,
                                'updated'=>time(),
                                'used_time'=> $updata['used_time'],
                                'new_time'=> $updata['new_time'],
                                'day_num'=> $updata['day_num'],
                                'recharge_time'=>time()
                    ]);
                }
                          
            }
        }else{
            writeLog(['status'=>$status,'ordersn'=>$ordersn],'save_mx_pay_error');
        }
    }else{//支付失败
       Db::name('record')->where('ordersn',$ordersn)->update(['pay_status' => 2]);
    }
}
function wxPayNotifyCallBack($data)
    {
        writeLog($data,'wxPayNotify');
        if ($data['transaction_id']) {
            // if (wxPayQueryOrder($data['transaction_id'])) {
                    #此处添加业务逻辑处理函数，封装好以后直接调用
                    #例如：controller->function();
                    if ($data['out_trade_no']) {
                        $ordersn = $data['out_trade_no'];
                    }else{
                        return false;
                    }
                    if ($data['result_code']) {
                        $result_code = $data['result_code'];
                    }else{
                        return false;
                    }
                    if ($data['return_code']) {
                        $return_code = $data['return_code'];
                    }else{
                        return false;
                    }
                    if ($result_code == 'SUCCESS' && $return_code == 'SUCCESS') {
                        $status = 1;
                    }else{
                        $status = 0;
                    }
                    $aa =array('wxPayNotifyCallBack','status'=>$status,'ordersn'=>$ordersn);
                    writeLog($aa,'wxpay');
                    save_mx_pay_status($status,$ordersn);
                // }   
        }
    }
function wxPayQueryOrder_sn($ordersn)
    {
        Loader::import('WxPay.wxpay');
        $wxpay = new \wxpay();
        //调用回调函数
        return $wxpay->queryOrder_sn($ordersn);
    }
?>