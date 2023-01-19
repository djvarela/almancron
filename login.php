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
    <title>Ingreso</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    
<div id="signup">
    <h1>INGRESA</h1>
 
    <form method="post" action="./login.php" name="login" autocomplete="off" >
    
    <label for="email">Email:</label>
      <input type="text" name="email" id="email" autocomplete="off" />
    <label for="clvae">Password:</label>
      <input type="password" name="clave" id="clave"  autocomplete="off"/>
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