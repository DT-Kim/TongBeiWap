<?php
    header('Access-Control-Allow-Origin:*');
//	header('Content-Type:application/json');
	header('Charset=utf-8');
	session_start();
    require('API-WC.php');
	
    if (isset($_GET['code'])){
		/*
		 * 获取用户的openid
		 */
		$openid = getUserOpenId();
//		echo $openid;echo "<br/>";
		
        //检测是不是第一次登陆
        require('conn.php');
        $sql = "select id from 用户信息  where openid = '".$openid."'";
//      echo $sql;echo "<br/>";
        $result = $conn->query($sql)->fetch_assoc();
		
        $useidC = $result['id'];
//		echo $useidC;echo "<br/>";
            //如果不存在useid
        if(!($useidC))
        {
            //创建新的用户信息数据
            $sql_New = "insert into 用户信息 (openid,注册时间) values('".$openid."','".date('Y-m-d H:i:s')."')";
//			echo $sql_New;
            $result_New = $conn->query($sql_New);
                //获取新数据的用户id
            $result_NId = $conn->query($sql)->fetch_assoc();
            $useidC = $result_NId['id'];
        }
        $useid = $useidC;
		
		//返回index.html页面
	    $_SESSION['UseId'] = $useid;
//	    echo $useid;
		echo "<script type='text/javascript'>self.location.href = '../index.html?data=".$useid."';</script>";
    }else {
        exit ;
    }
    