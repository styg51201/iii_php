<?php 

//使用 fwrite 寫入檔案
$fp=fopen("./file.txt", "r+");
// fwrite($fp, "HI!!!!!!!!!!!!!!");
fclose($fp);

//使用 fgets 讀取 test01.txt 檔案
$fp = fopen("./file.txt", "a+");

while( $line = fgets($fp) ) {
    echo $line. "<br />";
    // fwrite($fp, "Hello111111221111!!");
}
// fwrite($fp, "Hello3! \n");
fclose($fp);

// date_default_timezone_set("Asia/Taipei"); 
$yearr = date('Y')-1911;

//顯現時間格式
$date_server = date("-m-d H:i:s"); 
echo "伺服器時間: 民國" . $yearr.$date_server;
echo '<br>';

//時間戳記 =>毫秒數
echo " 時間戳記: " . strtotime("now"); 
echo '<br>';

//透過時間戳記 轉成 日期格式
echo "戳記轉換日期格式: " . date("Y-m-d H:i:s", strtotime("now")); 

?>