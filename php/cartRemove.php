<?php
    header("Access-Control-Allow-Origin: *");
    //删除回收车的产品
    $ReturnId = $_POST['MId'];
    //
    require'conn.php';
    //删除信息
    $sql = "delete from 回收车 where id = '".$ReturnId."'";
    $result = $conn->query($sql);
    if($result){
        echo 'ok';
    }
