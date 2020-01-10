<?php
require_once('./checkSession.php');
require_once('./db.inc.php');

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// exit();


$sql = "DELETE FROM `students` WHERE `id` = ? ";


//$sql 用for去改變
// for( $i = 1; $i < count($_POST['chk']); $i++){
//     $sql.=" OR `id` = ?";
// }
// // echo "<pre>";
// // print_r($sql);
// // echo "</pre>";
// // echo "<pre>";
// // print_r($_POST);
// // echo "</pre>";

// // exit();

// $stmt = $pdo->prepare($sql);
// $stmt->execute($_POST['chk']);


// if( $stmt->rowCount() > 0 ){
//     header("Refresh: 3; url=./admin.php");
//     echo "刪除成功";
//     } else {
//         header("Refresh: 3; url=./admin.php");
//         echo "刪除失敗";
//     }




//用來確認刪除的列數是否一致
$count = 0;

$sqlGetImg = "SELECT `studentImg` FROM `students` WHERE `id` = ? ";
$stmtGetImg = $pdo->prepare($sqlGetImg);


for( $i = 0; $i < count($_POST['chk']); $i++ ){

    //先刪除實體圖片檔
    $arrGetImgParam = [
        (int)$_POST['chk'][$i]
    ];
    
    $stmtGetImg->execute($arrGetImgParam);

    if($stmtGetImg->rowCount() > 0){
         $arrImg = $stmtGetImg->fetchAll(PDO::FETCH_ASSOC)[0];
        if( $arrImg['studentImg'] !== NULL ){
                @unlink("./files/".$arrImg['studentImg']);
        }
    }

    //刪除資料庫
    $arrParam = [
        (int)$_POST['chk'][$i]
    ];

    $stmt = $pdo->prepare($sql);
    $stmt->execute($arrParam);

    $count += $stmt->rowCount();

}

if( $count > 0 ){
    header("Refresh: 3; url=./admin.php");
    echo "刪除成功";
} else {
    header("Refresh: 3; url=./admin.php");
    echo "刪除失敗";
}