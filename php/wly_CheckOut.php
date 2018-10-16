<?php
    header("Access-Control-Allow-Origin: *");
    session_start();
    //显示订单信息
    $MId = $_POST['data'];
//  $MId = '25';
//  $useId = $_SESSION['UseId'];
    $useId = 1;
    //数据处理
    $domain = strstr($MId, '@'); 
    if($domain)
    {
        $dataArr = explode('@',$MId);
    }else{
        $dataArr[0] = $MId;
    }
    
    require'conn.php';
    //数据查询【回收车订单确认】
      $i=0;
    while($i<count($dataArr))
    {   
        $sql = "select * from 查询订单详情  where 订单id = '".$dataArr[$i]."'";
        $result = $conn->query($sql);
        $data['get'] = array();
         if($result->num_rows>0)
        {
//      $result = $conn->query($sql)->fetch_assoc();
         $a = 0;
        while($row = $result->fetch_assoc())
        {
        $data[$i]['get'][$a]['ordernum'] = $row['订单号'];
        $data[$i]['get'][$a]['name'] = $row['产品名称'];
        $data[$i]['get'][$a]['price'] = $row['价格'];
        $data[$i]['get'][$a]['unit'] = $row['单位'];
        $data[$i]['get'][$a]['num'] =$row['产品数量'];
        $data[$i]['get'][$a]['code'] = $row['积分总数'];
        $data[$i]['get'][$a]['Img'] = $row['展示图'];
        $data[$i]['get'][$a]['remark'] = $row['备注'];

            $a++; 
       }
//      $data['RowNum'] =0; 
        $data[$i]['RowNum']=0+count($data[$i]['get']);
       }
        
        $i++;
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
    
    $data['status'] = 'error';
    if($data[0]['get'][0]['name']){
        $data['status'] = 'success';
    }
    $data['Row'] = count($dataArr);
    //返回信息
   
    $json = json_encode($data);
    echo $json;
