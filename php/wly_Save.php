<?php
    header("Access-Control-Allow-Origin: *");
    session_start();
    $MId = $_POST['data'];
    $MId = '25';
//  $useId = $_SESSION['UseId'];
    $useId = 1;
    //数据处理
    $domain = strstr($MId, '@'); 
    if($domain)
    {
        $dataArr = explode('@',$MId);
    }else{
        $dataArr[0] = $MId;
    }
    require('conn.php');
//  $useId = $_SESSION['UseId'];
    $useId = 1;
    //获取信息
   
    $text= $_POST['text'];//备注信息
    for($i=0;$i<count($dataArr);$i++)
    { 
    $sql="update `查询订单详情` set `备注`= '".$text."' where `订单id` = '".$dataArr[$i]."'";
    $result = $conn->query($sql);
    $data['status'] = 'error';
    if($result){
        $data['status'] ='success';
    }
    }
    $json = json_encode($data);
    echo $json;
