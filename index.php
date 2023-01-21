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

 
    $c = "INSERT INTO cumples( EMAIL, NOMBRE, FECHA, REGISTRO) VALUES (?,?,?, NOW())";
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
    <link rel="stylesheet" href="./assets/normalize.css">
    <link rel="stylesheet" href="./assets/style.css">
    <title>Nuevo Recordatorio</title>
</head>
<body>
<header>
   

        <h1>ALMANCRON</h1>
        <a href="./index.php?salir">SALIR</a>
 
</header>
<section class="contenedor">

<div class="registros-conteiner">

<div class="eventos-registrados">
        <h2>Eventos registrados:</h2>


        <ul>

      <?php 
        $hoy = date("d-m");
           $q = "SELECT * FROM cumples";
           $result = $cnx->prepare($q);
           $result->execute();

           while( $row = $result->fetch()  ){
                $fecha = $row['FECHA'];
                $nombre = $row['NOMBRE'];
                echo "<li>$nombre - $fecha</li>";
           };

      ?>
        </ul>
</div>

    <div class="proximos-eventos">
           <h2>Proximos evento</h2>
        <ul>

<?php 
        $hoy = date("d-m");
           $q = "SELECT * FROM cumples WHERE FECHA >= $hoy";
           $result = $cnx->prepare($q);
           $result->execute();

           while( $row = $result->fetch()  ){
                
                $nombre = $row['NOMBRE'];
                $fecha = $row['FECHA'];
                echo "<li>$nombre - $fecha   </li>";

           };
      
      
      ?>


</ul>
</div>
</div>


<form action="index.php" method="post" class="forms">
        <h2>Agregar Recordatorio</h2>
        <label for="nombre">Nombre y Apellido:</label>
        <input type="text" name="nombre" required id="nombre">
        <label for="fecha">Fecha:</label>
        <input type="text" id="fecha"  name="fecha" required  placeholder="dia - mes">
        <button>Guardar</button>
    </form>

  
</section>
</body>
</html>