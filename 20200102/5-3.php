<!DOCTYPYE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>我的 PHP 程式</title>
</head>
<body>
    <?php

      //把一個變數的值 設為變數 透過這個值 給有點相關性的 值...
      //像是 name =bill , $$name =dogName , 透過bill這個人找出它的狗
        $name = 'myVar';
        $$name = '真正的值';
        $age = 18;

        //可以用「.」來串接變數和文字、數值，進行輸出
        //或使用大括弧
  
        echo $name . ' 變數的值為: ' . $$name;
        echo "<br> {$name} 跟 {$$name}";
        echo '<br>'.$name.'123';

        //若兩側是雙引號則可省略大括弧,直接擺變數
        echo "<br> $name 跟 $age";

          //若兩側是單引號 則不行
          echo '<br> $name 跟 $age';


        $programmingLang = 'PHP';
        //在變數裡 ，以「<<<自訂名稱」開始、「自訂名稱;」結尾，字串、文字段落中 間，可以將其它變數嵌入，執行後，會直接將其它變數的值，一併顯示在畫面上。 
        $myVar = <<<Msg
                    <br>
                    看著被你退回的信，燒成了灰燼，…
                    …
                    愈往遠處飛去，你愈在我心裡，…
                    I love $programmingLang
                Msg;

        echo $myVar;

    ?>
</body>
</html>