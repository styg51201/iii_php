<!DOCTYPYE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>我的 PHP 程式</title>
</head>
<body>
    <?php
       
       echo '傳值呼叫<br>';
       $y=2;
       function show($y){
           $y=$y+2;
           echo '函式內的='.$y.'<br>';
       }
       show($y);
       echo '函式外的='.$y.'<br>';


       echo '<hr>';


       echo '傳址呼叫<br>';
       $x=2;
       function show1(&$x){  //加上 & 成為傳址呼叫
           $x=$x+2;
           echo '函式內的='.$x.'<br>';
       }

       show1($x);
       echo '函式外的='.$x.'<br>';



    ?>
</body>
</html>