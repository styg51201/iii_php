<?php

session_start();

//
header("Content-Type: text/html; chartset=utf-8");

//連線到資料庫 有一個變數$pdo
require_once('./db.inc.php');

if(isset($_POST['username']) && isset($_POST['pwd']) ){

    $sql='SELECT `username`,`pwd`
        FROM `admin`
        -- ? = $arrparam[0]
        WHERE `username` = ?  
        -- ? = $arrparam[1]
        AND `pwd` = ? ';
    

    $arrparam= [
        $_POST['username'],
        sha1($_POST['pwd'])
    ];

    //$pdo等於我設定的資料庫 去準備我寫好的$sql(mysql語法)
    $pdo_stmt= $pdo->prepare($sql);

    //然後執行sql語法 若有語法裡有問號 則帶參數進去
    $pdo_stmt->execute($arrparam);


    if( $pdo_stmt->rowCount() > 0){

         //3 秒後跳頁
         header("Refresh: 3; url=./admin.php");
        
         //將傳送過來的 post 變數資料，放到 session，
         $_SESSION['username'] = $_POST['username'];
 
         echo "登入成功!!! 3秒後自動進入後端頁面";

    }else {
        header("Refresh: 3; url=./index.php");
        echo "登入失敗…3秒後自動回登入頁";
    }
}else {
    header("Refresh: 3; url=./index.php");
    echo "請確實登入…3秒後自動回登入頁";
}
