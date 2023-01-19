<?php
session_start();
include("./DDBB.php");
if(!isset($_SESSION['user_id'])){
    header("Location: ./login.php");
    die();
};

if($_POST){
    $nombre= $_POST['nombre'];
    $fecha = $_POST['fecha'];
    $email ="djvarela89@gmail.com";
    $cnx = $connection;
    $c = "INSERT INTO cumples( EMAIL, NOMBRE, FECHA) VALUES (?,?,?) ";
    $result = $cnx->prepare($c);
    $result->execute([$email, $nombre, $fecha]);
};?>
<?php  
if(isset($_GET['salir'])){
    session_destroy();
    header("Location: ./index.php");
};?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Nuevo Recordatorio</title>
</head>
<body>
<header>
<a href="./index.php?salir">salir</a>
</header>
<section class="contenedor">
    <form action="index.php" method="post" class="forms">
        <h2>Agregar Recordatorio</h2>
        <label for="nombre">Nombre y Apellido:</label>
        <input type="text" name="nombre" id="nombre">
        <label for="fecha">Fecha:</label>
        <input type="text" id="fecha"  name="fecha"  placeholder="dia - mes">
        <button>Guardar</button>
    </form>
</section>
</body>
</html>