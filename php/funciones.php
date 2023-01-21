<?php


function proximosEventos($cnx){
    $hoy = date("d-m");
    $q = "SELECT * FROM cumples WHERE FECHA >= $hoy";
    $result = $cnx->prepare($q);
    $result->execute();

    while( $row = $result->fetch()  ){   
         $nombre = $row['NOMBRE'];
         $fecha = $row['FECHA'];
         echo "<li>$nombre - $fecha   </li>";
    };

};


function eventosRegistrados($cnx){

    $hoy = date("d-m");
    $q = "SELECT * FROM cumples";
    $result = $cnx->prepare($q);
    $result->execute();

    while( $row = $result->fetch()  ){
         $fecha = $row['FECHA'];
         $nombre = $row['NOMBRE'];
         echo "<li>$nombre - $fecha</li>";
    };

}
