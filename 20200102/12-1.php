<?php
//除錯用 判斷有沒有值
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// exit();



if( !isset($_POST['myName']) || !isset($_POST['myAge']) ){
    echo "Nothing at all";
    exit();
}

// 12.php的資料傳送過來
echo $_POST['myName'];
echo "<hr />";
echo $_POST['myAge'];
echo "<hr />";
echo $_POST['myGender'];

//複選的項目變陣列
echo "<pre>";
print_r($_POST['myColor']);
echo "</pre>";

$arrColor=$_POST['myColor'];

//用for把陣列裡的值秀出來
// for($i=0;$i<count($_POST['myColor']);$i++){
// echo "<br>";
// echo $_POST['myColor'][$i];
// }

// for($i=0;$i<count($arrColor);$i++){
//     echo "<br>";
//     echo $arrColor[$i];
//     };

//或是foreach
foreach($arrColor as $val){
        echo "<br>";
        echo $val;
    };