<?php
    header("Access-Control-Allow-Origin: *");
    session_start();
    require('conn.php');
    $useId = $_SESSION['UseId'];
//  $useId = 1;
    //获取产品类型
    $sql02 = "select * from `查询商品购物车` where 用户信息id='".$useId."' and 是否付款 = 0";
    $result02 = $conn->query($sql02);
    $data['goods'] = array();
//  echo $sql02;
    if($result02->num_rows>0)
    {
        $i = 0;
        while($row = $result02->fetch_assoc())
        {
        	$data['goods'][$i]['ReturnId'] = $row['购物车id'];
            $data['goods'][$i]['name'] = $row['商品名称'];
            $data['goods'][$i]['num'] = $row['商品数量'];
	        $data['goods'][$i]['nuit'] = $row['单位'];
	        $data['goods'][$i]['req'] = $row['积分要求'];
//	        $data['goods'][$i]['content'] = $row['详细内容'];
	        $data['goods'][$i]['else'] = $row['商品描述']; 
	        $data['goods'][$i]['url'] = $row['展示图']; 
            $i++;
        }
//      print_r($data);
//      echo '<br/>';
    }
    
//  foreach($data['type'] as $v)
//  {   
//      $Mid = $v['TypeId'];
//      $sql01 = "select * from `查询回收车` where 类型id = '".$Mid."' and 用户信息id='".$useId."'";
//      $result01 = $conn->query($sql01);
//      $i=0;
//      if($result01->num_rows>0)
//      {
//          while($row = $result01->fetch_assoc())
//          {
////              if($row['产品数量'] > 0){
//                  $data[$Mid][$i]['ReturnId'] = $row['回收id'];
//                  $data[$Mid][$i]['id'] = $row['产品信息id'];
//                  $data[$Mid][$i]['name'] = $row['产品名称'];
//                  $data[$Mid][$i]['url'] = $row['展示图'];
//                  $data[$Mid][$i]['num'] = $row['产品数量'];
//                  $data[$Mid][$i]['price'] = $row['价格'];
//                  $data[$Mid][$i]['else'] = $row['内容摘要'];
////              }
//              $i++;
//          }
//      }
//  }
    
    $json = json_encode($data);
    echo $json;