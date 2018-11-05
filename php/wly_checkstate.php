<?php
header("Access-Control-Allow-Origin: * ");
    session_start();
    $useId = $_SESSION['UseId'];
//  $useId = 1;
    require('conn.php');
    $flag = $_POST['flag'];
    $sql="select `用户级别id` from 用户信息 where id='".$useId."'";
    $result = $conn->query($sql)->fetch_assoc();
    switch($flag)
   {
   	case 'get':
   	$state= $_POST['state'];
    $id = $_POST['id'];
    $data['status'] = 'error';
    if($result['用户级别id']=='3'){
    $sql101="update `查询订单详情` set `交易确认状态`= '".$state."' where `订单id` = '".$id."' ";
    $result101 = $conn->query($sql101);
    $data['status'] = 'error';
        if($result101){
            $data['status'] = 'success';
        }
    }
    $json = json_encode($data);
    echo $json;
    break;
//  管理员的待核实
//  case 'che':
//   $state= $_POST['state'];
//   $id = $_POST['id'];
////   $state= '待收货';
////   $id = '25';
//	$data['status'] = 'error';
//	 if($result['用户级别id']=='1'){
//   $sql102="update `查询订单详情` set `交易确认状态`= '".$state."' where `订单id` = '".$id."' ";
//   $result102 = $conn->query($sql102);
//   $data['status'] = 'error';
//      if($result102){
//          $data['status'] = 'success';
//      }
//  }
//  $json = json_encode($data);
//  echo $json;
//   break;
	default:break;
	}
?>