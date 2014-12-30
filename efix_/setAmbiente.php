<?php 
require_once 'model/averia.php';
$rep=array();
$averia=new averia();
//$r=
$rep["respuesta"]=$averia->save_web($_POST);;
print_r(json_encode($rep));
?>
