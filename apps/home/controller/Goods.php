<?php
namespace app\home\controller;
use think\Session;
use think\Controller;
use think\Db;
use app\common\controller\UserFn;
use \think\Url;
use \think\Loader;


class Goods extends Base
{
	public function index(){
		$card=Db::name('money')
			->alias('a')
			->field('b.day,b.name,a.money,a.goods_id,a.typeid')
			->join('card_type b','a.typeid=b.id and b.status =1')
		    ->where('a.goods_id',1)
		    ->select();
		$this->assign('card_type',$card);
		// dump($card);
		return $this->fetch('goods\prduct');
	}
	/**
	 * 生成二维码
	 * @param  url 使用GET传递支付地址
	 * @return 成功时输出二维码，其他抛异常
	 */
	public function GetWxQrcode(){
		QRcode(input('get.url'));
	}
	/**
	 * 生成订单
	 * @param  goods_id	商品ID
	 * @param  typeid	卡类ID
	 * @param  num		数量
	 * @param  pay_type 支付方式,1是微信,2是支付宝
	 * @return 输出订单数据
	 */
	public function pay()
	 {
    	$goods_id=intval(input('post.goods_id'));
    	$data['pay_type'] = intval(input('post.pay_type'));
    	$typeid=intval(input('post.typeid'));
    	$num=intval(input('post.num'));
		$data['user_id']=session('user.user_id');

		// dump($data);exit;
		$user_app = Db::name('user_app')->where('appid',$goods_id)->where('uid',$data['user_id'])->find();
		if(!$user_app){
			$resarr=['code'=>106,'msg'=>'请完成APP首次登录以后方可充值续费'];
			return json($resarr);
		}
    	$goods=Db::name('goods')->where('goods_id',$goods_id)->find();
    	$type=Db::name('money')->where('goods_id',$goods_id)->where('typeid',$typeid)->find();
		$order_number=corder();
		$name=$goods['title'];
		$money=$type['money']*$num;
		$body_goods_type='计时类';
		$date=time();
		$uid=session('user.user_id');
		
		if($num < 1 || !is_int($num+0)){
			$resarr=['code'=>105,'msg'=>'error'];
			return json($resarr);
		}
		
		if(!$money){
			$resarr=['code'=>100,'msg'=>'error'];
			return json($resarr);
		}
		if($typeid<1){				
			$body_type='授权码';
			$goods_num=Db::name('acard')->where('appid',$goods['appid'])->where('status',1)->count();
			if($goods_num < $num){
				$resarr=['code'=>105,'msg'=>'error'];
			    return json($resarr);
			} 
			$body_day=Db::name('app')->where('appid',$goods['appid'])->value('acard_time');
		}else{
			$resdb=Db::name('card_type')->where('id',$typeid)->find();
			$body_type=$resdb['name'];
			$goods_num=Db::name('card')
			->where('appid',$goods['appid'])
			->where('type',$typeid)
			->where('status',1)
			->where('sales_status',0)
			->count();
			if($goods_num < $num){
				$resarr=['code'=>105,'msg'=>'error'];
			    return json($resarr);
			} 
			$body_day=$resdb['day'];
			
		}
		if($data['pay_type'] ==1){
			$data['ordersn'] = 'TMJWXPAY'.date('YmdHis');
			$data['amount'] = $money;
			$data['goods_id'] = $goods_id;
			$data['num'] = $num;
			$data['typeid'] = $typeid;
			$data['created'] = time();
			$recordid = Db::name('record')->insertGetId($data);
			session('recordid',$recordid);
	        $order = array(
	            'total_fee' =>  intval($data['amount']*100),
	            'out_trade_no'  =>  $data['ordersn'],
	            'product_id'    =>  '商品编号',
	            'body'  =>  $goods['title'].'_'.$resdb['name'],
	            'attach'    =>  '附件数据',
	        );
	        $url = Url::build('GetWxQrcode')."?url=".wxPayNative2($order);
			$resarr=['code'=>1,'msg'=>['url'=>$url,'data'=>['ordersn'=>$data['ordersn'],'goods_name'=>$order['body'],'amount'=>$data['amount']]]];
		    return json($resarr);
		}else if($data['pay_type'] ==2){
			$data['ordersn'] = 'TMJALIPAY'.date('YmdHis');
			$data['amount'] = $money;
			$data['goods_id'] = $goods_id;
			$data['num'] = $num;
			$data['typeid'] = $typeid;
			$data['created'] = time();
			Db::name('record')->insert($data);
	        $order = array(
	            'total_fee' =>  $data['amount'],
	            'out_trade_no'  =>  $data['ordersn'],
	            'subject'  =>  $goods['title'].'_'.$resdb['name'],
	        );
        	$html = alipayDirectPay($order);
        	$resarr=array('code'=>1,'msg'=>array('html'=>$html));
		    return json($resarr);
		}
	}
	/**
	*  微信订单状态
	* @return status 1支付成功2支付失败,0等待支付
	*/
	public function Get_Wx_Pay_status(){
		$recordid = session('recordid');
		$pay_status = Db::name('record')->where('id',$recordid)->value('pay_status');
		if($pay_status==1){
			$msg=array(
				'status' => 1,
				'msg'	 => '支付成功'
			);
		}else if($pay_status == 2){
			$msg=array(
				'status' => 2,
				'msg'	 => '支付失败'
			);
		}else{
			$msg=array(
				'status' => 0,
				'msg'	 => ''
			);
		}
		return json($msg);
	}
    //public function test()
    //{
        //$data =array (
		//   'out_trade_no' => input('get.aa'),
		//   'appid' => 'wxa0176a71033addaf',
		//   'attach' => '附件数据',
		//   'bank_type' => 'CFT',
		//   'cash_fee' => '1',
		//   'fee_type' => 'CNY',
		//   'is_subscribe' => 'Y',
		//   'mch_id' => '1320764101',
		//   'nonce_str' => '09bwrr07uspzcs95qfp4cd9pl5opbvc1',
		//   'openid' => 'oTGWPws0dejsM0t0Qo2iIid3dER8',
		//   'result_code' => 'SUCCESS',
		//   'return_code' => 'SUCCESS',
		//   'sign' => '03E777B7C76A0C6E3FA693769A8ACB69',
		//   'time_end' => '20180719182723',
		//   'total_fee' => '1',
		//   'trade_type' => 'NATIVE',
		//   'transaction_id' => '4200000145201807190254587695',
		// );
  		//   	wxPayNotifyCallBack($data);
  		//   	
  	//}
	
}
?>