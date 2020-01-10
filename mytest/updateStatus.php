<?php
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

$Id=$_POST['editId'];

for ($i= 0 ; $i < count($Id) ; $i++){
    if( $_POST['']){
        
            
            $arr = [$_POST['Status'.$Id[$i]],
                    $Id[$i]];

            $stmt = $pdo->prepare($sql);
            $stmt->execute($arr);

        // echo "<pre>";
        // print_r($arr[0]);
        // echo "</pre>";
        // exit();

            if( $arr[0]=='上架'){
                $arrTime = [date('Y-m-d H:i:s'),
                            $Id[$i]];
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