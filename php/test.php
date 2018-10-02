<?php
    header("Access-Control-Allow-Origin: *");
    include_once "APIWC/wxBizMsgCrypt.php";
    
    // 第三方发送消息给公众平台
    $encodingAesKey = "1vSL2sjqm6JFyqa1EaM5uFl5QlbJe6UDuD7E0XjxY3r ";
    $token = "075036763612";
    $timeStamp = "1409304348";
    $nonce = "xxxxxx";
    $appId = "wx7c1c9c18cbe29e05";
    $text = "<xml><ToUserName><![CDATA[oia2Tj我是中文jewbmiOUlr6X-1crbLOvLw]]></ToUserName><FromUserName><![CDATA[gh_7f083739789a]]></FromUserName><CreateTime>1407743423</CreateTime><MsgType><![CDATA[video]]></MsgType><Video><MediaId><![CDATA[eYJ1MbwPRJtOvIEabaxHs7TX2D-HV71s79GUxqdUkjm6Gs2Ed1KF3ulAOA9H1xG0]]></MediaId><Title><![CDATA[testCallBackReplyVideo]]></Title><Description><![CDATA[testCallBackReplyVideo]]></Description></Video></xml>";
    
    //创建对象
    $pc = new WXBizMsgCrypt($token, $encodingAesKey, $appId);
    //信息加密
    $encryptMsg = '';
    $errCode = $pc->encryptMsg($text, $timeStamp, $nonce, $encryptMsg);
    if ($errCode == 0) {
        print("加密后: " . $encryptMsg . "\n");
    } else {
        print($errCode . "\n");
    }
    
    //
    $xml_tree = new DOMDocument();
    $xml_tree->loadXML($encryptMsg);
    $array_e = $xml_tree->getElementsByTagName('Encrypt');
    $array_s = $xml_tree->getElementsByTagName('MsgSignature');
    $encrypt = $array_e->item(0)->nodeValue;
    $msg_sign = $array_s->item(0)->nodeValue;
    
    $format = "<xml><ToUserName><![CDATA[toUser]]></ToUserName><Encrypt><![CDATA[%s]]></Encrypt></xml>";
    $from_xml = sprintf($format, $encrypt);
    
    // 第三方收到公众号平台发送的消息
    $msg = '';
    $errCode = $pc->decryptMsg($msg_sign, $timeStamp, $nonce, $from_xml, $msg);
    if ($errCode == 0) {
        print("解密后: " . $msg . "\n");
    } else {
        print($errCode . "\n");
    }