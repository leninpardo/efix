<?php
    include_once('phpORM/ORMBase.php');

    class Usuario extends ORMBase{
       protected $tablename = 'usuario';

       protected $hasone = array(
           'Perfil' => 'Perfil'
        );
    }
?>
