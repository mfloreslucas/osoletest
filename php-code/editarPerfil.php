<?php
    session_start();
    include('connectdb.php'); // incluímos los datos de conexión a la BD
    if(isset($_SESSION['name'])) { // comprobamos que la sesión esté iniciada
        if(isset($_POST['enviar'])) {
            if($_POST['password'] != $_POST['password-confirm']) {
                echo "Las contraseñas ingresadas no coinciden. <a href='javascript:history.back();'>Reintentar</a>";
            }else {
                $usuario_nombre = $_SESSION['name'];
                $usuario_newName = ($_POST["newName"]);
                $usuario_clave = ($_POST["password"]);
                $usuario_clave = md5($usuario_clave); // encriptamos la nueva contraseña con md5
                $sql = "UPDATE users SET password='" . $usuario_clave . "' WHERE name='" . $usuario_nombre . "'";
                $req = "UPDATE users SET name = '". $usuario_newName . "'WHERE name = '" . $usuario_nombre . "'";
                $_SESSION['name'] = $usuario_newName;
                if($conn->query($sql)){
                  echo "El cambio de contraseña se guardó exitosamente";
                } else{
                  echo "ERROR: Could not able to execute pass $sql. " . $mysqli->error;
                }
                if($conn->query($req)){
                  echo "El cambio de usuario se guardó exitosamente";
                } else{
                  echo "ERROR: Could not able to execute user $sql. " . $mysqli->error;
                }
                header("Location: logout.php");
              }
        }else {
?>}       <!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Editar perfil</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  </head>
  <body>
  <div class="container">
    <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
        <label for="name">Nuevo nombre:</label>
        <input type="text" name="newName" value=""><br>


        <label>Nueva contraseña:</label>

        <input type="password" name="password" maxlength="15" /><br>

        <label>Confirmar:</label>

        <input type="password" name="password-confirm" maxlength="15" /><br>

        <input type="submit" name="enviar" value="Enviar" />
    </form>
    <p> <a href="index.php">Home</a> </p>
     </div>
     </body>
   </html>

<?php
        }
    }else {
        echo "Acceso denegado.";
    }
?>
