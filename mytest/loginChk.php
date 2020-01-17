<?php
//啟動 session
session_start();
require_once('./db.inc.php');

if( isset($_POST['username']) && isset($_POST['pwd']) ){
    $sql = "SELECT `username`, `pwd`
            FROM `admin`
            WHERE `username` = ? 
            AND `pwd` = ?";
    $arrParam= [$_POST['username'],
                sha1($_POST['pwd'])
    ];

    $stmt = $pdo->prepare($sql);
    $stmt->execute($arrParam);

    if( $stmt->rowCount() > 0 ){
        header("Refresh: 3; url=./index.php");
        $_SESSION['username'] = $_POST['username'];
        echo '登入成功';
    }else{
        header("Refresh: 3; url=./index.php");
        echo "登入失敗…3秒後自動回登入頁";
    }
}else {
    header("Refresh: 3; url=./index.php");
    echo "請確實登入…3秒後自動回登入頁";
}