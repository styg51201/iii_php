<?php

class MyCar {
    //private 私有的 外部不能干涉
    private $wheels;
    private $seats;

    //建構子
    //public 公有的
    public function __construct(){
        $this->wheels = 4;    //this=Mycar 裡的 wheels 設定值給它
        $this->seats = 5;
    }

    public function getseats(){
        return $this->seats;     //取得seats 的值
    }

    public function getwheels(){
        return $this->wheels;    //取得wheels 的值
    }

    //解構子
    public function __destruct(){}
}

?>


<!DOCTYPYE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>我的 PHP 程式</title>
</head>
<body>

<pre>
<?php

    $car = new Mycar();    //建立我設定的Mycar 給一的變數
    echo $car->getseats();  //取得 Mycar裡的getseats()的函式 拿到回傳的座位數
    echo $car->getwheels();
?>
</pre>

</body>
</html>