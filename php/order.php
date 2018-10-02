<?php
    header("Access-Control-Allow-Origin: *");
    session_start();
    require('conn.php');
    $useId = $_POST['UseId'];
//  $useId = 1;
    //查询全部订单
    $sql01 = "select * from `查询订单详情` where `用户id` = '".$useId."' group by `订单号` ";
    $result01 = $conn->query($sql01);
    $data['all'] = array();
    
    if($result01->num_rows>0)
    {
        $i = 0;
        while($row = $result01->fetch_assoc())
        {
            $data['all'][$i]['code'] = $row['订单号'];
            $data['all'][$i]['priceA'] = $row['总金额'];
            $data['all'][$i]['type'] = $row['交易确认状态'];
            $data['all'][$i]['id'] = $row['订单id'];
            //查询信息详情
            $Mid = $row['订单id'];
            $sql = "select * from `查询订单详情` where `用户id` = '".$useId."' and 订单id = '".$Mid."'";
            $result = $conn->query($sql);
            $data['all'.$Mid] = array();
            if($result->num_rows > 0)
            {   
                $y = 0;
                while($row = $result->fetch_assoc())
                {
                    $data['all'.$Mid][$y]['name'] = $row['产品名称'];
                    $data['all'.$Mid][$y]['num'] = $row['产品数量'];
                    $data['all'.$Mid][$y]['unit'] = $row['单位'];
                    $data['all'.$Mid][$y]['price'] = $row['金额'];
//                  $data['all'.$Mid][$y]['else'] = $row['介绍'];
                    $data['all'.$Mid][$y]['type'] = $row['类型名'];
                    $data['all'.$Mid][$y]['url'] = $row['展示图'];
                    $y++;
                }
            }
            $i++;
        }
    }
    //查询待收货订单
    $sql02 = "select * from `查询订单详情` where `用户id` = '".$useId."' and 交易确认状态 = '待收货' group by `订单号`";
    $result02 = $conn->query($sql02);
    $data['get'] = array();
    if($result02->num_rows>0)
    {
        $i = 0;
        while($row = $result02->fetch_assoc())
        {
            $data['get'][$i]['code'] = $row['订单号'];
            $data['get'][$i]['priceA'] = $row['总金额'];
            $data['get'][$i]['id'] = $row['订单id'];
            //查询信息详情
            $Mid = $row['订单id'];
            $sql = "select * from `查询订单详情` where `用户id` = '".$useId."' and 订单id = '".$Mid."'";
            $result = $conn->query($sql);
            $data['get'.$Mid] = array();
            if($result->num_rows > 0)
            {   
                $y = 0;
                while($row = $result->fetch_assoc())
                {
                    $data['get'.$Mid][$y]['name'] = $row['产品名称'];
                    $data['get'.$Mid][$y]['num'] = $row['产品数量'];
                    $data['get'.$Mid][$y]['unit'] = $row['单位'];
                    $data['get'.$Mid][$y]['price'] = $row['金额'];
                    $data['get'.$Mid][$y]['else'] = $row['介绍'];
                    $data['get'.$Mid][$y]['type'] = $row['类型名'];
                    $data['get'.$Mid][$y]['url'] = $row['展示图'];
                    $y++;
                }
            }
            $i++;
        }
    }
    
    //查询待核实订单
    $sql03 = "select * from `查询订单详情` where `用户id` = '".$useId."' and 交易确认状态 = '待核实' group by `订单号`";
    $result03 = $conn->query($sql03);
    $data['che'] = array();
    if($result03->num_rows>0)
    {
        $i = 0;
        while($row = $result03->fetch_assoc())
        {
            $data['che'][$i]['code'] = $row['订单号'];
            $data['che'][$i]['priceA'] = $row['总金额'];
            $data['che'][$i]['id'] = $row['订单id'];
            //查询信息详情
            $Mid = $row['订单id'];
            $sql = "select * from `查询订单详情` where `用户id` = '".$useId."' and 订单id = '".$Mid."'";
            $result = $conn->query($sql);
            $data['che'.$Mid] = array();
            if($result->num_rows > 0)
            {   
                $y = 0;
                while($row = $result->fetch_assoc())
                {
                    $data['che'.$Mid][$y]['name'] = $row['产品名称'];
                    $data['che'.$Mid][$y]['num'] = $row['产品数量'];
                    $data['che'.$Mid][$y]['unit'] = $row['单位'];
                    $data['che'.$Mid][$y]['price'] = $row['金额'];
                    $data['che'.$Mid][$y]['else'] = $row['介绍'];
                    $data['che'.$Mid][$y]['type'] = $row['类型名'];
                    $data['che'.$Mid][$y]['url'] = $row['展示图'];
                    $y++;
                }
            }
            $i++;
        }
    }
    
    //查询已完成订单
    $sql04 = "select * from `查询订单详情` where `用户id` = '".$useId."' and 交易确认状态 = '已完成' group by `订单号`";
    $result04 = $conn->query($sql04);
    $data['fin'] = array();
    if($result04->num_rows>0)
    {
        $i = 0;
        while($row = $result04->fetch_assoc())
        {
            $data['fin'][$i]['code'] = $row['订单号'];
            $data['fin'][$i]['priceA'] = $row['总金额'];
            $data['fin'][$i]['id'] = $row['订单id'];
            //查询信息详情
            $Mid = $row['订单id'];
            $sql = "select * from `查询订单详情` where `用户id` = '".$useId."' and 订单id = '".$Mid."'";
            $result = $conn->query($sql);
            $data['fin'.$Mid] = array();
            if($result->num_rows > 0)
            {   
                $y = 0;
                while($row = $result->fetch_assoc())
                {
                    $data['fin'.$Mid][$y]['name'] = $row['产品名称'];
                    $data['fin'.$Mid][$y]['num'] = $row['产品数量'];
                    $data['fin'.$Mid][$y]['unit'] = $row['单位'];
                    $data['fin'.$Mid][$y]['price'] = $row['金额'];
                    $data['fin'.$Mid][$y]['else'] = $row['介绍'];
                    $data['fin'.$Mid][$y]['type'] = $row['类型名'];
                    $data['fin'.$Mid][$y]['url'] = $row['展示图'];
                    $y++;
                }
            }
            $i++;
        }
    }
    
    $json = json_encode($data);
    echo $json;
