<?php
require_once('./checkSession.php');
require_once('./db.inc.php');

$sqlPlan = "DELETE FROM `Plan` WHERE `id` = ?";
$arrPlan = [(int)$_POST['deleteId']];

// echo "<pre>";
//     print_r($_POST);
//     echo "</pre>";
//     exit();

$stmtPlan = $pdo->prepare($sqlPlan);
$stmtPlan->execute($arrPlan);


//先刪除實體照片檔
$sqlImg = "SELECT `img` FROM `ad` WHERE `planId` = ?";
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

    if( $arr['img'] !== NULL){
        @unlink("./images/".$arr['img']);
    }
}

$sqlAd = "DELETE FROM `ad` WHERE `planId` = ?";
$arrAd = [(int)$_POST['deleteId']];

$stmtAd = $pdo->prepare($sqlAd);
$stmtAd->execute($arrAd);

if( $stmtPlan->rowCount() > 0 || $stmtAd->rowCount() > 0 ){
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