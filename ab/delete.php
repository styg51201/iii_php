<?php
require_once('./checkSession.php');
require_once('./db.inc.php');

//先刪除實體照片檔
$sqlImg = "SELECT `studentImg` FROM `students` WHERE `id` = ?";
$stmtImg = $pdo->prepare($sqlImg);

//確認有沒有錯誤
// if( !$stmtGetImg ){
//     echo "<pre>";
//     print_r($pdo->errorInfo());
//     echo "</pre>";
//     exit();
// }

$arrImg= [(int)$_GET['deleteId']];

$stmtImg->execute($arrImg);

if( $stmtImg->rowCount() > 0 ){
    $arr = $stmtImg->fetchAll(PDO::FETCH_ASSOC)[0];

    if( $arr['studentImg'] !== NULL){
        @unlink("./file/".$arr['studentImg']);
    }
}

$sql = "DELETE FROM `students` WHERE `id` = ?";
$arrParam = [(int)$_GET['deleteId']];

$stmt = $pdo->prepare($sql);
$stmt->execute($arrParam);

if( $stmt->rowCount() > 0){
    header("Refresh: 3; url=./admin.php");
    echo "刪除成功 \^o^/";
    exit();
} else {
    header("Refresh: 3; url=./admin.php");
    echo "刪除失敗 ˊ.ˋ";
    exit();
}
