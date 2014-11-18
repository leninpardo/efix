<?php
    include_once('phpORM/ORMBase.php');

    class Ambiente extends ORMBase{
       protected $tablename = 'ambiente';

       protected $hasone = array(
           'Facultad' => 'Facultad'
        );
    }
?>
