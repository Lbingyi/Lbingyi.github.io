<?php  
return array(
	'partner'			=> '2088602000418100',
	'seller_id'			=> '2088602000418100',
	'key'				=> 'nm0vmygjlpmq9jvr9ra7vpra36udz3xo',
	'notify_url' 		=> "http://www.jiasuyo.com/home/Rainpay/alipay_notify_url",
	'return_url' 		=> "http://www.jiasuyo.com/home/Rainpay/alipay_return_url",
	'sign_type'    		=> strtoupper('MD5'),
	'input_charset'		=> strtolower('utf-8'),
	'cacert'    		=> getcwd().'\\cacert.pem',
	'transport'    		=> 'http',
	'payment_type' 		=> "1",
	'service' 			=> "create_direct_pay_by_user",
	'anti_phishing_key' => "",
	'exter_invoke_ip' 	=> ""
);
?>