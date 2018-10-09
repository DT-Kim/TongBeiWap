<?php
    header("Access-Control-Allow-Origin: *");
    session_start();
    require('conn.php');
    //获取广告轮播数据
    $sql01 = "select * from 广告轮播图  where 有效状态 = 0 and 图片状态='显示' order by 位置信息";
    $result01 = $conn->query($sql01);
    $data['ad'] = array();
    
    $useId = $_SESSION['UseId'];
//  $useId = 1;
    
    if($result01->num_rows>0)
    {
        $i = 0;
        while($row = $result01->fetch_assoc())
        {
            $data['ad'][$i]['url'] = $row['图片地址'];
            $data['ad'][$i]['else'] = $row['广告说明'];
            $data['ad'][$i]['sta'] = $row['热门状态'];
            $i++;
        }
//      print_r($data);
//      echo '<br/>';
    }
    
    //获取产品类型数据
    $sql02 = "select * from `产品类型` ";
    $result02 = $conn->query($sql02);
    $data['type'] = array();
    if($result02->num_rows>0)
    {
        $i = 0;
        while($row = $result02->fetch_assoc())
        {
            $data['type'][$i]['name'] = $row['类型名'];
            $data['type'][$i]['else'] = $row['类型介绍'];
            $data['type'][$i]['url'] = $row['图片地址'];
            $i++;
        }
//      print_r($data);
//      echo '<br/>';
    }
    //获取活动商品数据
    $sql03 = "select * from `产品信息`";
    $result03 = $conn->query($sql03);
    $data['pro'] = array();
    if($result03->num_rows>0)
    {
        $i = 0;
        while($row = $result03->fetch_assoc())
        {
            $data['pro'][$i]['id'] = $row['id'];
            $data['pro'][$i]['name'] = $row['产品名称'];
            $data['pro'][$i]['unit'] = $row['单位'];
            $data['pro'][$i]['price'] = $row['价格'];
            $data['pro'][$i]['else'] = $row['内容摘要'];
            $data['pro'][$i]['url'] = $row['展示图'];
            //获取回收车中的数量信息
            $sql_Cart = "SELECT 产品数量 from 回收车 where `产品信息id` = '".$row['id']."' and `用户信息id` = '".$useId."' ";
            $resultCart = $conn->query($sql_Cart)->fetch_assoc();
            if(isset($resultCart['产品数量'])){
                $data['pro'][$i]['num'] = $resultCart['产品数量'];
            }else{
                $data['pro'][$i]['num'] = 0;
            }
            
            
            $i++;
        }
//      print_r($data) ;
    }
    $json = json_encode($data);
    echo $json;    