<?php
    require'conn.php';
    session_start();
    //获取产品信息
    $proId = $_POST['proId'];
//  $proId = 38;
    //数量
    $num = $_POST['num'];
//  $num = 12;
    //获取用户信息[用户id]
    $useId = $_SESSION['UseId'];
//  $useId = 1;
    //当前时间
    $time = date('Y-m-d H:i:s');
    
    $sql_check = "SELECT id from 回收车 where `产品信息id` = '".$proId."' and `用户信息id` = '".$useId."' ";
    $result = $conn->query($sql_check)->fetch_assoc();
    //如果存在数据信息
    if(!(isset($result['id']))){
        
        $sql_insert = "insert into 回收车 (产品信息id,用户信息id,产品数量,下单时间) values('".$proId."','".$useId."','".$num."','".$time."')";
        $conn->query($sql_insert);
    }
    //否则需要新建数据信息
    else{
        $sql_update = "update 回收车 set 产品数量 = '".$num."' where id = '".$result['id']."' ";
        $conn->query($sql_update);
    }
