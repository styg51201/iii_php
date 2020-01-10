<?php
class Car {
    var $brand;
    var $color;
    //建構子
    function __construct(){
        $this->color = "red";
    }

    function setBrand($str){
        $this->brand = $str;
    }

    function getBrand(){
        return $this->brand;
    }

    //消滅
    function __destruct(){ echo ""; }
}

$objCar = new Car();
$objCar->setBrand("Toyota");
echo $objCar->getBrand();
echo "<hr />";
echo $objCar->color;

unset($objCar);
