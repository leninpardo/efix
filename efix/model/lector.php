<?php
include_once("Main.php");
require_once("lib/class.upload.php");
require_once("lib/funciones.php");
class lector extends Main 
{
	function save_photo_temp()
	{
		$fotof =$_FILES["archivo"]["name"];
		$i=0;
		$tam=0;
		while($i<strlen($fotof))
		{
			if($fotof[$i]=='.')
			{
				$i=strlen($fotof);
			}
			else
			{
				$tam++;
				$i++;
			}
		}
		$foto=strtolower(substr($fotof,0,$tam));
		$foo = new Upload($_FILES['archivo']);// nombre del objeto file 
		if ($foo->uploaded) 
		{   
			$foo->file_new_name_body = $foto;// nombre de la imagen...
			$foo->image_resize = false; // autoriza que si se redimensione
			$foo->image_x = 153; // Tama�o en pixeles - Ancho
			$foo->image_y = 180; // Tama�o en pixeles - Alto
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
	 $stmt = $this->db->prepare("SELECT * FROM productor WHERE idproductor = :id");
        $stmt->bindValue(':id', $id , PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchObject();
	}
	
	/*public function newproductor($P)
    {
   
      // echo $P['foto'];
		if($P['oper']==1)
		{ 
                            // echo $P['oper'];
			$Photo = $P['dni'].date('dmYhms');
			$foo = new Upload($P['foto']);// nombre del objeto file 
			if ($foo->uploaded) 
			{   
				$foo->file_new_name_body = $Photo;// nombre de la imagen...
				$foo->image_resize = false; // autoriza que si se redimensione
				//$foo->image_convert = jpg; // formato a convertir
				$foo->image_x = 153; // Tama�o en pixeles - Ancho
				$foo->image_y = 180; // Tama�o en pixeles - Alto
				$foo->Process('view/fotos_productor/'); // Carpeta donde se va grabar la imagen
				if ($foo->processed) 
				{ 
					if($P['flag']==0){
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
				$fecha=$P['fecha_nacimiento'];
				if(isset($P['estado']) && $P['estado']== "on"){$estado="1";}else{$estado="0";}
                                $r=$this->get_enviar("usp_productor", array(1,$P['idcomite'],$P['dni'],$P['nombres'],
                                    $P['estado_civil'],$P['conyuge'],$P['nro_hijos'],$P['direccion'],
                                    $P['status'],$Photo,$fecha,$P['telef'],$estado,$P['sexo'],$P['idcomunidad'],0));
                                if($r[1]=="")
                                {
                                    $resp = array('rep'=>'1','str'=>'Ok');
                                }
 else {
     $resp=array('res'=>"3",'msg'=>'no se pudo realizar la accion de insertar : '.$r[1]);
 }
				/*$sql =$this->Query("usp_productor(1,:p2,:p3,:p4,:p5,:p7,:p8,:p9,:p10,:p11,:p12,:p13,:p14,:p15,:p16,0)");
				$stmt =$this->db->prepare($sql);
				try
				{
					$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$this->db->beginTransaction();
					$stmt->bindValue(':p2',$P['idcomite'], PDO::PARAM_INT);
					$stmt->bindValue(':p3',$P['dni'], PDO::	PARAM_STR);
					$stmt->bindValue(':p4',$P['nombres'], PDO::PARAM_STR);
					//$stmt->bindValue(':p5',$P['apellidos'], PDO::PARAM_STR);
					$stmt->bindValue(':p6',$P['estado_civil'], PDO::PARAM_STR);
					$stmt->bindValue(':p7',$P['conyuge'], PDO::PARAM_STR);
					$stmt->bindValue(':p8',$P['nro_hijos'], PDO::PARAM_INT);
					$stmt->bindValue(':p9',$P['direccion'], PDO::PARAM_STR);
					$stmt->bindValue(':p10',$P['status'], PDO::PARAM_STR);
					$stmt->bindValue(':p11',$Photo, PDO::PARAM_STR);
					$stmt->bindValue(':p12',$fecha, PDO::PARAM_STR);
					$stmt->bindValue(':p13',$P['telef'], PDO::PARAM_STR);
					$stmt->bindValue(':p14',$estado, PDO::PARAM_INT);
					$stmt->bindValue(':p15',$P['sexo'], PDO::PARAM_STR);
					$stmt->bindValue(':p16',$P['idcomunidad'], PDO::PARAM_INT);
					$stmt->execute();
					$this->db->commit();
					$resp = array('rep'=>'1','str'=>'Ok');
					return $resp;
				}
				catch(PDOException $e) 
				{
					$this->db->rollBack();
					return array('res'=>"3",'msg'=>'no se pudo realizar la accion de insertar : '.$e->getMessage());
				} 
                                */
				/*if (file_exists($P['foto'])) 
				{
					unlink($P['foto']);
					//return "hola";
				}
                                echo $r[1];
                                return $resp;
			} 
		}
                
		else
		{  
			if(isset($P['estado']) && $P['estado']== "on"){$estado="1";}else{$estado="0";}
			if($P['band']==0)
			{
				 $Photo=$P['foto'];
				
               $Upload=true;				
			}else
			{
				
				if (file_exists($P['fotoq'])) 
				{
					unlink($P['fotoq']);
					//return "hola";
				}
				
				$Photo = $P['dni'].date('dmYhms');
				$foo = new Upload($P['foto']);// nombre del objeto file 
				if ($foo->uploaded) 
				{   
					$foo->file_new_name_body = $Photo;// nombre de la imagen...
					$foo->image_resize = false; // autoriza que si se redimensione
					//$foo->image_convert = jpg; // formato a convertir
					$foo->image_x = 153; // Tama�o en pixeles - Ancho
					$foo->image_y = 180; // Tama�o en pixeles - Alto
					$foo->Process('view/fotos_productor/'); // Carpeta donde se va grabar la imagen
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
			}
			
			if($Upload)
			{
				$fecha=$P['fecha_nacimiento'];
				$sql =$this->Query("usp_productor(2,:p2,:p3,:p4,:p6,:p7,:p8,:p9,:p10,:p11,:p12,:p13,:p14,:p15,:p16,:p1)");
				$stmt =$this->db->prepare($sql);
				try
				{
					$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$this->db->beginTransaction();
					$stmt->bindValue(':p1',$P['idproductor'], PDO::PARAM_INT);
					$stmt->bindValue(':p2',$P['idcomite'], PDO::PARAM_INT);
					$stmt->bindValue(':p3',$P['dni'], PDO::	PARAM_STR);
					$stmt->bindValue(':p4',$P['nombres'], PDO::PARAM_STR);
					//$stmt->bindValue(':p5',$P['apellidos'], PDO::PARAM_STR);
					$stmt->bindValue(':p6',$P['estado_civil'], PDO::PARAM_STR);
					$stmt->bindValue(':p7',$P['conyuge'], PDO::PARAM_STR);
					$stmt->bindValue(':p8',$P['nro_hijos'], PDO::PARAM_INT);
					$stmt->bindValue(':p9',$P['direccion'], PDO::PARAM_STR);
					$stmt->bindValue(':p10',$P['codigo'], PDO::PARAM_STR);
					$stmt->bindValue(':p11',$Photo, PDO::PARAM_STR);
					$stmt->bindValue(':p12',$fecha, PDO::PARAM_STR);
					$stmt->bindValue(':p13',$P['telef'], PDO::PARAM_STR);
					$stmt->bindValue(':p14',$estado, PDO::PARAM_INT);
					$stmt->bindValue(':p15',$P['sexo'], PDO::PARAM_STR);
					$stmt->bindValue(':p16',$P['idcomunidad'], PDO::PARAM_INT);
					
					$stmt->execute();
					$this->db->commit();
					$resp = array('rep'=>'2','str'=>'Ok');
					return $resp;
				}
				catch(PDOException $e) 
				{
					$this->db->rollBack();
					return array('res'=>"4",'msg'=>'no se pudo realizar la accion de actualizar : '.$e->getMessage());
				} 
				if (file_exists($P['foto'])) 
				{
					unlink($P['foto']);
					//return "hola";
				}
			}
		}
	}*/
	
	function editproductor($id ) 
	{
        $stmt = $this->db->prepare("SELECT * FROM productor WHERE idproductor = :id");
        $stmt->bindValue(':id', $id , PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchObject();
    }
	
	function _verproductor($id ) 
	{
        $stmt = $this->db->prepare("SELECT * FROM productor WHERE idproductor = :id");
        $stmt->bindValue(':id', $id , PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchObject();
    }
	
	function deleteproductor($id)
    {
		$stmt1 = $this->db->prepare("SELECT imagen FROM productor WHERE idproductor = :id");
		$stmt1->bindValue(':id', $id , PDO::PARAM_STR);
        $stmt1->execute();
		$set = $stmt1->fetchAll();
		foreach($set as $val)
		{
		  $c=$val[0];
		}
		$c=$c.'.jpg';
		  unlink("view/fotos_productor/". basename($c));
		$stmt = $this->db->prepare("delete from productor WHERE idproductor = :id");
        $stmt->bindValue(':id', $id , PDO::PARAM_INT);
		$res=$stmt->execute();
		return $res;
    }
	
	function _list($query , $p ) 
	{
		$stmt = $this->db->prepare("select * FROM sv_detalle_cultivo where  cast( id_det_cultivo as char(10))
            like :query or productor like :query or nombre_previo like :query");
        $stmt->bindValue(':query', $query , PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchObject();
        $data['total'] = $this->getTotal( $stmt, $stmt->bindValue );
        $data['rows'] =  $this->getRow($stmt, $stmt->bindValue , $p );
        $data['rowspag'] =  $this->getRowPag($data['total'], $p );
		return $data;
    }
	function save_ext($P)
	{
	   $sql =$this->Query("sp_productor_ext(:p1,:p2,:p3)");
				$stmt =$this->db->prepare($sql);
				try
				{
					$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$this->db->beginTransaction();
					$stmt->bindValue(':p1',$P['dni'], PDO::	PARAM_STR);
					$stmt->bindValue(':p2',$P['nombres'], PDO::PARAM_STR);
					$stmt->bindValue(':p3',$P['apellidos'], PDO::PARAM_STR);
					$stmt->execute();
					$this->db->commit();
					$resp = array('rep'=>'1','str'=>'Ok');
					return $resp;
				}
				catch(PDOException $e) 
				{
					$this->db->rollBack();
					return array('rep'=>"3",'msg'=>'no se pudo realizar la accion de insertar : '.$e->getMessage());
				} 
	}
	function ver_ext($dni)
	{
	    $stmt = $this->db->prepare("SELECT * FROM productor WHERE dni = :id");
        $stmt->bindValue(':id', $dni , PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchObject();
	}
}
?>