

<body>


<?php

$a=-4;
$b= $a>0? '正': '反';
echo $b;

echo '<br>';

$strVar = "abcd1234"; echo "原始字串: ".$strVar; 
echo "<hr />"; 
echo "md5: ".md5($strVar); 
echo "<hr />"; 
echo "sha1: ".sha1($strVar);


?>


</body>