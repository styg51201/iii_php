<?php

//require_once 讀入其他php檔
require_once('../vendor/autoload.php');

//設定excel檔
$inputFileName = '.\text.xlsx';

//讀取excel檔
$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);

//找出excel裡 欄位的高度 (內容有多少)
$highestRow = $spreadsheet->getActiveSheet()->getHighestRow();


//用for迴圈叫出值
for($i = 1; $i <= $highestRow; $i++) {


     //若是某欄位值為空，代表那一列可能都沒資料，便跳出迴圈
     if( $spreadsheet->getActiveSheet()->getCell('A'.$i)->getValue() === '' || $spreadsheet->getActiveSheet()->getCell('A'.$i)->getValue() === null ){
     break;
     }

    echo 'name: '.$spreadsheet->getActiveSheet()->getCell('A'.$i)->getValue();
    echo '<br>';
    echo 'age: '.$spreadsheet->getActiveSheet()->getCell('B'.$i)->getValue();
    echo '<br>';

}
?>