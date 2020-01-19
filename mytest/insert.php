<?php 
require_once('./checkSession.php');
require_once("./db.inc.php");



    
    $adImg= date('YmdHis');
    $extension = pathinfo($_FILES['Img']['name'], PATHINFO_EXTENSION);
    $imgFileName = $adImg.".".$extension;

    //確認圖片移動成功
    if( !move_uploaded_file($_FILES['Img']['tmp_name'], "./images/".$imgFileName) ){
        // header("Refresh: 3; url=./new.php");
        echo false;
        // exit();
    }
    //先把Plan寫進資料庫
    $sqlPlan = "INSERT INTO `plan`
                (`username`,`name`,`target`,`type`,`cost`,`place`,`status`,`startTime`,`dueTime`)
                VALUE (?,?,?,?,?,?,?,?,?)";
    $arrPlan = [$_SESSION["username"],
                $_SESSION["name"],
                $_SESSION["target"],
                $_SESSION["type"],
                $_SESSION["cost"],
                $_SESSION["place"],
                $_SESSION["status"],
                $_SESSION["startTime"],
                $_SESSION["dueTime"]
    ];

    $stmtPlan= $pdo->prepare($sqlPlan);
    $stmtPlan->execute($arrPlan);

    if( $stmtPlan->rowCount() > 0 ){

        //取得plan的流水號
        $planId = $pdo->lastInsertId();

        // 在把ad寫進資料庫
        $sqlAd = "INSERT INTO `ad` 
                (`Name`, `Img`,`planId`) 
                VALUES (?, ?, ?)";

        $arrAd=[
            $_POST['Name'],
            $imgFileName,
            $planId
        ];

        $stmtAd = $pdo->prepare($sqlAd);
        $stmtAd->execute($arrAd);

        if( $stmtAd->rowCount() > 0 ){
            // header("Refresh: 3; url=./setting.php");
            // echo "上傳成功 \˙o˙/";
            echo true;
            

        } else {
            //失敗的話先刪除剛剛寫進的Plan
            $sqlDeletePlan = "DELETE FROM `plan` WHERE `id` = ?";
            $arrDeletePlan = [$planId];
            $stmtDelete = $pdo->prepare($sqlDeletePlan);
            $stmtDelete->execute($arrDeletePlan);
            echo false;
        }
    }else {
        header("Refresh: 3; url=./new.php");
        echo false;
    
    }
