<!DOCTYPYE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>我的 PHP 程式</title>
</head>
<body>
<h1>哈哈</h1>

    <?php
        
    $a;

    if(isset($_GET['name'])){
        echo $_GET['name'];
        echo '<br>';
        echo $_GET['age'];
}   else{
         echo 'nothing';
}

if(isset($a)){
    echo '1';
}
else{
    echo '2';
}

    ?>
</body>
</html>