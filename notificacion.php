<?php
date_default_timezone_set("America/Argentina/Buenos_Aires");
include("./DDBB.php");

require './phpmailer/PHPMailer.php';
require './phpmailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;


$mailer = new PHPMailer();
$mailer->CharSet="UTF-8";

$hoy = date("d-m");

$c = "SELECT * FROM cumples WHERE FECHA = '$hoy'";
$result = $cnx->prepare($c);
$result->execute();


    while($row = $result->fetch()){
        $nombre = $row['NOMBRE'];
        $fecha = $row['FECHA'];
        $destinatario = $row['EMAIL'];

    };

if($result->rowCount() == true) {


$emisor= "evento@almancron.com";
$mombreEmisor = "ALMANCRON";
$asunto = "Notificacion de recordatorio";



$mailer->setFrom( $emisor, "$mombreEmisor" ) ;
$mailer->addAddress( $destinatario );
$mailer->Subject= $asunto;
$mailer->msgHTML("Motivo de evento: $nombre - $fecha ");

if(  $fecha == $hoy ){
    echo "Motivo de evento:  $nombre  |  $fecha";
    $mailer->send();
}

}
else{

    echo "No hay eventos registrados para hoy";
};

?>