<?php
/* 
 *
 */
include_once("Main.php");
require_once("lib/class.upload.php");
require_once("lib/funciones.php");
class User extends Main 
{
    function Start() 
	{
        
        $clave= md5($_POST['clave']);
	    $stmt = $this->db->prepare(" SELECT
				usuario.idusuario as id_usuario,
				(usuario.nombres) as usuario,
				usuario.perfil as id_perfil,
				perfil.descripcion as perfil,
				usuario.usuario as user,
                                usuario.foto
				FROM
				usuario
				INNER JOIN perfil ON usuario.perfil = perfil.idperfil
                                WHERE usuario=:u and clave=:c");
		$stmt->bindParam(':u', $_POST['login'] , PDO::PARAM_STR);
		$stmt->bindParam(':c', $clave,PDO::PARAM_STR);
        $stmt->execute();
		$obj = $stmt->fetchObject();
                echo $clave;
        return array('flag'=>$stmt->rowCount() , 'obj'=>$obj );
    }
   function photo($id,$f)
	{
		$foto = $id."".date('dmYhms');
		$foo = new Upload($f);// nombre del objeto file 
		if ($foo->uploaded) 
		{   
			$foo->file_new_name_body = $foto;// nombre de la imagen...
			$foo->image_resize = true; // autoriza que si se redimensione
			$foo->image_x = 153; // Tama�o en pixeles - Ancho
			$foo->image_y = 150; // Tama�o en pixeles - Alto
			$foo->Process('view/fotos_user/'); // Carpeta donde se va grabar la imagen
			if ($foo->processed) 
			{ 
				$foo-> clean();
				$Upload=true;
			
			} 
			else 
			{
				$Upload=false;
			}
			  if($Upload)
			  {
				 $stmt = $this->db->prepare("update  usuario set foto='$foto' WHERE idusuario = :id");
				 $stmt->bindValue(':id', $id , PDO::PARAM_STR);
				 $stmt->execute();
			  }
	   }
	}
	function save_photo_temp()
	{
		$fotof =$_FILES["archivo"]["name"];
		$i=0;
	    $tam=0;
		while($i<strlen($fotof))
		{
		 if($archivo[$i]=='.')
		   {
			 $i=strlen($fotof);
			}else
			{
			  $tam++;
			  $i++;
			}
		 }
		$foto=strtolower(substr($archivo,0,$tam));
		$foo = new Upload($_FILES['archivo']);// nombre del objeto file 
	    if ($foo->uploaded)
		{   
			$foo->file_new_name_body = $foto;// nombre de la imagen...
			$foo->image_resize = false; // autoriza que si se redimensione
    //$foo->image_convert = jpg; // formato a convertir
			$foo->image_x = 153; // Tama�o en pixeles - Ancho
			$foo->image_y = 150; // Tama�o en pixeles - Alto
			$foo->Process('view/fotostem/'); // Carpeta donde se va grabar la imagen
			if ($foo->processed) 
			{ 
			$foo-> clean();
			$Upload=true;
			
			} 
			else 
			{
			 $Upload=false;
			}
	 
	   }
	   $f ="view/fotostem/". basename($fotof);
	   return $f;
	}
	function show($id)
	{
	    $stmt = $this->db->prepare("SELECT * FROM usuario WHERE idusuario = :id");
        $stmt->bindValue(':id', $id , PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchObject();
	}
	function validar($u)//para que no tengan el mismo nombre de usuario
	{
		$sql="SELECT count(*) FROM usuario where usuario ='".$u."' ";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$set = $stmt->fetchAll();
		$rep=array();
		foreach( $set as $f)
		{
			$rep['rep']=$f[0];
		}
		return $rep;
	}
	function Validar_pass($pass, $id)//para ver si la clave coincide...
	{
	
	    $sql="SELECT count(idusuario) FROM usuario where idusuario ='".$id."' and clave='".md5($pass)."' ";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$set = $stmt->fetchAll();
		$rep=array();
		foreach( $set as $f)
		{
			$rep['rep']=$f[0];
		}
		return $rep;
	}
	function change($c,$id)//para poder cambiar el nuevo pasword
	{
	    $sql="UPDATE  usuario set clave='".md5($c)."'  where idusuario ='".$id."'  ";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
	    $resp = array('rep'=>'1','msg'=>'su password a sido actualizado');
		return $resp;
	}
	function newUser($P)
    {
		if($P['oper']==1)
		{ 
		   $Photo = $P['usuario_numdoc']."".date('dmYhms');
	       $foo = new Upload($P['foto']);// nombre del objeto file 
           if ($foo->uploaded) 
		   {   
			   $foo->file_new_name_body = $Photo;// nombre de la imagen...
			   $foo->image_resize = false; // autoriza que si se redimensione
			   $foo->image_x = 153; // Tama�o en pixeles - Ancho
			   $foo->image_y = 150; // Tama�o en pixeles - Alto
			   $foo->Process('view/fotos_user/'); // Carpeta donde se va grabar la imagen
				 if ($foo->processed) 
				 { 
				   if($P['band']==0){
					$foo-> clean();
				   }
					$Upload=true;
				 } 
				   else 
				 {
				   $Upload=false;
				 }
		   }
		  if($Upload)
		  {
		 // $fecha=fecha_en($P['usuario_fechanac']);
		     $fecha=$P['usuario_fechanac'];
			 //op int,_perfil int,_profesion text,_domicilio text,_telefono text,_dni text,_usuario text,_clave text,_fecha_n date,_foto text, id int
			 $sql =$this->Query("usp_usuario(1,:p2,:p3,:p4,:p6,:p7,:p8,:p9,:p10,:p11,:p12,0)");
			 $stmt =$this->db->prepare($sql);
			 try
			 {
                $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$this->db->beginTransaction();
                $stmt->bindValue(':p2',$P['id_perfil'], PDO::PARAM_STR);
                $stmt->bindValue(':p3',$P['usuario_nombres'], PDO::PARAM_STR);
                $stmt->bindValue(':p4',$P['profesion'], PDO::PARAM_STR);
            
                $stmt->bindValue(':p6',$P['usuario_direccion'], PDO::PARAM_STR);
                $stmt->bindValue(':p7',$P['usuario_telefono'], PDO::PARAM_INT);
                $stmt->bindValue(':p8',$P['dni'], PDO::PARAM_INT);
                $stmt->bindValue(':p9',$P['usuario_nick'], PDO::PARAM_INT);
                $stmt->bindValue(':p10',  md5($P['usuario_password']), PDO::PARAM_STR);
                $stmt->bindValue(':p11',$fecha, PDO::PARAM_STR);
                $stmt->bindValue(':p12',$Photo, PDO::PARAM_INT);
                $stmt->execute();
                $this->db->commit();
				  $resp = array('rep'=>'1','msg'=>'ok');
				return $resp;
			}
			catch(PDOException $e) 
			{
				$this->db->rollBack();
			return array('rep'=>"3",'msg'=>'no se pudo realizar la accion de insertar : '.$e->getMessage());
			} 
			
		
		  } 
		
		
		}
		else
		{  
			$fecha=$P['usuario_fechanac'];
			$Photo = $P['usuario_numdoc']."".date('dmYhms');  
			$sql =$this->Query("usp_usuario(2,:p2,:p3,:p4,:p6,:p7,:p8,:p9,:p10,:p11,:p12,:id)");
			$stmt =$this->db->prepare($sql);
			try
			{
                $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$this->db->beginTransaction();
				
                $stmt->bindValue(':p2',$P['id_perfil'], PDO::PARAM_STR);
                $stmt->bindValue(':p3',$P['usuario_nombres'], PDO::PARAM_STR);
                $stmt->bindValue(':p4',$P['profesion'], PDO::PARAM_STR);
                $stmt->bindValue(':p6',$P['usuario_direccion'], PDO::PARAM_STR);
                $stmt->bindValue(':p7',$P['usuario_telefono'], PDO::PARAM_INT);
                $stmt->bindValue(':p8',$P['dni'], PDO::PARAM_INT);
                $stmt->bindValue(':p9',$P['usuario_nick'], PDO::PARAM_STR);
                $stmt->bindValue(':p10',md5($P['usuario_password']), PDO::PARAM_STR);
                $stmt->bindValue(':p11',$fecha, PDO::PARAM_STR);
                $stmt->bindValue(':p12',$Photo, PDO::PARAM_INT);               
               $stmt->bindValue(':id',$P['id_usuario'], PDO::PARAM_INT); 
                $stmt->execute();
                $this->db->commit();
                
				$resp = array('rep'=>'2','msg'=>'Ok');
				return $resp;
			}
			catch(PDOException $e) 
			{
				$this->db->rollBack();
				return array('rep'=>"4",'msg'=>'no se pudo realizar la accion de actualizar : '.$e->getMessage());
			}
		}
	}
	  function deleteUser($id)
    {
		
		$stmt2=$this->db->prepare("select foto from usuario WHERE idusuario = :id");
        $stmt2->bindValue(':id', $id , PDO::PARAM_INT);
       
		$stmt2->execute();
		$set = $stmt2->fetchAll();
		foreach($set as $val)
		{
		  $c=$val[0];
		}
		$c=$c.'.jpg';
		  unlink("view/fotos_user/". basename($c));
		 $stmt = $this->db->prepare("delete from usuario WHERE idusuario = :id");
		  $stmt->bindValue(':id', $id , PDO::PARAM_INT);
         $res=$stmt->execute();
		 return $res;
		
			
          
    }
	
}
?>
