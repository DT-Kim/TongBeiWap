<?php 
    header("Access-Control-Allow-Origin: *");
    session_start();
   //获得参数 signature nonce token timestamp echostr
	   	$timestamp = $_GET['timestamp'];
		$nonce     = $_GET['nonce'];
		$signature = $_GET['signature'];
		$token     = '075036763612WeChat';
	//形成数组，然后按字典序排序
		$array = array();
		$array = array($nonce, $timestamp, $token);
		sort($array);
	//拼接成字符串,sha1加密 ，然后与signature进行校验
		$str = sha1( implode( $array ) );
	
		if( $str  == $signature ){
			//第一次接入weixin api接口的时候
			ob_clean();
			header('content-type:text');
			echo $_GET['echostr'];
			exit;
		}
//	if($str == $signature && $echostr){
//		ob_clean();
//      return $echostr;
//  }