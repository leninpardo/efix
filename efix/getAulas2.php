<?php 
require_once 'model/averia.php';
$ambiente=$_GET['ambiente'];
$averia=new averia();
print_r(json_encode($averia->getAulas($ambiente)));

?>
