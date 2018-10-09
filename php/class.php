<?php
    header("Access-Control-Allow-Origin: *");
    session_start();
    require('conn.php');
    //获取产品类型
    $sql02 = "select * from `产品类型` ";
    $result02 = $conn->query($sql02);
    $data['type'] = array();
    
    $useId = $_SESSION['UseId'];
//  $useId = 1;
    
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
                    $data[$row['id']][$y]['ProId'] = $row2['id'];
                    $data[$row['id']][$y]['name'] = $row2['产品名称'];
                    $data[$row['id']][$y]['unit'] = $row2['单位'];
                    $data[$row['id']][$y]['price'] = $row2['价格'];
                    $data[$row['id']][$y]['else'] = $row2['内容摘要'];
                    $data[$row['id']][$y]['url'] = $row2['展示图'];
//                  //获取回收车中的数量信息
                    $sql_Cart = "SELECT 产品数量 from 回收车 where `产品信息id` = '".$row2['id']."' and `用户信息id` = '".$useId."' ";
                    $resultCart = $conn->query($sql_Cart)->fetch_assoc();
                    if(isset($resultCart['产品数量']))
                    {
                        $data[$row['id']][$y]['num'] = $resultCart['产品数量'];
                    }else{
                        $data[$row['id']][$y]['num'] = 0;
                    }
                    
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
