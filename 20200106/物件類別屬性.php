<?php
class GrandPa
{
    // private $name = 'Mark Henry';
    protected $name = 'Mark Henry'; 
    // public $name = 'Mark Henry';

}

//extends 繼承
// Daddy 繼承了 GrandPa 的內容
class Daddy extends GrandPa
{
    function displayGrandPaName()
    {
        return $this->name;
    }
}

$daddy = new Daddy;
echo $daddy->displayGrandPaName(); 

echo "<hr />";

$outsiderWantstoKnowGrandpasName = new GrandPa;
echo $outsiderWantstoKnowGrandpasName->name; 