<?php
    header("Access-Control-Allow-Origin: *");
    session_start();
	require('conn.php');
	$id=$_POST['id'];
//	$id='14';
//产品轮播
    $sql01 ="select * from 商品轮播图  where 商品id='".$id."'order by 位置信息";
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
    $sql02 ="select *  from 积分商品  where id ='".$id."'";
    $result02 = $conn->query($sql02)->fetch_assoc();
    $data['mes'] = array();
    $data['mes']['content'] = $result02['详细内容'];
    $data['mes']['ProName'] = $result02['商品名称'];
    $data['mes']['ProUnit'] = $result02['单位'];
//  $data['mes']['ProPrice'] = $result02['价格'];
    $data['mes']['ProPic'] = $result02['展示图'];
    $data['mes']['ProCode'] = $result02['积分要求'];
    $ProHot = '非热门';
    if($result02['热门状态']=='是')
    {
        $ProHot = '热门';
    }
    $data['mes']['ProHot'] = $ProHot;
    $data['mes']['ProText'] = $result02['商品描述'];
//      print_r($data) ;
//      echo '<br/>';
    $json = json_encode($data);
    echo $json;   
?>