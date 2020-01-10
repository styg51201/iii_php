<?php
//啟動 session
session_start();

header("Content-Type: text/html; chartset=utf-8");

//引用資料庫連線
require_once('./db.inc.php');

//從index.php 接收post 資料近來
if( isset($_POST['username']) && isset($_POST['pwd']) ){
    //SQL 語法
    $sql = "SELECT `username`, `pwd` ";
    $sql.= "FROM `admin` ";
    $sql.= "WHERE `username` = ? ";
    $sql.= "AND `pwd` = ? ";

    $arrParam = [
        $_POST['username'], //等於上面第一個問號
        sha1($_POST['pwd']) //等於上面第二個問號
    ];

    $pdo_stmt = $pdo->prepare($sql);
    $pdo_stmt->execute($arrParam);

    if( $pdo_stmt->rowCount() > 0 ){
        //3 秒後跳頁
        header("Refresh: 3; url=./admin.php");
        
        //將傳送過來的 post 變數資料，放到 session，
        $_SESSION['username'] = $_POST['username'];

        echo "登入成功!!! 3秒後自動進入後端頁面";
    } else {
        header("Refresh: 3; url=./index.php");
        echo "登入失敗…3秒後自動回登入頁";
    }
} else {
    header("Refresh: 3; url=./index.php");
    echo "請確實登入…3秒後自動回登入頁";
}