<?php
include_once("Main.php");
require_once("lib/class.upload.php");
class averia extends Main
{
    function save_averia($P)
    {
       $sql =("update averias set observacion_solicitud=:p1,fecha_atencion=:p2,estado=2 where idaverias=:id");
			$stmt =$this->db->prepare($sql);
			try
			{
				$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$this->db->beginTransaction();
			
				$stmt->bindValue(':p1',$P['obs'], PDO::PARAM_STR);
                                $stmt->bindValue(':p2',$P['fecha_a'], PDO::PARAM_INT);
				$stmt->bindValue(':id',$P['idaverias'], PDO::PARAM_INT);
				$stmt->execute();
				$this->db->commit();
				$resp = array('rep'=>'2','str'=>'Ok');
				return $resp;
			}
			catch(PDOException $e) 
			{
				$this->db->rollBack();
				return array('rep'=>"4");
			} 
    }

    function save_web($P)
    {
	
       $sql =("INSERT INTO averia
(id_averia,id_incidencia,
           usua_id,fecha_reporte,
           hora_reporte,observacion,ubic_id,imagen,cantidad)
 values(:p1,:p2,:p3,:p4,:p5,:p6,:p7,:p8,1)");
			$stmt =$this->db->prepare($sql);
			$incidencia=$P['id_incidencia'];
			$stmt2=$this->db->prepare("SELECT incidencia.id_incidencia from incidencia
where incidencia.descripcion='$incidencia'");
			try
			{
				$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$this->db->beginTransaction();
			$stmt2->execute();
			$r=$stmt2->fetchAll();
			$incidencia_id=$r[0][0];
				$stmt->bindValue(':p1',  $id=$this->max_id("averia"), PDO::PARAM_INT);
				$stmt->bindValue(':p2', 1 , PDO::PARAM_INT);
				$stmt->bindValue(':p3',  1, PDO::PARAM_INT);
				$stmt->bindValue(':p4',  date("Y-m-d"), PDO::PARAM_STR);
				$stmt->bindValue(':p5',  date("H:i:s"), PDO::PARAM_STR);
                $stmt->bindValue(':p6',$P['descripcion'], PDO::PARAM_STR);
                $stmt->bindValue(':p7',$P['id_aula'], PDO::PARAM_INT);               
				$stmt->bindValue(':p8',  substr($P['nameimagen'],1,-4)."png.png", PDO::PARAM_STR);
                 //$stmt->bindValue(':p9',$P['codigo_movil'], PDO::PARAM_STR);
					//$stmt->bindValue(':p10',$P['incidencia'], PDO::PARAM_INT);				 
                                //$stmt->bindValue(':p6',1, PDO::PARAM_INT);
                               // $stmt->bindValue(':p7',$P['id_averia'], PDO::PARAM_INT);
				//$stmt->bindValue(':id',$P['idaverias'], PDO::PARAM_INT);
				$stmt->execute();
				$this->db->commit();
                                $stmt3 =$this->db->prepare("select max(id_averia) as id from averia");
				$stmt3->execute();
                                
                                //$resp["rep"]=1;
				return $stmt3->fetchAll();
				
			}
			catch(PDOException $e) 
			{
				$this->db->rollBack();
				return array('rep'=>2);
			} 
			
    }
    
	/*
    public function save_web2($P,$fot)
    {
		   $Photo = "".date('dmYhms')."";
                 
	       $foo = new Upload($fot);// nombre del objeto file 
           if ($foo->uploaded) 
		   {   
			   $foo->file_new_name_body = $Photo;// nombre de la imagen...
			   $foo->image_resize = true; // autoriza que si se redimensione
			   $foo->image_x = 600; // Tama�o en pixeles - Ancho
			   $foo->image_y = 800; // Tama�o en pixeles - Alto
                           $foo->image_convert="png";
			   $foo->Process('view/fotos_averia/'); // Carpeta donde se va grabar la imagen
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
       $sql =("INSERT INTO averia
(id_averia,id_incidencia,
           usua_id,fecha_reporte,
           hora_reporte,observacion,ubic_id,imagen,cantidad)
 values(:p1,:p2,:p3,:p4,:p5,:p6,:p7,:p8,1)");
			$stmt =$this->db->prepare($sql);
			try
			{
				$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$this->db->beginTransaction();
			
								$stmt->bindValue(':p1',  $id=$this->max_id("averia"), PDO::PARAM_INT);
                                $stmt->bindValue(':p2',1, PDO::PARAM_INT);
								$stmt->bindValue(':p3',1, PDO::PARAM_INT);
                                $stmt->bindValue(':p4',  date("Y-m-d"), PDO::PARAM_STR);
								$stmt->bindValue(':p5',  "16:30:45", PDO::PARAM_STR);
								$stmt->bindValue(':p6',  $_P['descripcion'], PDO::PARAM_STR);
								$stmt->bindValue(':p7',$P['tipoau'], PDO::PARAM_INT);
                                $stmt->bindValue(':p8', $Photo, PDO::PARAM_STR);
                               
                                $stmt->bindValue(':p6',1, PDO::PARAM_INT);
                                $stmt->bindValue(':p7',$P['tipoa'], PDO::PARAM_INT);
				//$stmt->bindValue(':id',$P['idaverias'], PDO::PARAM_INT);
				$stmt->execute();
				$this->db->commit();
                                $stmt2 =$this->db->prepare("select max(id_averia) as id from averia");
				$stmt2->execute();
                                
                  return array('rep'=>1,"msg"=> "ok");
			}
			catch(PDOException $e) 
			{
				$this->db->rollBack();
				return array('rep'=>2,"msg"=> "no se realizo por".$e->getMessage());
			}
                 }
                  else{
                    return array('rep'=>3,"msg"=>"no se pudo cargar la imagen");  
                  }
			
    }*/
   public function save_imagen($fot,$name)
   {
         $Photo = ($name);
                 
	       $foo = new Upload($fot);// nombre del objeto file 
           if ($foo->uploaded) 
		   {   
			   $foo->file_new_name_body = $Photo;// nombre de la imagen...
			   $foo->image_resize = true; // autoriza que si se redimensione
                            $foo->image_convert="png";//convierta la imagen 
			  // $foo->image_x = 187; // Tama�o en pixeles - Ancho
			  // $foo->image_y = 270; // Tama�o en pixeles - Alto
			   $foo->Process('lib'); // Carpeta donde se va grabar la imagen
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
                      $stmt = $this->db->prepare("SELECT 1 as rep");
        $stmt->execute();
        return  $stmt->fetchAll();
                  }  
                  else{
                     $stmt = $this->db->prepare("SELECT 2 as rep");
        $stmt->execute(); 
        return $stmt->fetchAll();
                  } 
                  
   }

	function edit($id ) //Esta funcion es para actualizar en el formulario de la tabla seleccionada
	{
        $stmt = $this->db->prepare("SELECT * FROM averias WHERE idaverias= :id");
        $stmt->bindValue(':id', $id , PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchObject();
    }
      

    function delete($id)
    {
	     $stmt = $this->db->prepare("update ambientes set estado=0 where idambientes=:id");
          $stmt->bindValue(':id', $id , PDO::PARAM_STR);
          $res=$stmt->execute();
        return $res;
    }
    function getFacultad()
    {
        $stmt = $this->db->prepare("SELECT * from facultad");
        $stmt->execute();
        return $stmt->fetchAll(); 
    }
	
    function getAmbiente($id)
    {
          $stmt = $this->db->prepare("SELECT  ambiente.ambi_id as idambientes,ambiente.ambi_descripcion as piso from ambiente  WHERE facu_id=:id");
          $stmt->bindValue(':id', $id , PDO::PARAM_INT);
          $stmt->execute();
       return $stmt->fetchAll();
    }
    
     function getAulas($id)
    {
          $stmt = $this->db->prepare("SELECT
ubicacion.ubic_id as idambientes,
ubicacion.ubic_descripcion as aulas
FROM
ubicacion
where ambi_id=$id
");
         
          $stmt->execute();
        return $stmt->fetchAll();
    }
	
	 function getIncidencia($id)
    {
          $stmt = $this->db->prepare("SELECT
incidencia.id_incidencia as id_incidencia,
tipo_averia.descripcion as tipo_averia,
incidencia.descripcion as incidencia,
incidencia.posible_solucion as solucion
FROM
incidencia
INNER JOIN tipo_averia ON incidencia.id_tipoaveria = tipo_averia.id_tipoaveria
where incidencia.id_tipoaveria=$id
");
         
          $stmt->execute();
        return $stmt->fetchAll();
    }
    public function _show($id)
    {
        //
     $stmt = $this->db->prepare("SELECT  averias.idaverias,averias.descripcion,averias.imagen,averias.fecha,ambientes.aulas ,a.piso,facultad.nombre from averias
INNER JOIN ambientes on(ambientes.idambientes=averias.ambiente)
INNER JOIN ambientes as a on(ambientes.codigo_aula=a.idambientes)
INNER JOIN facultad on(facultad.idfacultad=a.facultad) where averias.idaverias=:id");
  $stmt->bindValue(':id', $id , PDO::PARAM_INT);
  $stmt->execute();
  return $stmt->fetchObject();   
    }
	public function Localizate($longitud,$latitud)
	{
	 $stmt = $this->db->prepare("SELECT
facultad.facu_id,
coordenada.latitud,
coordenada.longitud,
facultad.facu_descripcion as nombre
FROM
facultad
INNER JOIN coordenada ON coordenada.facu_id = facultad.facu_id");
  $stmt->execute();
  $data=$stmt->fetchAll(); 
  $a=array();
  $i=0;
foreach($data as $k)
{
$r1=$k[1]-$longitud;
$r2=$k[2]-$latitud;
 $d1=pow($r1,2);
 $d2=pow($r2,2);
 $d=sqrt($d1+$d2);
 $a[$i][0]=$k[0];
 $a[$i][1]=$k[3];
 $a[$i][2]=$d;
 $i++;
}  
  $matriz=self::orderMultiDimensionalArray($a,2,false);   
  
 return $matriz; 
 }
 
 
public function  getAmbientes($id)
{
 $stmt = $this->db->prepare("SELECT ambi_id as idambientes,ambi_descripcion as piso,ambi_descripcion as aula from ambiente WHERE facu_id=$id");
  $stmt->execute();
  return $stmt->fetchAll();
 
}
/*public function getAulas($id)
{
  ////////////////
 $stmt2 = $this->db->prepare("SELECT idambientes,piso,aulas,codigo_aula from 
ambientes
WHERE facultad=$id and codigo_aulas<>'' ");
  $stmt2->execute();
  return $stmt2->fetchAll();
}*/

 function orderMultiDimensionalArray ($toOrderArray, $field, $inverse = false) {
    $position = array();
    $newRow = array();
    foreach ($toOrderArray as $key => $row) {
            $position[$key]  = $row[$field];
            $newRow[$key] = $row;
    }
    if ($inverse) {
        arsort($position);
    }
    else {
        asort($position);
    }
    $returnArray = array();
    foreach ($position as $key => $pos) {
        $returnArray[] = $newRow[$key];
    }
    return $returnArray;
}
}
?>
