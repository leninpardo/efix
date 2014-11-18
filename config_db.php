<?php
$ini=parse_ini_file("config.ini",true);
 $keybd = key($ini);
 /*
$config_db['driver'] = 'postgres';
$config_db['server'] = 'localhost:5432';
$config_db['user'] = 'postgres';
$config_db['password'] = '123456';
$config_db['database']='efix';*/
 $config_db['driver'] = $keybd;
$config_db['server'] =$ini[$keybd]['host'].':'.$ini[$keybd]['port'];
$config_db['user'] = $ini[$keybd]['username'];
$config_db['password'] = $ini[$keybd]['password'];
$config_db['database']=$ini[$keybd]['dbname'];


?>