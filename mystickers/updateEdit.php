<?php
require_once('./db.inc.php');


$sql = "UPDATE `stickers` 
        SET 
        `id` = ?, 
        `sCid` = ?,
        `sName` = ?";

//先對其它欄位進行資料繫結設定
$arrParam = [
    $_POST['id'],
    $_POST['sCid'],
    $_POST['sName'],
];       

            // echo '<pre>';
            // print_r($_POST['sCid']);
            // echo '</pre>';
            // exit();
            
//判斷檔案上傳是否正常，error = 0 為正常
if( $_FILES["sImgName"]["error"] === 0 ) {

    //為上傳檔案命名
    $strDatetime = date("YmdHis");
    $extension = pathinfo($_FILES["sImgName"]["name"], PATHINFO_EXTENSION);
    $Img = $strDatetime.".".$extension;

    //若上傳成功，則將上傳檔案從暫存資料夾，移動到指定的資料夾或路徑
    if( move_uploaded_file($_FILES["sImgName"]["tmp_name"], "./line/".$Img) ) {

        /**
         * 刪除先前的舊檔案: 
         * 一、先查詢出特定 id (editId) 資料欄位中的大頭貼檔案名稱
         * 二、刪除實體檔案
         * 三、更新成新上傳的檔案名稱
         *  */ 

        //先查詢出特定 id (editId) 資料欄位中的大頭貼檔案名稱
        $sqlGetImg = "SELECT `sImgName` FROM `stickers` WHERE `id` = ? ";
    
        //加入繫結陣列
        $arrGetImgParam = [
            (int)$_POST['editId']
        ];

        //執行 SQL 語法
        $stmtGetImg = $pdo->prepare($sqlGetImg);
        $stmtGetImg->execute($arrGetImgParam);

        
        //若有找到 studentImg 的資料  *(先確認有改到資料)
        if($stmtGetImg->rowCount() > 0) {
            //取得指定 id 的學生資料 (1筆) *(再讀取資料 [效能較好])
            $arrImg = $stmtGetImg->fetchAll(PDO::FETCH_ASSOC);

            //若是 studentImg 裡面不為空值，代表過去有上傳過
            if($arrImg[0]['sImgName'] !== NULL){
                //刪除實體檔案
                //@ 是為了抑制出錯 讓程式往下走, 若是指定的路徑沒有檔案則會無法刪除 , 就會出錯 
                @unlink("./images/".$arrImg[0]['sImgName']);
            } 
            
            /**
             * 因為前面 `studentDescription` = ? 後面沒有加「,」，
             * 若是這裡有更新 studentImg 的需要，
             * 代表 `studentDescription` = ? 後面缺一個「,」，
             * 不然會報錯
             */

             //像 +=
            $sql.= ",";

            //studentImg SQL 語句字串
            $sql.= "`sImgName` = ? ";

            //僅對 studentImg 進行資料繫結
            //push到 陣列最後
            $arrParam[] = $Img;
            
        }
    }
}

//SQL 結尾
$sql.= " WHERE `id` = ? ";
$arrParam[] = (int)$_POST['editId'];

$stmt = $pdo->prepare($sql);


        // echo "<pre>";
        // print_r($sql);
        // print_r($arrParam);
        // echo "</pre>";
        // exit();

$stmt->execute($arrParam);

if( $stmt->rowCount() > 0 ){
    header("Refresh: 3; url=./admin.php");
    require_once('./cat.php');
    echo   '更新成功 \˙o˙/';
    exit();
} else {
    header("Refresh: 3; url=./admin.php");
    echo "沒有任何更新";
    exit();
}

