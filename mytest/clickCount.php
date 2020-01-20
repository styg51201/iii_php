<?php
require_once('./checkSession.php');
require_once('./db.inc.php');

// echo $_POST['count']+1;

$sqlGetClick = "SELECT `click`,`cost`
        FROM `plan`
        WHERE `id`= ?";

$arrGetClick= [$_POST['id']];

$stmtGetClick = $pdo->prepare($sqlGetClick);
$stmtGetClick->execute($arrGetClick);
$arr = $stmtGetClick->fetchAll(PDO::FETCH_ASSOC)[0];

$count = $arr['click'];
$cost = $arr['cost'];


$sqlAddClick = "UPDATE `plan`
                SET `click` = ?
                WHERE `id` = ?";

$arrAddClick = [$count+1,
                $_POST['id']
];
// echo $arrAddClick[0];
// echo $arrAddClick[1];
// exit();

$stmtAddClick = $pdo->prepare($sqlAddClick);
$stmtAddClick->execute($arrAddClick);

if( $stmtAddClick->rowCount() > 0 ){
    echo true;
}

if($cost){
    if( ($count+1)*5 == $cost || ($count+2)*5 > $cost ){
        $sqlStatus = "UPDATE `plan` SET `status` = '下架' WHERE `id` = ?";
        $arrStatus = [$_POST['id']];
        $stmtStatus= $pdo->prepare($sqlStatus);
        $stmtStatus->execute($arrStatus);
    }
}


?>