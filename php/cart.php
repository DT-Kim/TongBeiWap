<?php
    require('conn.php');
//  $useId = $_POST['useId'];
    $useId = 1;
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
                $data[$Mid][$i]['name'] = $row['产品名称'];
                $data[$Mid][$i]['url'] = $row['展示图'];
                $data[$Mid][$i]['num'] = $row['产品数量'];
                $data[$Mid][$i]['price'] = $row['价格'];
                $data[$Mid][$i]['else'] = $row['介绍'];
                $i++;
            }
        }
    }
    
    $json = json_encode($data);
    echo $json;