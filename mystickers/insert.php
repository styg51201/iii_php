<?php 
require_once("./db.inc.php");

$sql = "INSERT INTO `stickers` 
        (`sCid`, `sName`, `sImgName`) 
        VALUES (?, ?, ?)";

if( $_FILES['sImgName']['error'] == 0){

    $studentImg= date('YmdHis');
    $extension = pathinfo($_FILES['sImgName']['name'], PATHINFO_EXTENSION);
    $imgFileName = $studentImg.".".$extension;

    if( !move_uploaded_file($_FILES['sImgName']['tmp_name'], "./line/".$imgFileName) ){
        header("Refresh: 3; url=./newStickers.php");
        echo "上傳失敗! 返回";
        exit();
    }
    $arr=[
        $_POST['sCid'],
        $_POST['sName'],
        $imgFileName,
    ];
            // echo '<pre>';
            // print_r($arr);
            // echo '</pre>';
            // exit();

    $stmt = $pdo->prepare($sql);
    $stmt->execute($arr);

    if( $stmt->rowCount() > 0 ){
        header("Refresh: 3; url=./admin.php");
        require_once('./cat.php');
        echo   '上傳成功 \˙o˙/';
        exit();
    } else {
        header("Refresh: 3; url=./admin.php");
        echo "上傳失敗 ˊ-ˋ";
        exit();
    }

}else {
    header("Refresh: 3; url=./newStickers.php");
    echo "請上傳圖片 ˊ-ˋ";
    exit();
}