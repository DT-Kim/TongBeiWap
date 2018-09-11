<?php
    require'API-WC.php';
	
    if (isset($_GET['code'])){
		/*
		 * 获取用户的openid
		 */
		getUserOpenId();
//      echo "code:".$_GET['code']."<br>";
//      echo "state:".$_GET["state"];
    }else {
        echo "no code";
    }
    