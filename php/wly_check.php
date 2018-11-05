<?php
    header("Access-Control-Allow-Origin: *");
    session_start();
    require('conn.php');
    $useId = $_SESSION['UseId'];
//  $useId = 1;
    $data['status'] = 'error';
    $sql = "SELECT 用户级别id FROM 用户信息 WHERE id='".$useId."'";
	$result = $conn->query($sql)->fetch_assoc();
//	echo $result['用户级别id'];
//	if($result['用户级别id']=='3'||$result['用户级别id']=='1')
//判断是否为物流员
	if($result['用户级别id']=='3')
	{
	    $data['status']='success';
	}
//	else{
//		$data['status']='error';
//	}
	$json = json_encode($data);
    echo $json;
?>