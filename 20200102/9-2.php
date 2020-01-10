<!DOCTYPYE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>我的 PHP 程式</title>
</head>
<body>
    <?php
       
       $arr=['a','b','c'];
       //使用陣列索引鍵 
       $season = array(
            '學號' => '103',
            '姓名' => '孫小美',
            '性別' => '女',
            '生日' => '2000/7/15',
            '手機號碼' => '0939666999' 
        ); 
 
       foreach($season as $keyy => $value) {     
            echo $keyy.": ".$value."<br />"; } 
 
            echo '<br>';
            
        foreach($arr as $keyy => $value) {     
            echo $keyy.": ".$value."<br />"; } 
    
        
        
    ?>
</body>
</html>