<!DOCTYPYE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>我的 PHP 程式</title>
</head>
<body>
    <?php
     
     $test="Hi \n there";
     echo $test;

     echo nl2br($test);  //把 \n 變成<br>換行

     $test2 = "     hi     ";
     echo $test2;
     echo '<br>';

     echo trim($test2);
     echo trim($test2);


for($i=1;$i<=9;$i++){
    for($j=1;$j<=9;$j++){
        echo "$i*$j=".($i*$j).'<br>';
    };
};

    ?>
</body>
</html>