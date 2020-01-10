<?php
require_once('./db.inc.php');


// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// exit();


$sql = 'UPDATE `ad`
        SET `Status` = ?
        WHERE `Id` = ? ';
$count = 0;

$Id=$_POST['editId'];

for ($i= 0 ; $i < count($Id) ; $i++){
    $arr=[$_POST['Status'.$Id[$i]],$Id[$i]];

    $stmt = $pdo->prepare($sql);
    $stmt->execute($arr);
    $count+=1;
}


if( $count > 0 ){
        header("Refresh: 3; url=./setting.php");
        echo "更新成功";
        exit();
    } else {
        header("Refresh: 3; url=./setting.php");
        echo "沒有任何更新";
        exit();
    }