<?php
 header("Access-Control-Allow-Origin: * ");
    session_start();
    $MId = $_POST['data'];
//  $MId = '25@26';
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
    for($i=0;$i<count($dataArr);$i++){
    $sql="select 交易确认状态 ,订单id FROM `查询订单详情`WHERE `订单id`='".$dataArr[$i]."'";
    $result = $conn->query($sql)->fetch_assoc();
    $data[$i]['static'] = $result['交易确认状态'];
    $data[$i]['number']=$result['订单id'];
//  $static=json_encode($result['交易确认状态'], JSON_UNESCAPED_UNICODE);
//  if($static=="待核实"){
//  	echo '1230';
//  }
//  else{
//  	
//  }
//  if($static=='待收货'){
//  	echo($static);
//  }
// echo $static;
}
    $data['RowNum'] = count($dataArr);
    $json = json_encode($data);
    echo $json;
    
?>