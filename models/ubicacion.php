<?php

include_once('phpORM/ORMBase.php');

class Ubicacion extends ORMBase {

    protected $tablename = 'ubicacion';
    protected $hasone = array(
        'Ambiente' => 'Ambiente'
    );

    public static function bucarUbicacionAll($id) {
        $sql = "SELECT * "
                . "FROM ubicacion as u "
                . "INNER JOIN ambiente as a ON a.ambi_id=u.ambi_id "
                . "WHERE u.ubic_id=?";
        $a = ORMConnection::Execute($sql, array($id));
        if (count($a) > 0) {
            return $a[0];
        } else {
            return array();
        }
    }

}

?>
