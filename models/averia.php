<?php
    include_once('phpORM/ORMBase.php');

    class Averia extends ORMBase{
       protected $tablename = 'averia';

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

    }
?>
