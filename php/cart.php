<?php
    header("Access-Control-Allow-Origin: *");
    session_start();
    require('conn.php');
//  $useId = $_SESSION['UseId'];
    $useId = 1;
    
    //检测数据库中为0的数据，若有则删除
    $sql_del = "delete from 回收车 where 产品数量=0 and 用户信息id='".$useId."'";
    $conn->query($sql_del);
    
    //获取产品类型
    $sql02 = "select * from `查询回收车` where 用户信息id='".$useId."'  group by 类型id";
    $result02 = $conn->query($sql02);
    $data['type'] = array();
//  echo $sql02;
    if($result02->num_rows>0)
    {
        $i = 0;
        while($row = $result02->fetch_assoc())
        {
            $data['type'][$i]['name'] = $row['类型名'];
            $data['type'][$i]['TypeId'] = $row['类型id'];
            $i++;
        }
//      print_r($data);
//      echo '<br/>';
    }
    //获取数据
    foreach($data['type'] as $v)
    {
        $Mid = $v['TypeId'];
        $sql01 = "select * from `查询回收车` where 类型id = '".$Mid."' and 用户信息id='".$useId."'";
        $result01 = $conn->query($sql01);
        $i=0;
        if($result01->num_rows>0)
        {
            while($row = $result01->fetch_assoc())
            {
//              if($row['产品数量'] > 0){
                    $data[$Mid][$i]['ReturnId'] = $row['回收id'];
                    $data[$Mid][$i]['id'] = $row['产品信息id'];
                    $data[$Mid][$i]['name'] = $row['产品名称'];
                    $data[$Mid][$i]['url'] = $row['展示图'];
                    $data[$Mid][$i]['num'] = $row['产品数量'];
                    $data[$Mid][$i]['price'] = $row['价格'];
                    $data[$Mid][$i]['else'] = $row['内容摘要'];
//              }
                $i++;
            }
        }
    }
    
    $json = json_encode($data);
    echo $json;