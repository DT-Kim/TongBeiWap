<?php
    header("Access-Control-Allow-Origin: *");
    session_start();
    require'conn.php';
    $useId = $_SESSION['UseId'];
    $sql="SELECT `总积分` FROM 用户信息 where id = '".$useId."'";
    $result= $conn->query($sql)->fetch_assoc();
    $data['sum']=$result['总积分'];
    $json = json_encode($data);
    echo $json;
?>