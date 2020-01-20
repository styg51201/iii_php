<?php
require_once('./checkSession.php');
require_once('./db.inc.php');


$sqlPlan = "UPDATE `plan` 
            SET 
            `name` = ?,
            `target` = ?,
            `type` = ?,
            `place` = ?,
            `cost` = ?,
            `startTime` = ?,
            `dueTime` = ?
            WHERE `id`= ?";

$arrPlan = [$_POST['name'],
            $_POST['target'],
            $_POST['type'],
            $_POST['place'],
            $_POST['cost'],
            $_POST['startTime'],
            $_POST['dueTime'],
            $_POST['id']
];
    // echo "<pre>";
    //     print_r($arrPlan);
    //     echo "</pre>";
    //     exit();
  
$stmtPlan = $pdo->prepare($sqlPlan);

        // echo "<pre>";
        // print_r($sqlPlan);
        // print_r($arrPlan);
        // echo "</pre>";
        // exit();

$stmtPlan->execute($arrPlan);



if( $stmtPlan->rowCount() > 0 ){
    echo true;
    exit();
} else {
    echo true;
    exit();
}
