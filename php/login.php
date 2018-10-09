<?php
    session_start();
    $_SESSION['UseId'] = $_POST['UseId'];
    if(isset($_SESSION['UseId'])){
        echo 'success';
    }
