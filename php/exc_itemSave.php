<?php
    header("Access-Control-Allow-Origin: *");
    session_start();
    require'conn.php';
//  session_start();
    //获取信息
    $ProNum = $_POST['ProNum'];
    $ExcId = $_POST['ExcId'];
    $UseId = $_SESSION['UseId'];
//  $UseId = '1';
    $time = date('Y-m-d H:i:s');
    //查询【检查是否存在此产品】
//  $sql = "select 下单时间 from 回收车 where 下单时间='".$time."'";
    $sql = "select 下单时间,商品数量 from 积分购物车 where 用户信息id='".$UseId."' and 积分商品id = '".$ExcId."'";
    $result = $conn->query($sql)->fetch_assoc();
    //产品数量
    $ProNumOld = $result['商品数量'];
    //如果存在此产品则更新信息
        if($ProNumOld)
        {
            $ProNum += $ProNumOld;
            $sql_SaveMes = "update 积分购物车 set 商品数量 = '".$ProNum."',下单时间 = '".$time."' where 积分商品id = '".$ExcId."' and 用户信息id = '".$UseId."'";
            $result = $conn->query($sql_SaveMes);
        }
    //如果不存在此产品则新建信息
        else{
            //save mes 
            $sql_SaveMes = "insert into 积分购物车 (商品数量,积分商品id,用户信息id,下单时间) values( '".$ProNum."','".$ExcId."','".$UseId."','".$time."' )";
            $result = $conn->query($sql_SaveMes);
        }
    
    //查询【检查更新是否成功】
    $sql = "select 下单时间 from 积分购物车 where 下单时间='".$time."'";
    $result = $conn->query($sql);
    $data['status'] = 'error';
    if($result->num_rows>0)
    {
        $data['status'] = 'success';
    }
    $json = json_encode($data);
    echo $json;
