<!DOCTYPYE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>我的 PHP 程式</title>
</head>
<body>
    <?php

    $arr = array('Alex', 'Bill', 'Carl', 'Darren'); 

    $arr = ['Alex', 'Bill', 'Carl', 'Darren']; 

    echo $arr[0];


    //起手式用中括號[] 如果放在裡面的是key跟value 就會自動變成物件(字典)
                    //如果是一般索引 那就是陣列
    $obj=[];  //初始化? 先建一個空物件  後面再賦值給它
    $obj["name"]= "Jean";
    $obj["age"]= 20;
    $obj["color"]= "red";

    //直接建立一個物件 不透過初始化
    $objB= [
        'name'=>'bill',
        'age'=>25
    ];

    echo '<br>';
    echo $objB['age'];


    echo '<br>';
    print_r ($obj);  // print_r 顯示出物件所有的內容


    //換成Json格式輸出
    $text=json_encode($obj);

    echo '<br>';
    echo $text;

    //轉換成原來的格式  true代表陣列  flase代表物件(class)
    $retext = json_decode($text,true);


    echo '<br>';
    echo $retext['age'];


    



    ?>
</body>
</html>
