<?php
    header("Access-Control-Allow-Origin: *");
    session_start();
    //获取信息
    $MId = $_POST['MId'];//产品信息
    $price = $_POST['priceAll'];//总金额
    $code = $_POST['codeAll'];//总积分
    
//  $MId = '35@34';//产品信息
//  $price = 132;//总金额
//  $code = 123;//总积分
    
    $UseId = $_SESSION['UseId'];//用户id
//  $UseId = 1;//用户id
    $time = date('Y-m-d H:i:s');//当前时间
    
    //组合订单号【订单号等于当前的毫秒级时间戳】
    list($msec, $sec) = explode(' ', microtime());
    $OrderCode =  (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);
    
    require'conn.php';
    //保存订单信息
    $sql = "insert into 订单信息 (下单时间,下单用户id,订单号,总金额,总积分) values('".$time."','".$UseId."','".$OrderCode."','".$price."','".$code."') ";
    $result = $conn->query($sql);
        //获取订单id
        $sql_CheId = "select id from 订单信息 where 下单时间 = '".$time."' and 下单用户id = '".$UseId."'";
        $result_CheId = $conn->query($sql_CheId)->fetch_assoc();
        $CaseId = $result_CheId['id'];
    
    //保存订单详情
        $domain = strstr($MId, '@'); 
        if($domain)
        {
            $dataArr = explode('@',$MId);
        }else{
            $dataArr[0] = $MId;
        }
        
        for($i=0;$i<count($dataArr);$i++)
        {
            //获取订单详情信息
            $sql_CheMes = "select * from 查询回收车  where 回收id = '".$dataArr[$i]."'";
            $result_CheMes = $conn->query($sql_CheMes)->fetch_assoc();
            
            //保存订单详情
            $ProId = $result_CheMes['产品信息id'];//产品id
            $ProNum = $result_CheMes['产品数量'];//产品数量
            $ProCode = $result_CheMes['积分倍数']*$ProNum;//产品积分
            $ProPrice = $result_CheMes['价格']*$ProNum;//产品金额
            $sql_save = "insert into 订单详情 set 产品信息id = '".$ProId."',产品数量 = '".$ProNum."',订单id = '".$CaseId."',积分总数 = '".$ProCode."',金额 = '".$ProPrice."'";
            $result = $conn->query($sql_save);
            
            //删除回收车信息
            $sql_delCar = "delete from 回收车 where 产品信息id = '".$ProId."' and 用户信息id =  '".$UseId."'";
            $result_delCar = $conn->query($sql_delCar);
        }
    
    $data['status'] = 'error';
    if($CaseId)
    {
        $data['status'] = 'success';
    }
    
    $json = json_encode($data);
    echo $json;
