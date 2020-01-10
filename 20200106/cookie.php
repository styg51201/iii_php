<?php 

//基本儲存方式，結束時間預設為瀏覽階段結束 
$check = setcookie('mycookie','ABC123');


if($check){
    if(isset($_COOKIE['mycookie'])) {
        echo 'cookie 內容為'.$_COOKIE['mycookie'];
    } else{
        echo '儲存成功,請重新整理';
    }
};

//重新整理後才讀的到cookie內容
echo 'cookie 內容為'.$_COOKIE['mycookie'];


//刪除 cookie (透過指定過去時間)  要留"" 空字串
// setcookie('TestCookie', '', time() - 3600); 


?>