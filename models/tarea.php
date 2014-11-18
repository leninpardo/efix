<?php
    include_once('phpORM/ORMBase.php');

    class Tarea extends ORMBase{
       protected $tablename = 'tarea';

       public static function getNumeroDias($id_tarea){
           
           $sql = "select i.tiempo_estimado from tarea as t
            INNER JOIN averia as a ON a.id_averia=t.id_averia
            INNER JOIN incidencia as i ON i.id_incidencia=a.id_incidencia
            where t.id_tarea = ? ";
           
          $r= ORMConnection::Execute($sql, array($id_tarea));
		  return $r[0]['tiempo_estimado'];
       }

          public static function averias($id) {
        $sql = "SELECT av.*, f.position "
                . "FROM ubicacion as u "
                . "INNER JOIN ambiente as a ON a.ambi_id=u.ambi_id "
                ."INNER JOIN Averia  as av on av.ubic_id =u.ubic_id "
                ."INNER JOIN facultad as f on f.facu_id=a.facu_id "
                . "WHERE av.id_averia=?";
        $a = ORMConnection::Execute($sql, array($id));
        if (count($a) > 0) {
            return $a[0];
        } else {
            return array();
        }
    }
	
	public function  getTareas($id_personal)
	{
	  $sql = "SELECT (SELECT count(averia.seguimiento) from tarea INNER JOIN averia on(averia.id_averia=tarea.id_averia) where averia.seguimiento='O' and tarea.id_personal=$id_personal) as pendiente ,
(SELECT count(averia.seguimiento) from tarea INNER JOIN averia on(averia.id_averia=tarea.id_averia) where averia.seguimiento='A' and tarea.id_personal=$id_personal) as atendido ,
(SELECT count(tarea.id_tarea) from tarea INNER JOIN averia on(averia.id_averia=tarea.id_averia) where tarea.tipo_efectividad='E' and tarea.id_personal=$id_personal) as excelente,
(SELECT count(tarea.id_tarea) from tarea INNER JOIN averia on(averia.id_averia=tarea.id_averia) where tarea.tipo_efectividad='B' and tarea.id_personal=$id_personal) as bueno,
(SELECT count(tarea.id_tarea) from tarea INNER JOIN averia on(averia.id_averia=tarea.id_averia) where tarea.tipo_efectividad='M' and tarea.id_personal=$id_personal) as malo

";
        $a = ORMConnection::Execute($sql);
       
            return $a;
        
	}
	
    }
?>
