<?php
    header("Access-Control-Allow-Origin: *");
    session_start();
    //显示订单信息
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
    
    require'conn.php';
    //数据查询
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
    $data['status'] = 'error';
    if($data[0]['name']){
        $data['status'] = 'success';
    }
    $data['RowNum'] = count($dataArr);
    //返回信息
    $json = json_encode($data);
    echo $json;
