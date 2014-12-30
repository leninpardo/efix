<?php
include_once("Main.php");
class aula extends Main
{
	function save($P)
    {
		if($P['oper']==1)
		{    
			$sql =("insert into ambientes(idambientes,codigo_aula,aulas,facultad,estado)values(:p1,:p2,:p3,:p4,1)");
			$stmt =$this->db->prepare($sql);
			try
			{
				$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$this->db->beginTransaction();
                             $stmt->bindValue(':p1',  $this->max_id("ambientes"), PDO::PARAM_STR);
                             $stmt->bindValue(':p2',$P['ambiente'], PDO::PARAM_INT);
                             $stmt->bindValue(':p3',$P['descripcion'], PDO::PARAM_STR);
                               $stmt->bindValue(':p4',$P['facultad'], PDO::PARAM_INT);
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
	}

	function edit($id ) //Esta funcion es para actualizar en el formulario de la tabla seleccionada
	{
        $stmt = $this->db->prepare("SELECT * FROM ambientes WHERE idambientes = :id");
        $stmt->bindValue(':id', $id , PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchObject();
    }
      
function getfacultad($id ) //Esta funcion es para actualizar en el formulario de la tabla seleccionada
	{
        $stmt = $this->db->prepare("
SELECT facultad.idfacultad,facultad.nombre  from ambientes
INNER JOIN facultad on(ambientes.facultad=facultad.idfacultad)
WHERE ambientes.idambientes= :id");
        $stmt->bindValue(':id', $id , PDO::PARAM_STR);
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
}
?>