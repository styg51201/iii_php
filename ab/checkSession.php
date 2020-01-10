<?php
session_start();

    //判斷是否透過登入連結到頁面的 
    if(!isset($_SESSION['username']) ){
        //關閉 session
        session_destroy();

        header('Refresh:3 ; url=./index.php');
        echo '請確實登入!! ˋOˊ ';
        exit();
    }