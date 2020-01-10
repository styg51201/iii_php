<?php
//任何單一字元(任何字元)
//有 preg_match_"all"  有加all  正規表達式後面就不用/gm (global)
// $pattern01 = '/./m';
// $str01 = 'AB123';
// preg_match_all($pattern01, $str01, $matches);

// //出來的是二唯陣列
// echo "<pre>";
// print_r($matches);
// echo "</pre>";

$pattern = '/https?:\/\/www\.google\.com/m';
$str='https://www.google.com';
preg_match_all($pattern, $str, $matches);

echo "<pre>";
print_r($matches);
echo "</pre>";


//中括號[a-z] 用 + 號 連結 就是一整段文字 而不是只取一個字元
$pattern = '/https?:\/\/www\.[a-z]+\.com/m';
$str='https://www.google.com';
preg_match_all($pattern, $str, $matches);

echo "<pre>";
print_r($matches);
echo "</pre>";

// 有() 會組成一個group  會存在二唯陣列裡的第一個
$pattern = '/https?:\/\/www\.(google|yahoo)\.com/m';
$str='https://www.google.com';
preg_match_all($pattern, $str, $matches);

echo "<pre>";
print_r($matches);
echo "</pre>";





// //任何空白字元（\f \r \n \t \v）空格、換行、換頁等
// $pattern02 = '/\s/m';
// $str02 = ' AB123  ';
// preg_match_all($pattern02, $str02, $matches);
// echo "<pre>";
// print_r($matches);
// echo "</pre>";

// //任何數字
// $pattern03 = '/\d/m';
// $str03 = 'AB123';
// preg_match_all($pattern03, $str03, $matches);
// echo "<pre>";
// print_r($matches);
// echo "</pre>";

// //任何文字字元
// $pattern04 = '/\w/m';
// $str04 = 'AB123';
// preg_match_all($pattern04, $str04, $matches);
// echo "<pre>";
// print_r($matches);
// echo "</pre>";