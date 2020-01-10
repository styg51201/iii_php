<?php 

session_start();

$_SESSION['name']='Bill';

echo $_SESSION['name'];


$_SESSION['people']['name']='Alex';
$_SESSION['people']['age']=32;
$_SESSION['people']['dog']='Max';

$arr=$_SESSION['people'];

echo '<pre>';
print_r($_SESSION['people']);
echo '</pre>';

?>