<?php
include_once("Main.php");
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
				return array('rep'=>"4",'msg'=>'no se pudo realizar la accion de actualizar : '.$e->getMessage());
			} 
    }

    function save_web($P)
    {
       $sql =("INSERT INTO averias(averias.idaverias,averias.descripcion,
           averias.fecha,averias.imagen,
           averias.ambiente,averias.estado,tipo ) values(:p1,:p2,:p3,:p4,:p5,:p6,:p7)");
			$stmt =$this->db->prepare($sql);
			try
			{
				$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$this->db->beginTransaction();
			
				$stmt->bindValue(':p1',  $this->max_id("averias"), PDO::PARAM_INT);
                                $stmt->bindValue(':p2',$P['descripcion'], PDO::PARAM_STR);
                                $stmt->bindValue(':p3',"2014-05-18", PDO::PARAM_STR);
                                $stmt->bindValue(':p4',$P['fotografia'], PDO::PARAM_STR);
                                $stmt->bindValue(':p5',$P['tipoau'], PDO::PARAM_INT);  
                                $stmt->bindValue(':p6',1, PDO::PARAM_INT);
                                $stmt->bindValue(':p7',$P['tipoa'], PDO::PARAM_INT);
				//$stmt->bindValue(':id',$P['idaverias'], PDO::PARAM_INT);
				$stmt->execute();
				$this->db->commit();
				$resp = array('rep'=>'2','str'=>'Ok');
				return $resp;
			}
			catch(PDOException $e) 
			{
				$this->db->rollBack();
				return array('rep'=>"4",'msg'=>'no se pudo realizar la accion de actualizar : '.$e->getMessage());
			} 
    }
    /*
	function save($P)
    {
		if($P['oper']==1)
		{    
			$sql =("insert into ambientes(idambientes,piso,facultad,estado)values(:p1,:p2,:p3,1)");
			$stmt =$this->db->prepare($sql);
			try
			{
				$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$this->db->beginTransaction();
                             $stmt->bindValue(':p1',  $this->max_id("ambientes"), PDO::PARAM_STR);
                             $stmt->bindValue(':p2',$P['descripcion'], PDO::PARAM_INT);
                             $stmt->bindValue(':p3',$P['facultad'], PDO::PARAM_INT);
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
		else
		{  
			$sql =("update ambientes set piso=:p1,facultad=:p2 where idambientes=:id");
			$stmt =$this->db->prepare($sql);
			try
			{
				$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$this->db->beginTransaction();
			
				$stmt->bindValue(':p1',$P['descripcion'], PDO::PARAM_STR);
                                $stmt->bindValue(':p2',$P['facultad'], PDO::PARAM_INT);
				$stmt->bindValue(':id',$P['idambiente'], PDO::PARAM_INT);
				$stmt->execute();
				$this->db->commit();
				$resp = array('rep'=>'2','str'=>'Ok');
				return $resp;
			}
			catch(PDOException $e) 
			{
				$this->db->rollBack();
				return array('rep'=>"4",'msg'=>'no se pudo realizar la accion de actualizar : '.$e->getMessage());
			}
		}
	}*/

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
        $stmt = $this->db->prepare("SELECT *from facultad");
        $stmt->execute();
        return $stmt->fetchAll(); 
    }
    function getAmbiente($id)
    {
          $stmt = $this->db->prepare("select idambientes,piso from ambientes where facultad=:id and codigo_aula is null");
          $stmt->bindValue(':id', $id , PDO::PARAM_INT);
          $stmt->execute();
        return $stmt->fetchAll();
    }
    
     function getAulas($id)
    {
          $stmt = $this->db->prepare("select idambientes,aulas from ambientes where   codigo_aula=:id");
          $stmt->bindValue(':id', $id , PDO::PARAM_INT);
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
	 $stmt = $this->db->prepare("SELECT idfacultad,longitud,latitud,nombre from facultad");
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
  $m=array();
   $m1=array();
  $i=0;
  $j=0;
  foreach($matriz as $k)
  {
   $stmt = $this->db->prepare("SELECT ambientes.idambientes,ambientes.piso from ambientes 
INNER JOIN facultad on(facultad.idfacultad=ambientes.facultad)
WHERE ambientes.facultad=$k[0] and ambientes.codigo_aula is null");
  $stmt->execute();
  $data=$stmt->fetchAll();
  foreach($data as $ka)
  {
      $stmt = $this->db->prepare("SELECT ambientes.idambientes,ambientes.aulas from ambientes 
INNER JOIN facultad on(facultad.idfacultad=ambientes.facultad)
WHERE  ambientes.facultad=$ka[0] and ambientes.aulas<>'' ");
  $stmt->execute();
  $data_aulas=$stmt->fetchAll();
  $name1=$ka[0];
  if($data_aulas!=null)
  {
  $m1[$name1]=$data_aulas;
  }
  $j++;
  }
   $name=$k[1];
   if($data!=null)
   {
   $m[$i]=$data;
   }
  $i++;
  }
 return array("ambientes"=>$m,"aulas"=>$m1); 
}
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