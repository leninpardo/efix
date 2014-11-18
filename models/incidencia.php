<?php

include_once('phpORM/ORMBase.php');

class Incidencia extends ORMBase {

    protected $tablename = 'incidencia';
    protected $hasone = array(
        'Tipo_Averia' => 'Tipo_Averia'
    );


    public static function misReportes($id_usuario) {
        $sql = "
                    select 
                    a.id_averia,to_char(a.fecha_reporte,'dd/MM/yyyy') ,a.hora_reporte,
                    f.facu_descripcion,m.ambi_descripcion,b.ubic_descripcion,
                    i.descripcion,            
                    (p.nombres||' '||p.apellido_paterno||' '||p.apellido_materno) as personal_nombres,
                    CASE 
                        WHEN a.seguimiento='P' THEN 'PENDIENTE'
                        WHEN a.seguimiento='O' THEN 'PROCESO'
                        WHEN a.seguimiento='A' THEN 'ATENDIDO'
                    END as seguimiento,a.calificacion              
                    from 
                        averia as a
                    INNER JOIN incidencia as i ON i.id_incidencia=a.id_incidencia
                    INNER JOIN ubicacion as b ON b.ubic_id=a.ubic_id
                    INNER JOIN ambiente as m ON m.ambi_id=b.ambi_id
                    INNER JOIN facultad as f ON f.facu_id=m.facu_id
                    INNER JOIN usuario as u ON u.usua_id=a.usua_id
                    LEFT JOIN tarea as t ON t.id_averia=a.id_averia
                    LEFT JOIN personal as p ON p.id_personal=t.id_personal
                    where a.usua_id = ? and a.estado = true
	       ";

        return ORMConnection::Execute($sql, array($id_usuario));
    }
    
}

?>
