<?php
    header("Access-Control-Allow-Origin: *");
    session_start();
    require'conn.php';
    //获取信息
    $ProNum = $_POST['ProNum'];
    $ProId = $_POST['ProId'];
    $UseId = $_SESSION['UseId'];
//  $UseId = '1';
    @$time = date('Y-m-d H:i:s');
    //查询【检查是否存在此产品】
//  $sql = "select 下单时间 from 回收车 where 下单时间='".$time."'";
    $sql = "select 下单时间,产品数量 from 回收车 where 用户信息id='".$UseId."' and 产品信息id = '".$ProId."'";
    $result = $conn->query($sql)->fetch_assoc();
    //产品数量
    $ProNumOld = $result['产品数量'];
    //如果存在此产品则更新信息
        if($ProNumOld)
        {
            $sql_SaveMes = "update 回收车 set 产品数量 = '".$ProNum."',下单时间 = '".$time."' where 产品信息id = '".$ProId."' and 用户信息id = '".$UseId."'";
            $result = $conn->query($sql_SaveMes);
        }
    //如果不存在此产品则新建信息
        else{
            //save mes 
            $sql_SaveMes = "insert into 回收车 (产品数量,产品信息id,用户信息id,下单时间) values( '".$ProNum."','".$ProId."','".$UseId."','".$time."' )";
            $result = $conn->query($sql_SaveMes);
        }
    
    //查询【检查更新是否成功】
    $sql = "select 下单时间 from 回收车 where 下单时间='".$time."'";
    $result = $conn->query($sql);
    $data = 'error';
    if($result->num_rows>0)
    {
        $data = 'success';
    }
    echo $data;
