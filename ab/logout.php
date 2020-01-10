<?php
require_once('./checkSession.php');

if( isset($_GET['logout']) && $_GET['logout'] == '1' ){
    session_destroy();
    header("Refresh: 3; url=./index.php");

    // echo "已登出";
    // 等於秀出一個html的頁面 , 取代掉醜醜的已登出字樣
    require_once('./tpl-logout.php');

    exit();
}