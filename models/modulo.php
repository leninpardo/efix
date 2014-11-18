<?php

include_once('phpORM/ORMBase.php');

class Modulo extends ORMBase {

    protected $tablename = 'modulo';

    public static function modulosPadre($perf_id) {
        $sql = "
                    SELECT m.modu_id, m.modu_descripcion, m.modu_url
                    FROM permiso as p
                    INNER JOIN modulo as m ON m.modu_id=p.modu_id
                    WHERE m.modu_padre = 0 AND m.modu_estado = TRUE AND p.perm_estado = TRUE AND p.perf_id = ?
                    ORDER BY m.modu_peso ASC
	       ";

        return ORMConnection::Execute($sql, array($perf_id));
    }

    public static function modulosHijo($modu_padre, $perf_id) {
        $sql = "
                    SELECT m.modu_id,m.modu_descripcion,m.modu_url
                    FROM permiso as p
                    INNER JOIN modulo as m ON m.modu_id = p.modu_id
                    WHERE m.modu_padre = ? AND m.modu_estado = TRUE AND p.perm_estado = TRUE AND p.perf_id = ?
                    ORDER BY m.modu_peso ASC 
	       ";

        return ORMConnection::Execute($sql, array($modu_padre, $perf_id));
    }

    public static function modulosPadrePerfil($perf_id) {
        $sql = "
                    SELECT  m.modu_id,m.modu_descripcion,m.modu_url,p.perf_id,p.perm_estado
                    FROM permiso as p
                    INNER JOIN modulo as m ON m.modu_id = p.modu_id
                    WHERE m.modu_padre = 0 AND m.modu_estado = TRUE AND p.perf_id = ?
                    ORDER BY m.modu_peso ASC
      ";

        return ORMConnection::Execute($sql, array($perf_id));
    }

    public static function modulosHijoPerfil($perf_id, $id_padre) {
        $sql = "
                    SELECT m.modu_id,m.modu_descripcion,m.modu_url,p.perf_id,p.perm_estado
                    FROM permiso as p
                    INNER JOIN modulo as m ON m.modu_id = p.modu_id
                    WHERE m.modu_padre = ? AND m.modu_estado = TRUE AND p.perf_id = ?
                    ORDER BY m.modu_peso ASC
      ";

        return ORMConnection::Execute($sql, array($id_padre, $perf_id));
    }

}

?>
