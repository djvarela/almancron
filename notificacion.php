<?php
date_default_timezone_set("America/Argentina/Buenos_Aires");
include("./DDBB.php");

require './phpmailer/PHPMailer.php';
require './phpmailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;


$mailer = new PHPMailer();


$mailer->CharSet="UTF-8";

$hoy = date("d-m");




$cnx = $connection;
$c = "SELECT * FROM cumples WHERE FECHA = '$hoy'";
$result = $cnx->prepare($c);
$result->execute();

while($row = $result->fetch()){
    $nombre = $row['NOMBRE'];
    $cumple = $row['FECHA'];
    $destinatario = $row['EMAIL'];

};


$emisor= "diego@mail.com";
$mombreEmisor = "Diego";
$asunto = "Notificacion de recordatorio";



$mailer->setFrom( $emisor, "$mombreEmisor" ) ;
$mailer->addAddress( $destinatario );
$mailer->Subject= $asunto;
$mailer->msgHTML("Mensaje de cumple:  $nombre ");


if(  $cumple == $hoy ){
    echo "¡es hoy!";
    echo "cumple $nombre";
    $mailer->send();
}else{

    echo "nada";
};

?>