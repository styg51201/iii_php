<?php

require_once('./db.inc.php');
require_once('./cat.php');
    echo   '請稍等 \ˊvˋ/';


//不給HEADER會讓網頁判定 是機器人 
$headers = [
    'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
    'Content-Type: application/x-www-form-urlencoded; charset=utf-8',
    'User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:28.0) Gecko/20100101 Firefox/28.0',
];


$url = $_POST['sUrl'];

// echo '<pre>';
// print_r($_POST);
// echo '</pre>';
// exit();

//透過 curl 取得 solr 查詢結果(資料總數) (內建函式)

//建立CURL連線
$ch = curl_init();

//設定擷取的URL網址
curl_setopt($ch, CURLOPT_URL, $url);

//給出我們的HEADER 
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

//將獲取的信息以文件流的形式返回 , 不然會直接回網頁
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

//curl_exec($ch) => 執行
$html = curl_exec($ch);

//有建立就要關閉
curl_close($ch);

// 整個網頁的htnl都複製過來了  呈現會是整個網頁
// echo $html;


//正規表達式的規則
$pattern = "/https:\/\/stickershop\.line-scdn\.net\/stickershop\/v1\/sticker\/([0-9]+)\/android\/sticker\.png/m";

//取得規則裡的文字
//第一個參數是=>規則 ; 第二個參數是=>要被規則的整段文字 ; 第三個參數是=>儲存著符合規則的文字(二唯陣列)
preg_match_all($pattern, $html, $matches);

// 整個html裡的 照片網址 共有三個
// print_r($matches);


//取得照片連結  

//array_unique => 把陣列裡相同的值留下第一個 後面刪掉 (索引會變成0.3.6.9..)
//array_values => 把陣列的索引亂序 由0開始的排序
//$matches[0]=> 照片網址
$arrImgUrl = array_values(array_unique($matches[0]));

//取得照片編號  $matches[1]=> group起來的照片編號
$arrImgNum = array_values(array_unique($matches[1]));

$sql = "INSERT INTO `stickers`
        (`sCid`,`sName`,`sImgName`)
        VALUES (?,?,?)";



for( $i = 0; $i < count($arrImgUrl); $i++ ){
    shell_exec("curl {$arrImgUrl[$i]} -o line\\{$arrImgNum[$i]}.png");

    $arrParam=[];

    $arrParam = [$_POST['sCid'],
                $_POST['sName'],
                $arrImgNum[$i].'.png'
    ];


    $stmt = $pdo->prepare($sql);
    $stmt->execute($arrParam);

}

if( $stmt->rowCount() > 0 ){
    header("Refresh: 3; url=./admin.php");
    require_once('./cat.php');
    echo "上傳成功 \˙o˙/";
    exit();
} else {
    header("Refresh: 3; url=./index.php");
    echo "上傳失敗 ˊ-ˋ";
    exit();
}
//shell_exec 給終端機指令
//curl 像GET 那邊(網址)
// -o 代表另存新檔 到指定的資料夾 \\ 檔名 (其中一個斜線是跳脫字元)
// ex: -o desktop\php\001.png


?>