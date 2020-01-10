<!DOCTYPYE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>我的 PHP 程式</title>
</head>
<body>
    <?php
      
    $arr[]=[
        'name'=>'Bill',
        'age'=>18
    ];
    print_r($arr);
    echo '<br>';

    $arr[]=[
        'name'=>'Andy',
        'age'=> 30
    ];

    print_r($arr[1]);
    echo '<br>';
    print_r($arr);
    echo '<br>';


    //pre標籤的作用 格式化?
    echo '<pre>';
    print_r($arr);
    echo '</pre>';

    echo '<br>';


    //用兩個foreach 
    foreach($arr as $obj) {  

        foreach($obj as $keyy => $value) {  
            echo $keyy.": ".$value."<br />"; 
        }
    } 

    ?>
</body>
</html>