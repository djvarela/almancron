<?php

date_default_timezone_set('America/Argentina/Buenos_Aires');
define('USER', 'root');
define('CLAVE', '');
define('HOST', 'localhost');
define('DATABASE', 'aniversarios');


try {
    $connection = new PDO("mysql:host=".HOST.";dbname=".DATABASE, USER, CLAVE);
  

} catch (PDOException $e) {
exit("¡OJO, Error!: " . $e->getMessage());

}





