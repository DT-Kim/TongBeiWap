<?php
    header("Access-Control-Allow-Origin: *");
    session_start();
    /*更新数据库数据*/
    //获取产品id
    $ProId = $_POST['MId'];
    //获取产品数量
    $ProNum = $_POST['ProNum'];
    //用户信息
//  $UseId = $_SESSION['UseId'];
    $UseId = '1';
    require'conn.php';
    $sql = "update 回收车 set 产品数量 = ".$ProNum." where id = '".$ProId."' and 用户信息id = '".$UseId."'";
    $result = $conn->query($sql);
//  echo $sql;