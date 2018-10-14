<?php
header("Access-Control-Allow-Origin: * ");
    session_start();
//  $useId = $_SESSION['UseId'];
    $useId = 1;
    require('conn.php');
    $flag = $_POST['flag'];
    switch($flag)
   {
   	case 'get':
   	$state= $_POST['state'];
    $id = $_POST['id'];
    $sql101="update `查询订单详情` set `交易确认状态`= '".$state."' where `订单id` = '".$id."' ";
    $result = $conn->query($sql101);
    $data['status'] = 'error';
        if($result){
            $data['status'] = 'success';
        }
        $json = json_encode($data);
        echo $json;
    break;
    case 'che':
     $state= $_POST['state'];
     $id = $_POST['id'];
     $sql102="update `查询订单详情` set `交易确认状态`= '".$state."' where `订单id` = '".$id."' ";
     $result = $conn->query($sql102);
     $data['status'] = 'error';
        if($result){
            $data['status'] = 'success';
        }
        $json = json_encode($data);
        echo $json;
     break;
	default:break;
	}
?>