<?php 
require_once('./checkSession.php');
require_once("./db.inc.php");

// 確認有上傳圖片
if( $_FILES['Img']['error'] == 0){
    
    $adImg= date('YmdHis');
    $extension = pathinfo($_FILES['Img']['name'], PATHINFO_EXTENSION);
    $imgFileName = $adImg.".".$extension;

    //確認圖片移動成功
    if( !move_uploaded_file($_FILES['Img']['tmp_name'], "./images/".$imgFileName) ){
        header("Refresh: 3; url=./new.php");
        echo "上傳失敗! 返回";
        exit();
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

        //在把ad寫進資料庫
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
            header("Refresh: 3; url=./setting.php");
            echo "上傳成功 \˙o˙/";
            

        } else {
            header("Refresh: 3; url=./new.php");
            echo "上傳失敗 ˊ-ˋ";
            exit();
        }
    }else {
        header("Refresh: 3; url=./new.php");
        echo "Plan上傳失敗 ˊ-ˋ";
        exit();
    }

}else {
    header("Refresh: 3; url=./new.php");
    echo "請上傳圖片 ˊ-ˋ";
    exit();
}