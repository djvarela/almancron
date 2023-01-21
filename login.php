<?php
session_start();
date_default_timezone_set('America/Argentina/Buenos_Aires');
include('./DDBB.php');
if ($_POST) {
    $email = $_POST['email'];
    $password = $_POST['clave'];
    $clave = sha1($password);
    $query = $connection->prepare("SELECT * FROM users WHERE EMAIL=:email");
    $query->bindParam("email", $email, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    if (!$result) {
    }else {
        if ( ($clave === $result['CLAVE']) && ($email === $result['EMAIL']) ) {

            $_SESSION['user_id'] = $result['ID'];
            $_SESSION['nombre'] = $result['NOMBRE'];
            $_SESSION['email'] = $result['EMAIL'];
            $id = $result['ID'];
            header("HTTP/1.1 302 Moved Temporarily");
            header("Location: ./index.php");
        }
    }
}
?>
<html lang="es>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/style.css">
    <link rel="icon" type="image/x-icon" href="./favicon.ico">
    <title>Ingreso</title>
</head>
<body>
    
<div id="signup">
    
    <form method="post" action="./login.php" name="login" autocomplete="off" >
        <img src="./icons/calendars.svg" alt="">
        <h1>ALMANCRON</h1>
        <h2>INGRESAR</h2>
    <div class="emailConteiner">

        <span>
            
            <img src="./icons/email.svg" alt="">
            <input type="text" name="email" id="email" autocomplete="off"  required/>
            <label for="email" class="labelEmail">Correo:</label>

        </span>

    </div>

<div class="claveConteiner">
    
    <span>
        <img src="./icons/padlock.svg" alt="">
        <input type="password" name="clave" id="clave"  autocomplete="off" required/>
        <label for="clave"  class="labelClave" >Clave:</label>
    </span>
        
</div>
    <button class="button">Iniciar sesión</button>

    <?php
        if ($_POST) {
            if (!$result){
                echo '<p class="errorMsg">¡La combinación de nombre de usuario y contraseña es incorrectaa!</p>';
                
            }else if( $email != $result['EMAIL'] || $clave != $result['CLAVE']   ){
                echo '<p class="errorMsg">¡La combinación de nombre de usuario y contraseña es incorrectaa!</p>';
            };

            if(@$result['ESTADO'] === '0'){
            echo '<p class="errorMsg">¡Su cuenta se encuentra inactiva!</p>';
            };

        }; ?>
    </form>
    </div>

</body>
</html>