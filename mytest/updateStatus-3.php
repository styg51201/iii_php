<?php
require_once('./checkSession.php');
require_once('./db.inc.php');


// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// exit();


$sql = 'UPDATE `ad`
        SET `Status` = ?
        WHERE `Id` = ? ';

$sqlTime = 'UPDATE `ad` SET `OnTime` = ? WHERE `Id`= ?';

$count = 0;


for ($i= 0 ; $i < count($_POST['editId']) ; $i++){
    if( $_POST['Status'][$i] !== $_POST['editStatus'.$i] ){
        
            
            $arr = [$_POST['editStatus'.$i],
                    $_POST['editId'][$i]];

            $stmt = $pdo->prepare($sql);
            $stmt->execute($arr);

        // echo "<pre>";
        // print_r($arr[0]);
        // echo "</pre>";
        // exit();

            if( $arr[0]=='上架'){
                $arrTime = [date('Y-m-d H:i'),
                            $_POST['editId'][$i]];
                $stmtTime = $pdo->prepare($sqlTime);
                $stmtTime->execute($arrTime);
            }
            $count+=1;
    }
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