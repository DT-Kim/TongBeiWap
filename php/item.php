<?php
    header("Access-Control-Allow-Origin: *");
    session_start();
	require('conn.php');
	$id=$_POST['id'];
//	$id = 39;
	$UseId = $_SESSION['UseId'];
//	$UseId =1;
//	$id='35';
//产品轮播
    $sql01 ="select * from 产品轮播图  where 产品信息id='".$id."' AND 有效状态 = 0 order by 位置信息";
    $result01 = $conn->query($sql01);
    $data['ad'] = array();
    if($result01->num_rows>0)
    {
        $i = 0;
        while($row = $result01->fetch_assoc())
        {
            $data['ad'][$i]['url'] = $row['图片地址'];
            $data['ad'][$i]['else'] = $row['图片说明'];
//          $data['ad'][$i]['sta'] = $row['热门状态'];
            $i++;
        }
//      print_r($data) ;
//      echo '<br/>';
    }
     //图文详情
    $sql02 ="select *  from 产品信息  where id ='".$id."'";
    $result02 = $conn->query($sql02)->fetch_assoc();
    $data['mes'] = array();
    $data['mes']['content'] = $result02['介绍'];
    
    $data['mes']['ProName'] = $result02['产品名称'];
    $data['mes']['ProUnit'] = $result02['单位'];
    $data['mes']['ProPrice'] = $result02['价格'];
    $data['mes']['ProPic'] = $result02['展示图'];
    $data['mes']['ProCode'] = $result02['积分倍数'];
    $ProHot = '非热门';
    if($result02['热门状态'])
    {
        $ProHot = '热门';
    }
    $data['mes']['ProHot'] = $ProHot;
    $data['mes']['ProText'] = $result02['内容摘要'];
//      print_r($data) ;
//      echo '<br/>';
    //产品数量
    $sql_Cart = "SELECT 产品数量 from 回收车 where `产品信息id` = '".$id."' and `用户信息id` = '".$UseId."' ";
    $resultCart = $conn->query($sql_Cart)->fetch_assoc();
    if(isset($resultCart['产品数量'])){
        $data['mes']['ProNum'] = $resultCart['产品数量'];
    }else{
        $data['mes']['ProNum'] = 0;
    }

    $json = json_encode($data);
    echo $json;   
?>