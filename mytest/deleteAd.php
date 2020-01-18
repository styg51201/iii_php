<?php
require_once('./checkSession.php');
require_once('./db.inc.php');

//先刪除實體照片檔
$sqlImg = "SELECT `Img` FROM `ad` WHERE `Id` = ?";
$stmtImg = $pdo->prepare($sqlImg);

//確認有沒有錯誤
// if( !$stmtGetImg ){
//     echo "<pre>";
//     print_r($pdo->errorInfo());
//     echo "</pre>";
//     exit();
// }

$arrImg= [(int)$_POST['deleteId']];

$stmtImg->execute($arrImg);

if( $stmtImg->rowCount() > 0 ){
    $arr = $stmtImg->fetchAll(PDO::FETCH_ASSOC)[0];

    if( $arr['Img'] !== NULL){
        @unlink("./images/".$arr['Img']);
    }
}


$sql = "DELETE FROM `ad` WHERE `Id` = ?";

// echo "<pre>";
//     print_r($_POST);
//     echo "</pre>";
//     exit();
$arrParam = [(int)$_POST['deleteId']];


$stmt = $pdo->prepare($sql);
$stmt->execute($arrParam);

if( $stmt->rowCount() > 0){
    // header("Refresh: 3; url=./setting.php");
    // echo "刪除成功 \^o^/";
    echo true;
    exit();
} else {
    // header("Refresh: 3; url=./setting.php");
    // echo "刪除失敗 ˊ.ˋ";
    echo false;
    exit();
}