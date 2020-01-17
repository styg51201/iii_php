<?php
require_once('./db.inc.php'); 

$sql = "INSERT INTO `class` (`cName`) VALUES (?)";

$arrParam=[ $_POST['cName']];


$stmt = $pdo->prepare($sql);
$stmt->execute($arrParam);

if($stmt->rowCount() > 0){
    header("Refresh: 3; url=./newClass.php");
    require_once('./cat.php');
    echo   '新增成功 \˙o˙/';
}
