<?php 
require_once 'model/averia.php';
$facultad=$_GET['id'];
$averia=new averia();
$r=$averia->getAmbiente($facultad);
print_r(json_encode($r));

/*$option="";
foreach ($r as $k)
{
    $option.= "<option value='$k[0]'>$k[1]</option>";
}*/
?>
