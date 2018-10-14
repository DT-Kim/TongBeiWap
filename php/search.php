<?php
	require('conn.php');
	$a = $_POST["fname"];
	$i = 0;
	$sql = 'SELECT 产品名称 FROM 产品信息 WHERE 产品名称  Like "%'.$a.'%"';

    if($result = mysqli_query($conn,$sql))
	{// 一条条获取
		while($row=mysqli_fetch_row($result))
		{
			$data[$i] = $row[0];
			$i++;
		}
	}		
	
	//判断是否有值                     
	$data['status'] = 'error';
	if(i){
		$data['status'] = 'success';
	}

	$json = json_encode($data);
	echo $json; 
?>