<?php
    header("Access-Control-Allow-Origin: *");
    session_start();
    require('conn.php');
    //用户id
    $useId = $_SESSION['UseId'];
//  $useId = 1;
    //其他信息
    $province = $_POST['province'];
    $city = $_POST['city'];
    $district = $_POST['district'];
    $PeoName = $_POST['PeoName'];
    $PeoPhone = $_POST['PeoPhone'];
    $localD = $_POST['localD'];
    
    //操作数据库相关用户的信息
    $sql = "update 用户信息 set `用户手机` = '".$PeoPhone."',`真实姓名` = '".$PeoName."',省 = '".$province."',市 = '".$city."',县 = '".$district."',详细地址 = '".$localD."' where id = '".$useId."'";
    $result = $conn->query($sql);
    //处理返回值
    $data['status'] = 'error';
    if($result)
    {
        $data['status'] = 'success';
    }
    
    $json = json_encode($data);
    echo $json;
