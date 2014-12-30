<?php 
require_once 'model/averia.php';
$ambiente=$_POST['ambiente'];
$averia=new averia();
$r["aulas"]=$averia->getAulas($ambiente);
print_r(json_encode($r));

?>
