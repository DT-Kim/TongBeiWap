<?php
    header("Access-Control-Allow-Origin: *");
    session_start();
	require('API-WC.php');
	/*
	 * 获取code
	 * 成功后跳转getUseOpenId.php
	 */
		//没有的话直接跳转到主页
	if(!($_SESSION['UseId']))
	{
		gatBaseInfo();
	}else{
			//否则跳转到index.php
		echo "<script type='text/javascript'>self.location.href = '../index.html';</script>";
	}
	
    
//  //返回useid
//  $_SESSION['UseId'] = $useid;	 
//  echo $useid;
