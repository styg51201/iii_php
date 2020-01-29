<?php
require_once('./checkSession.php');
require_once('./db.inc.php');


// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// exit();
if($_POST['status'] == NULL){
    $_POST['status']='審核';
}

$sql = 'UPDATE `plan`
        SET `status` = ?
        WHERE `id` = ? ';
           
$arr = [$_POST['status'],
        $_POST['editId']
    ];

$stmt = $pdo->prepare($sql);
$stmt->execute($arr);

// echo "<pre>";
// print_r($arr[0]);
// echo "</pre>";
// exit();



if( $stmt->rowCount() > 0 ){
        // header("Refresh: 3; url=./setting.php");
        echo true;
        exit();
    } else {
        // header("Refresh: 3; url=./setting.php");
        echo false;
        exit();
    }
