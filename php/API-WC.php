<?php
    //curl获取信息demo
    function http_curl($url)
    {
        //初始化curl
        $ch = curl_init();
//          $url = 'www.baidu.com';//target url
        //设置curl参数
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        //采集
        $output = curl_exec($ch);
        //关闭
        curl_close($ch);
//      var_dump($output);
		$arr = json_decode( $output , true );
		return $arr;
    }
    
    //获取access_token
    function getWCAccessToken()
    {
        //请求地址
        $appId = "wx7c1c9c18cbe29e05";
        $secret = "3ddebbf2d6acf51532ab14dc2ff1ac4f";
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appId."&secret=".$secret;
        //初始化
        $ch = curl_init();
        //设置参数
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        //调用接口
        $output = curl_exec($ch);
        //打印返回值
        if( curl_errno($ch) )
        {
            var_dump( curl_error($ch) );
        }
        $arr = json_decode( $output , true );
        var_dump($output);
        //关闭url
        curl_close($ch);
    }
    
    //获取微信服务器ip
    function getWCServerIp()
    {
        //编辑目标地址
        $access_token = "";
        $url = "";
        $ch = "";
        //初始化curl
        $ch = curl_init();
        //设置参数
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        //调用借口
        $output = curl_exec($ch);
        //打印返回值
        if( curl_errno($ch) )
        {
            var_dump( curl_error($ch) );
        }
        $arr = json_decode($output,true);
        echo "<pre>";
        var_dump($arr);
        echo "</pre>";
        //关闭接口
        curl_close($ch);
    }

    //获取用户基本信息
    function gatBaseInfo()
    {
    	//获取到code
        $appId = "wx7c1c9c18cbe29e05";
//      $redirect_uri = urlencode("http://www.tongbeiwang.com/TongBeiWap/index.html");
        $redirect_uri = urlencode("http://www.tongbeiwang.com/TongBeiWap/php/getUseOpenId.php");
        $scope = "snsapi_base";
        $state = "123";
        $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$appId."&redirect_uri=".$redirect_uri."&response_type=code&scope=".$scope."&state=".$state."#wechat_redirect";
        header('location:'.$url);
    }

    function getUserOpenId()
    {
        //获取网页授权的access_token
        $appId = "wx7c1c9c18cbe29e05";
        $secret = "3ddebbf2d6acf51532ab14dc2ff1ac4f";
        $code = $_GET['code'];
        $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$appId."&secret=".$secret."&code=".$code."&grant_type=authorization_code";
        //拉取用户的openid
        $res = http_curl($url);
		echo $res['openid'];
    }        
