<?php 
require_once 'model/averia.php';
$longitud=urldecode($_POST['longitud']);
$latitud=urldecode($_POST["latitud"]);
$averia=new averia();
$ambientes = array();
$aulas=array();
$r=$averia->Localizate($longitud,$latitud);
$ambientes['ambientes'] = $averia->getAmbientes($r[0][0]);
//$aulas['aulas'] = $averia->getAulas($r[0][0]);

if($longitud!=null || $latitud!=null)
{
print_r(json_encode($ambientes));
//print_r(json_encode($aulas));
}else{
$outputArr['ambientes'] = array("msg"=>"parametros vacios");
print_r(json_encode($outputArr));
}
/*
$usuario = urldecode($_POST['usuario']);
        $clave = urldecode($_POST['clave']);
        $datos = $this->_empleado->seleccionar($usuario, $clave);
        $outputArr = array();
        $outputArr['Android'] = 
*/

?>
