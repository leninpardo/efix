<?php
include_once("Main.php");
class facultad extends Main
{
	function save($P)
    {
		if($P['oper']==1)
		{    
			$sql =("insert into facultad(idfacultad,nombre,
                            longitud,latitud,altura,estado) values(:p1,:p2,:p3,:p4,:p5,0)");
			$stmt =$this->db->prepare($sql);
			try
			{
				$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$this->db->beginTransaction();
                $stmt->bindValue(':p1',  $this->max_id("facultad"), PDO::PARAM_INT);
                $stmt->bindValue(':p2', $P["nombre"], PDO::PARAM_STR);
                $stmt->bindValue(':p3', $P["longitud"], PDO::PARAM_STR);
                $stmt->bindValue(':p4', $P["latitud"], PDO::PARAM_STR);
                $stmt->bindValue(':p5', $P["altura"], PDO::PARAM_STR);
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
			$sql =("update facultad set nombre=:p1,longitud=:p2,latitud=:p3,altura=:p4 where idfacultad=:id");
			$stmt =$this->db->prepare($sql);
			try
			{
				$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$this->db->beginTransaction();
                 $stmt->bindValue(':id', $P["idfacultad"], PDO::PARAM_INT);
                $stmt->bindValue(':p1', $P["nombre"], PDO::PARAM_STR);
                $stmt->bindValue(':p2', $P["longitud"], PDO::PARAM_STR);
                $stmt->bindValue(':p3', $P["latitud"], PDO::PARAM_STR);
                $stmt->bindValue(':p4', $P["altura"], PDO::PARAM_STR);
                
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
		}
	}

	function edit($id ) //Esta funcion es para actualizar en el formulario de la tabla seleccionada
	{
        $stmt = $this->db->prepare("SELECT * FROM facultad WHERE idfacultad = :id");
        $stmt->bindValue(':id', $id , PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchObject();
    }
      

    function delete ($id)
    {
	     $stmt = $this->db->prepare("update facultad set estado=0 where idfacultad = :id");
          $stmt->bindValue(':id', $id , PDO::PARAM_STR);
          $res=$stmt->execute();
        return $res;
    }
}
?>