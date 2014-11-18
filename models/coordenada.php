<?php
    include_once('phpORM/ORMBase.php');

    class Coordenada extends ORMBase{
       protected $tablename = 'coordenada';

       protected $hasone = array(
           'Facultad' => 'Facultad'
        );
    }
?>
