<?php 
require_once 'model/averia.php';
$averia=new averia();

  /*$rep=array();
$ruta = "view/fotos_averia/" . basename( $_FILES['fotoUp']['name']);
if(move_uploaded_file($_FILES['fotoUp']['tmp_name'], $ruta))
{
       chmod("view/fotos_averia/".basename( $_FILES['fotoUp']['name']), 0644);
       $msg= array('rep'=>"1");
     
       $rep["respuesta"]=$msg;
	 print_r(json_encode($rep));		
	   }
	   else{
	   $msg= array('rep'=>"2");
           $rep["respuesta"]=$msg;
		 print_r(json_encode($msg));
	   }*/
$r=array();
$r["respuesta"]=$averia->save_imagen($_FILES['fotoUp']['tmp_name'],$_FILES['fotoUp']['name']);
	 print_r(json_encode($r));
          
?>