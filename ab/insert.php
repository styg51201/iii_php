<?php 
require_once("./checkSession.php");
require_once("./db.inc.php");

$sql = "INSERT INTO `students` 
        (`studentId`, `studentName`, `studentGender`, `studentBirthday`, `studentPhoneNumber`, `studentDescription`, `studentImg`) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";

if( $_FILES['studentImg']['error'] == 0){
    $studentImg= date('YmdHis');
    $extension = pathinfo($_FILES['studentImg']['name'], PATHINFO_EXTENSION);
    $imgFileName = $studentImg.".".$extension;

    if( !move_uploaded_file($_FILES['studentImg']['tmp_name'], "./file/".$imgFileName) ){
        header("Refresh: 3; url=./admin.php");
        echo "上傳失敗! 返回目錄";
        exit();
    }


    $arr=[
        $_POST['studentId'],
        $_POST['studentName'],
        $_POST['studentGender'],
        $_POST['studentBirthday'],
        $_POST['studentPhoneNumber'],
        $_POST['studentDescription'],
        $imgFileName //秀出的是檔名(文字) 而不是檔案(圖像)
    ];

    $stmt = $pdo->prepare($sql);
    $stmt->execute($arr);

    //判斷新增的列數超過0的話
    if( $stmt->rowCount() > 0 ){
        header("Refresh: 3; url=./admin.php");
        echo "上傳成功 \˙o˙/";
        exit();
    } else {
        header("Refresh: 3; url=./admin.php");
        echo "上傳失敗 ˊ-ˋ";
        exit();
    }
}else {
    header("Refresh: 3; url=./new.php");
    echo "請上傳圖片 ˊ-ˋ";
    exit();
}