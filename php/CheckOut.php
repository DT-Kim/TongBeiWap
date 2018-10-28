<?php
    header("Access-Control-Allow-Origin: *");
    session_start();
    //显示订单信息
    $useId = $_SESSION['UseId'];
    require'conn.php';
    $flag=$_POST['flag'];
//  $flag='exc';
    switch($flag){
    	case 'pro':
	    	$MId = $_POST['data'];
		//  $MId = '19@18';
		    //数据处理
		    $domain = strstr($MId, '@'); 
		    if($domain)
		    {
		        $dataArr = explode('@',$MId);
		    }else{
		        $dataArr[0] = $MId;
		    }
		    //数据查询【回收车订单确认】
		    for($i=0;$i<count($dataArr);$i++)
		    {
		        $sql = "select * from 查询回收车 where 回收id = '".$dataArr[$i]."'";
		        $result = $conn->query($sql)->fetch_assoc();
		        $data[$i]['name'] = $result['产品名称'];
		        $data[$i]['price'] = $result['价格'];
		        $data[$i]['unit'] = $result['单位'];
		        $data[$i]['num'] = $result['产品数量'];
		        $data[$i]['code'] = $result['积分倍数'];
		        $data[$i]['Img'] = $result['展示图'];
		    }
		    //数据查询【用户个人信息】
		    $sql_Peo = "SELECT * FROM 用户信息 where id = '".$useId."'";
		    $result_Peo = $conn->query($sql_Peo)->fetch_assoc();
		    $data['peo']['name']  = $result_Peo['真实姓名'];
		    $data['peo']['phone'] = $result_Peo['用户手机'];
		    $data['peo']['local'] = $result_Peo['详细地址'];
		    $data['peo']['cityP'] = $result_Peo['省'];
		    $data['peo']['cityC'] = $result_Peo['市'];
		    $data['peo']['cityA'] = $result_Peo['县'];
//		    $data['peo']['excsum'] = $result_Peo['总积分'];
		    
		    $data['status'] = 'error';
		    if($data[0]['name']){
		        $data['status'] = 'success';
		    }
		    $data['RowNum'] = count($dataArr);
		    //返回信息
		    $json = json_encode($data);
		    echo $json;
		    break;
		    case 'exc':
		    	 $MId = $_POST['data'];
			//   $MId = '19@18';
			    //数据处理
			     $domain = strstr($MId, '@'); 
			     if($domain)
			     {
			        $dataArr = explode('@',$MId);
			     }else{
			        $dataArr[0] = $MId;
			     }
			    //数据查询【回收车订单确认】
			    for($i=0;$i<count($dataArr);$i++)
			    {
			        $sql = "select * from 查询商品购物车 where 购物车id = '".$dataArr[$i]."'";
			        $result = $conn->query($sql)->fetch_assoc();
			        $data[$i]['name'] = $result['商品名称'];
//			        $data[$i]['price'] = $result['价格'];
			        $data[$i]['unit'] = $result['单位'];
			        $data[$i]['num'] = $result['商品数量'];
			        $data[$i]['req'] = $result['积分要求'];
			        $data[$i]['Img'] = $result['展示图'];
			    }
			    //数据查询【用户个人信息】
			    $sql_Peo = "SELECT * FROM 用户信息 where id = '".$useId."'";
			    $result_Peo = $conn->query($sql_Peo)->fetch_assoc();
			    $data['peo']['name']  = $result_Peo['真实姓名'];
			    $data['peo']['phone'] = $result_Peo['用户手机'];
			    $data['peo']['local'] = $result_Peo['详细地址'];
			    $data['peo']['cityP'] = $result_Peo['省'];
			    $data['peo']['cityC'] = $result_Peo['市'];
			    $data['peo']['cityA'] = $result_Peo['县'];
//			    $data['peo']['excsum'] = $result_Peo['总积分'];
			    
			    $data['status'] = 'error';
			    if($data[0]['name']){
			        $data['status'] = 'success';
			    }
			    $data['RowNum'] = count($dataArr);
			    //返回信息
			    $json = json_encode($data);
			    echo $json;
			    break;
			    //直接兑换
			case 'checkitem':
//			    $useId='1';
			    $excid=$_POST['id'];
				$sql_Peo = "SELECT * FROM 用户信息 where id = '".$useId."'";
				$result_Peo = $conn->query($sql_Peo)->fetch_assoc();
				$sql = "SELECT id FROM 积分购物车  where 积分商品id = '".$excid."'";
				$result= $conn->query($sql)->fetch_assoc();
				$data['cartid']=$result['id'];
				$data['item']['excsum'] = $result_Peo['总积分'];
				$json = json_encode($data);
			    echo $json;
			    break;
			    //购物车兑换时
			case 'checkitem2':
//			    $useId='1';
				$sql_Peo = "SELECT * FROM 用户信息 where id = '".$useId."'";
				$result_Peo = $conn->query($sql_Peo)->fetch_assoc();
				$data['item']['excsum'] = $result_Peo['总积分'];
				$json = json_encode($data);
			    echo $json;
			    break;
			default:break;
}