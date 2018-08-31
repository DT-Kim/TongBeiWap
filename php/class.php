<?php
    require('conn.php');
    //获取产品类型
    $sql02 = "select * from `产品类型` ";
    $result02 = $conn->query($sql02);
    $data['type'] = array();
    if($result02->num_rows>0)
    {
        $i = 0;
        while($row = $result02->fetch_assoc())
        {
            $data['type'][$i]['name'] = $row['类型名'];
            $data['type'][$i]['id'] = $row['id'];
            //获取对应产品信息
            $sql03 = "select * from `产品信息` where 产品类型id='".$row['id']."'";
            $result03 = $conn->query($sql03);
            $data[$row['id']] = array();
            if($result03->num_rows>0)
            {
                $y = 0;
                while($row2 = $result03->fetch_assoc())
                {
                    $data[$row['id']][$y]['name'] = $row2['产品名称'];
                    $data[$row['id']][$y]['unit'] = $row2['单位'];
                    $data[$row['id']][$y]['price'] = $row2['价格'];
                    $data[$row['id']][$y]['else'] = $row2['介绍'];
                    $data[$row['id']][$y]['url'] = $row2['展示图'];
                    $y++;
                }
            }
            $i++;
        }
//      print_r($data) ;
//      echo '<br/>';
    }
    
    $json = json_encode($data);
    echo $json;
