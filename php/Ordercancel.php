<?php
 	header("Access-Control-Allow-Origin: *");
    session_start();
    require('conn.php');
    $useId = $_SESSION['UseId'];
    $num=$_POST['num'];
//  $num='1539021012252';
    $sql="SELECT id from `订单信息` where 订单号='".$num."'";
    $result = $conn->query($sql)->fetch_assoc();
    $id=$result['id'];
    $sql_del1="DELETE FROM 订单详情  where 订单id='".$id."'";
    $sql_del="DELETE FROM 订单信息  where 订单号='".$num."'";
    $result1 = $conn->query($sql_del1);
    $result = $conn->query($sql_del);
    $data['status']="error";
    if($result&&$result1){
    	$data['status']="success";
    }
    $json = json_encode($data);
    echo $json;
?>