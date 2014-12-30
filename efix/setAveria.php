<?php 
require_once 'model/averia.php';
$averia=new averia();
/*
  $rep=array();
  echo $_FILES['nameimagen']['name'];
$ruta = "view/fotos_averia/" . basename( $_FILES['nameimagen']['name']);
if(move_uploaded_file($_FILES['nameimagen']['tmp_name'], $ruta))
{
       chmod("view/fotos_averia/".basename( $_FILES['nameimagen']['name']), 0644);
    
print_r(json_encode($averia->save_web2($_POST)));
	   }
	   else{
	   $msg= array('rep'=>"2",'msg'=>'nose pudo cargar la imagen');
		 print_r(json_encode($msg));
	   }*/
$r=array();
$r=$averia->save_web2($_POST,$_FILES['nameimagen']['tmp_name']);
if($r["rep"]==1){
 echo "<script>window.location = 'home.php?msg=ok'</script>";   
}
else{
   echo "<script>window.location = 'home.php?msg=error'</script>"; 
}
?>