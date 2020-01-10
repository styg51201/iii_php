<?php 
require_once("./db.inc.php");

$sql = "INSERT INTO `ad` 
        (`Class`, `Name`, `Img`,`Status`) 
        VALUES (?, ?, ?, ?)";

if( $_FILES['Img']['error'] == 0){

    $studentImg= date('YmdHis');
    $extension = pathinfo($_FILES['Img']['name'], PATHINFO_EXTENSION);
    $imgFileName = $studentImg.".".$extension;

    if( !move_uploaded_file($_FILES['Img']['tmp_name'], "./images/".$imgFileName) ){
        header("Refresh: 3; url=./new.php");
        echo "上傳失敗! 返回";
        exit();
    }
    $arr=[
        $_POST['Class'],
        $_POST['Name'],
        $imgFileName,
        $_POST['Status']
    ];

    $stmt = $pdo->prepare($sql);
    $stmt->execute($arr);

    if( $stmt->rowCount() > 0 ){
        header("Refresh: 3; url=./setting.php");
        echo "上傳成功 \˙o˙/";
        exit();
    } else {
        header("Refresh: 3; url=./new.php");
        echo "上傳失敗 ˊ-ˋ";
        exit();
    }

}else {
    header("Refresh: 3; url=./new.php");
    echo "請上傳圖片 ˊ-ˋ";
    exit();
}