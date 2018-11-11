<?php
	header("Access-Control-Allow-Origin: *");
    session_start();
    require('conn.php');
    $useId = $_SESSION['UseId'];
//  $useId = 1;
 		$sql_sel = "select * from 积分商品 where 1=1 ";
        $result_sel = $conn->query($sql_sel);
        $data['exc'] = array();
        if($result_sel->num_rows > 0)
        {
            $i = 0;
            while($row = $result_sel->fetch_assoc())
            {
                $data['exc'][$i]['id'] = $row['id'];
                $data['exc'][$i]['excName'] = $row['商品名称'];
                $data['exc'][$i]['excreq'] = $row['积分要求'];
                $data['exc'][$i]['excunit'] = $row['单位'];
                $data['exc'][$i]['exchot'] = $row['热门状态'];
                $data['exc'][$i]['excsta'] = $row['商品状态'];
                $data['exc'][$i]['exctext'] = $row['详细内容'];
                $data['exc'][$i]['excElse'] = $row['商品描述'];
                $data['exc'][$i]['url'] = $row['展示图'];
                //获取回收车中的数量信息
                    $sql_Cart = "SELECT 商品数量 from 积分购物车 where `积分商品id` = '".$row['id']."' and `用户信息id` = '".$useId."' ";
                    $resultCart = $conn->query($sql_Cart)->fetch_assoc();
                    if(isset($resultCart['商品数量']))
                    {
                        $data['exc'][$i]['num'] = $resultCart['商品数量'];
                    }else{
                        $data['exc'][$i]['num'] = 0;
                    }
                    
                $i++;
            }
            }
            $json = json_encode($data);
            echo $json;
?>