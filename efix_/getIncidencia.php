<?php 
require_once 'model/averia.php';
$tipo_averia=$_POST['tipo_averia'];
$averia=new averia();
$r["incidencia"]=$averia->getIncidencia($tipo_averia);
print_r(json_encode($r));

?>
