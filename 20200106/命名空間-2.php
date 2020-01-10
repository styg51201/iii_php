<?php 

require_once './命名空間.php'; 
 

//都是class A() 但是來自不同的命名空間
$obj_15_3_1_A = new ns_15_3_1_A\A(); 
$obj_15_3_1_A->setName('1A'); echo "我是 "; 
echo $obj_15_3_1_A->getName(); echo " , 我來自命名空間 "; 
echo $obj_15_3_1_A->getMsg(); 
unset($obj_15_3_1_A); 
 
echo "<hr />"; 
 
$obj_15_3_2_A = new ns_15_3_2_A\A(); 
$obj_15_3_2_A->setName('2A'); echo "我是 "; 
echo $obj_15_3_2_A->getName(); echo " , 我來自命名空間 "; 
echo $obj_15_3_2_A->getMsg(); 
unset($obj_15_3_2_A);



?>