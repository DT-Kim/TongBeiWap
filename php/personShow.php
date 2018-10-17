<?php
    header("Access-Control-Allow-Origin: *");
    session_start();
    require('conn.php');
    //用户id
    $useId = $_SESSION['UseId'];
//  $useId = 1;
    
    //查询相关用户的信息
    $sql = "select * from 用户信息  where id = '".$useId."'";
    $result = $conn->query($sql)->fetch_assoc();
    //处理返回值
    $data['status'] = 'error';
    if($result)
    {
        $data['status'] = 'success';
        $data['PeoName'] = $result['真实姓名'];
        $data['PeoPhone'] =  $result['用户手机'];
        $data['PeoBank'] =  $result['银行账户'];
        $data['picCity'] =  $result['省'].'/'.$result['市'].'/'.$result['县'];
        $data['localD'] =  $result['详细地址'];
    }
    
    $json = json_encode($data);
    echo $json;