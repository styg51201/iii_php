<?php 

session_start();

$username='stacey';
$pwd =sha1('aabb');
// $pwd = '28cc5fd736aee0939ede3330c2867b31e82d9656';


if(isset($_POST['username']) && isset($_POST['pwd']) ){
    if($_POST['username'] === $username && sha1($_POST['pwd'])=== $pwd){

        //3 秒後跳頁
        header("Refresh: 3; url=./18-2.php");

        //將傳送過來的 post 變數資料，放到 session，
        $_SESSION['username'] = $username;

        echo "登入成功!!! 3秒後自動進入後端頁面";
    }else {
        header("Refresh: 3; url=./18.php");
        echo "登入失敗…3秒後自動回登入頁";
    }
} else {
    header("Refresh: 3; url=./18.php");
    echo "請確實登入…3秒後自動回登入頁";
}

?>