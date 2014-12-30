<?php
include_once("Main.php");
class _Permisos extends Main
{
   function index($query , $p ) {
        $sql = "select * from boletin  where titulo ilike :query";
        $param = array(array('key'=>':query' , 'value'=>"%$query%" , 'type'=>'STR' ));
        $data['total'] = $this->getTotal( $sql, $param );
        $data['rows'] =  $this->getRow($sql, $param , $p );
        $data['rowspag'] =  $this->getRowPag($data['total'], $p );
        return $data;
    }

    function Modulos($p)
    {
        $stmt = $this->db->prepare("
		select m.idmodulo,m.descripcion,p.acceder,p.insertar,p.editar,p.eliminar,c.descripcion,p.idpermiso
FROM
permiso as p
right outer join perfil as c ON  p.perfil = c.idperfil
right outer join modulo as m on p.modulo=m.idmodulo and c.idperfil=:p1 WHERE m.submodulo is null and m.estado=1
");
        $stmt->bindValue(':p1', $p , PDO::PARAM_INT);
        $stmt->execute();        
        $items = $stmt->fetchAll();
        $cont = 0; 
        $cont2 = 0;
        foreach ($items as $valor)
        {
            $stmt = $this->db->prepare("
			select m.idmodulo,m.descripcion,p.acceder,p.insertar,p.editar,p.eliminar,c.descripcion,p.idpermiso
FROM
permiso as p
right outer join perfil as c ON  p .perfil = c.idperfil
right outer join modulo as m on p.modulo=m.idmodulo and c.idperfil=:p1 WHERE m.submodulo=:p2 and m.estado=1
               
                 ");
            $stmt->bindValue(':p1', $p , PDO::PARAM_INT);
            $stmt->bindValue(':p2', $valor[0] , PDO::PARAM_INT);
            $stmt->execute();
            $hijos = $stmt->fetchAll();
            $menu[$cont] = array(
			'idmodulo' => $valor[0],
			'descripcion' => $valor[1],
		    'acceder' => $valor[2],
		    'insertar' => $valor[3],
		    'modificar' => $valor[4],
		    'eliminar' => $valor[5],
            'cargo' => $valor[6],
            'idpermiso' => $valor[7],
            
            
            'hijos' => array()
                );
            $cont2 = 0;
            foreach($hijos as $h)
            {
              $menu[$cont]['hijos'][$cont2] = array(
			  'idmodulo' => $h[0],
			  'descripcion' => $h[1],
			  'acceder' => $h[2],
		      'insertar' => $h[3],
		      'modificar' => $h[4],
		      'eliminar' => $h[5],
			  'cargo'=>$h[6],
			  'idpermiso'=>$h[7],
			  
			  );
              $cont2 ++;
            }
            $cont ++;
        }
        return $menu;
    }

    public function Save($p)
    {
        $stmt = $this->db->prepare("DELETE FROM permiso where perfil = :p1");
        $stmt2 = $this->db->prepare("INSERT INTO permiso VALUES(:p2,:p3,1,1,1,1,1)");        
        try{
                $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->db->beginTransaction();
                    $stmt->bindValue(':p1',$p['id_perfil'] , PDO::PARAM_INT);
                    $id_perfil = $p['id_perfil'];
                    $stmt->execute();
                    foreach( $p as $key => $val)
                    {
                        if($key!="controller" && $key!="action" && $key!="id_perfil")
                        {
                            $stmt2->bindValue(':p3',$val);
                            $stmt2->bindValue(':p2',$id_perfil);
                            $stmt2->execute();
                        }
                    }
                $this->db->commit();
                return array('res'=>"1",'msg'=>'Sus Cambios fueron guardados Correctamente!');
            }
            catch(PDOException $e) {
                $this->db->rollBack();
                return array('res'=>"2",'msg'=>'Error : '.$e->getMessage() . $str);
            }

    }
	public function _Save($G)
	{ 
	   $sql =$this->Query("usp_permiso(:p1,:p2,:p3,:p4,:p5,:p6,:p7)");
	   $stmt= $this->db->prepare($sql) ;
	        try
        {
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->beginTransaction();
			$id=$G['id_perfil'];
		
           foreach ($G['codigo'] as $key => $value)
            {  
		        if ($G['acceder'][$key]=='on'){$G['acceder'][$key]=1;}else{$G['acceder'][$key]=0;}
			    if ($G['insertar'][$key]=='on'){$G['insertar'][$key]=1;}else{$G['insertar'][$key]=0;}
                if ($G['modificar'][$key]=='on'){$G['modificar'][$key]=1;}else{$G['modificar'][$key]=0;}
                if ($G['eliminar'][$key]=='on'){$G['eliminar'][$key]=1;}else{$G['eliminar'][$key]=0;}
		
                $stmt->bindValue(':p1',$id, PDO::PARAM_INT);
				$stmt->bindValue(':p2',$value, PDO::PARAM_INT);
                $stmt->bindValue(':p3',$G['modificar'][$key], PDO::PARAM_INT);
                $stmt->bindValue(':p4',$G['eliminar'][$key], PDO::PARAM_INT);
                $stmt->bindValue(':p5',$G['insertar'][$key], PDO::PARAM_INT);
                $stmt->bindValue(':p6',$G['acceder'][$key], PDO::PARAM_INT);
                $stmt->bindValue(':p7',$G['idpermiso'][$key], PDO::PARAM_INT);
            
                $stmt->execute();
				
				
             }
            $this->db->commit();
            return array('res'=>"1",'msg'=>'Sus Cambios fueron guardados Correctamente!');
        
        }
        catch(PDOException $e)
        {
            $this->db->rollBack();
            return array('res'=>"2",'msg'=>'no se pudo realizar la accion de insertar : '.$e->getMessage());
        }
        
	}
}
?>