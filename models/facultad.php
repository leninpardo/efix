<?php
    include_once('phpORM/ORMBase.php');

    class Facultad extends ORMBase{
       protected $tablename = 'facultad';   
        
        public static function datosReporte($desde,$hasta,$id_tipoaveria,$facu_id,$estado) {
            $sql = "
                        select * from func_reporte_averia_facultad('$desde','$hasta',$id_tipoaveria,$facu_id,'$estado')
                   ";

            return ORMConnection::Execute($sql);
        }
        
        public static function datosReporteGrafico($desde,$hasta,$id_tipoaveria,$facu_id,$estado) {
            $sql = "
                select f.facu_descripcion,i.descripcion,count(i.id_incidencia) as cantidad from facultad f inner join 
                ambiente a on f.facu_id = a.facu_id
                inner join ubicacion u on a.ambi_id = u.ambi_id
                inner join averia aa on u.ubic_id = aa.ubic_id
                inner join incidencia i on aa.id_incidencia = i.id_incidencia
                where aa.fecha_reporte >= '$desde' and aa.fecha_reporte <= '$hasta'
                group by f.facu_descripcion,i.descripcion
                   ";

            return ORMConnection::Execute($sql);
        }
        
    }
?>
