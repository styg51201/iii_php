<?php
// echo "<pre>";
// print_r($_FILES["myFile"]);
// echo "</pre>";
// exit();

// 下面是  <pre> 出來的詳細資訊
// Array
// (
//     [name] => 1.png  (檔案名稱)
//     [type] => image/png    (檔案類型)
//     [tmp_name] => C:\xampp\tmp\php1B0B.tmp  (檔案暫存的位置)
//     [error] => 0   (錯誤碼為0 => 上傳成功)
//     [size] => 49648
// )


// if( $_FILES["myFile"]["error"] === 0){
    
//     //若上傳成功，則將上傳檔案從暫存資料夾，移動到指定的資料夾或路徑 
//     // move_uploaded_file($_FILES["myFile"]["tmp_name"], "./tmp/".$_FILES["myFile"]["name"]);
//     // move_uploaded_file(原始路徑,欲移動到的路徑)
//     // 有時候可能移動位置會出錯 所以要用if去判斷
//     if( move_uploaded_file($_FILES["myFile"]["tmp_name"], "./tmp/".$_FILES["myFile"]["tmp_name"])){
//                 echo "ok";
// } else {
//     echo "nothing";
// }
// }


if( $_FILES["myFile"]["error"] === 0){

    //為上傳檔案命名
    $strDatetime = date("YmdHis");

   //日期設定用法 
   //date("YmdHis")=> 20200103110823
   //date("Y-m-d H:i:s")=> 2020-01-03 11:08:23

            
    //找出副檔名
    //因為原本的name有包含附檔名 但把檔名改掉了 需要再加上副檔名
    $extension = pathinfo($_FILES["myFile"]["name"], PATHINFO_EXTENSION);

    //建立完整檔案名稱
    $strImgPath = $strDatetime.".".$extension;

    
    if( move_uploaded_file($_FILES["myFile"]["tmp_name"], "./tmp/".$strImgPath) ){
        echo "ok";
    }
} else {
    echo "nothing";
}