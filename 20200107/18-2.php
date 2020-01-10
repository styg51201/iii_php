<?php 

session_start();

//判斷是否登入 (確認先前指派的 session 索引是否存在)
if(!isset($_SESSION['username'])){

    header('Refresh: 3; url=./18.php');
    echo "請確實登入…3秒後自動回登入頁";
    exit();
}

//判斷是否登出
if(isset($_GET['logout'])){
    //關閉 session
    session_destroy();

    header("Refresh: 3; url=./18.php");
    echo '已登出';

    exit();
}


?>


<!DOCTYPYE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>我的 PHP 程式</title>
</head>
<body>
這裡是後端管理頁面 - <a href="./18-2.php?logout=1">登出</a>
<br>
<a href="./19.php">123</a>
</body>
</html>