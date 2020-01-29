<?php
require_once('./checkSession.php');
require_once('./db.inc.php');

   
$sqlAd = "UPDATE `ad` 
        SET `adName` = ?,
            `title`= ?,
            `content`= ? ";

$arrAd=[$_POST['adName'],
        $_POST['title'],
        $_POST['content']];

        // echo "<pre>";
        // print_r($_FILES);
        // echo($_POST['Id']);
        // echo($_POST['Name']);
        // print_r($arrAd);
        // echo "</pre>";
        // exit();


if( isset($_FILES["img"]["error"]) && $_FILES["img"]["error"] === 0 ) {

    //為上傳檔案命名
    $strDatetime = date("YmdHis");
    $extension = pathinfo($_FILES["img"]["name"], PATHINFO_EXTENSION);
    $Img = $strDatetime.".".$extension;

    //若上傳成功，則將上傳檔案從暫存資料夾，移動到指定的資料夾或路徑
    if( move_uploaded_file($_FILES["img"]["tmp_name"], "./images/".$Img) ) {

        /**
         * 刪除先前的舊檔案: 
         * 一、先查詢出特定 id (editId) 資料欄位中的大頭貼檔案名稱
         * 二、刪除實體檔案
         * 三、更新成新上傳的檔案名稱
         *  */ 

        //先查詢出特定 id (editId) 資料欄位中的大頭貼檔案名稱
        $sqlGetImg = "SELECT `img` FROM `ad` WHERE `adId` = ? ";
    
        //加入繫結陣列
        $arrGetImgParam = [
            (int)$_POST['adId']
        ];

        //執行 SQL 語法
        $stmtGetImg = $pdo->prepare($sqlGetImg);
        $stmtGetImg->execute($arrGetImgParam);

        
        //若有找到 studentImg 的資料  *(先確認有改到資料)
        if($stmtGetImg->rowCount() > 0) {
            //取得指定 id 的學生資料 (1筆) *(再讀取資料 [效能較好])
            $arrImg = $stmtGetImg->fetchAll(PDO::FETCH_ASSOC);

            //若是 studentImg 裡面不為空值，代表過去有上傳過
            if($arrImg[0]['img'] !== NULL){
                //刪除實體檔案
                //@ 是為了抑制出錯 讓程式往下走, 若是指定的路徑沒有檔案則會無法刪除 , 就會出錯 
                @unlink("./images/".$arrImg[0]['img']);
            } 
            
            /**
             * 因為前面 `studentDescription` = ? 後面沒有加「,」，
             * 若是這裡有更新 studentImg 的需要，
             * 代表 `studentDescription` = ? 後面缺一個「,」，
             * 不然會報錯
             */

             //像 +=
            $sqlAd.= ",";

            //studentImg SQL 語句字串
            $sqlAd.= "`img` = ? ";

            //僅對 studentImg 進行資料繫結
            //push到 陣列最後
            $arrAd[] = $Img;
            
        }
    }
}

$sqlAd.= " WHERE `adId` = ? ";
$arrAd[] = (int)$_POST['adId'];

$stmtAd = $pdo->prepare($sqlAd);

        // echo "<pre>";
        // print_r($sqlAd);
        // print_r($arrAd);
        // echo "</pre>";
        // exit();

$stmtAd->execute($arrAd);

if( $stmtAd->rowCount() >0 ){
    // header("Refresh: 3; url=./setting.php");
    // echo "更新成功";
    echo true;
    exit();
} else {
    // header("Refresh: 3; url=./setting.php");
    // echo "沒有任何更新";
    echo true;
    exit();
}
