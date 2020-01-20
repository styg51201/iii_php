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
        $_SESSION['username'] = $_POST['username'];
        echo true;
    }else{
      
        echo false;
    }
}else {
    echo false;
}