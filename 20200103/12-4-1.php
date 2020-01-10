<?php
// echo "<pre>";
// print_r($_FILES["myFile"]);
// echo "</pre>";
// exit();


// 下面是  <pre> 出來的詳細資訊  二維陣列
// Array
// (
//     [name] => Array
//         (
//             [0] => deadpool.jpg
//             [1] => dr_fate.jpg
//             [2] => dr_strange.jpg
//         )

//     [type] => Array
//         (
//             [0] => image/jpeg
//             [1] => image/jpeg
//             [2] => image/jpeg
//         )

//     [tmp_name] => Array
//         (
//             [0] => C:\xampp\tmp\php9F76.tmp
//             [1] => C:\xampp\tmp\php9F87.tmp
//             [2] => C:\xampp\tmp\php9F98.tmp
//         )

//     [error] => Array
//         (
//             [0] => 0
//             [1] => 0
//             [2] => 0
//         )

//     [size] => Array
//         (
//             [0] => 202239
//             [1] => 241528
//             [2] => 244031
//         )

// )

//上傳的檔案是多個 所以是array 
for($i = 0; $i < count($_FILES["myFile"]["name"]); $i++){
    if( $_FILES["myFile"]["error"][$i] === 0){
        //為上傳檔案命名
        $strDatetime = date("YmdHis")."_".$i;  //因為是同一時間上傳的 所以檔名會重複 這時就用$i 作區別
                
        //找出副檔名
        $extension = pathinfo($_FILES["myFile"]["name"][$i], PATHINFO_EXTENSION);

        //建立完整名稱
        $strImgPath = $strDatetime.".".$extension;

        if( move_uploaded_file($_FILES["myFile"]["tmp_name"][$i], "./tmp/".$strImgPath) ) {
            echo $_FILES["myFile"]["name"][$i]." 上傳成功!!<br />";
            echo "檔案名稱: ".$_FILES["myFile"]["name"][$i]."<br />";
            echo "檔案類型: ".$_FILES["myFile"]["type"][$i]."<br />";
            echo "檔案大小: ".$_FILES["myFile"]["size"][$i]."<br />";
            echo "<hr />";
        } else { //檔案移動失敗，則顯示錯誤訊息
            echo $_FILES["myFile"]["name"][$i]." 上傳失敗…<br />";
            echo "<a href='javascript:windows.history.back();'>回上一頁</a>";
        }
    } else {
        echo "nothing";
    }
}