<?php
    include_once('phpORM/ORMBase.php');

    class Personal extends ORMBase{
       protected $tablename = 'personal';

       protected $hasone = array(
           'Area_Adminsitrativa' => 'Area_Adminsitrativa'
        );
       
        public static function datosReporte($desde,$hasta,$id_tipoaveria,$id_personal,$estado) {
            $sql = "
                        select * from func_reporte_averia_tecnico('$desde','$hasta',$id_tipoaveria,$id_personal,'$estado')
                   ";

            return ORMConnection::Execute($sql);
        }
		
		public static function datos() {
            $sql = "
                        select personal.id_personal,personal.apellido_paterno,personal.apellido_materno,personal.nombres from personal 
INNER JOIN tarea on(tarea.id_personal=personal.id_personal)
where personal.estado=true 
GROUP BY personal.id_personal,personal.apellido_paterno,personal.apellido_materno,personal.nombres
                   ";

            return ORMConnection::Execute($sql);
        }
    }
?>
