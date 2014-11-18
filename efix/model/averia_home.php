<?php
require_once'../lib/PGSQL_spdo.php';
class averia
{
      protected $db;
  protected $exec;
  
  public function __construct()
		{
				$this->db = PGSQL_spdo::singleton();
				$this->exec=PGSQL_spdo::getExec();
		}  
                
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
	}

	function edit($id ) //Esta funcion es para actualizar en el formulario de la tabla seleccionada
	{
        $stmt = $this->db->prepare("SELECT * FROM averias WHERE idaverias= :id");
        $stmt->bindValue(':id', $id , PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchObject();
    }
      
/*
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
    }*/
    function getAmbiente($id)
    {
          $stmt = $this->db->prepare("select idambientes,piso from ambientes where facultad=:id and codigo_aula is null");
          $stmt->bindValue(':id', $id , PDO::PARAM_INT);
          $stmt->execute();
        return $stmt->fetchAll();
    }
    
}
?>