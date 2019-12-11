<?php
    session_start();
    include('connectdb.php');
    if(isset($_POST['enviar'])) { // comprobamos que se hayan enviado los datos del formulario
        // comprobamos que los campos usuarios_nombre y usuario_clave no estén vacíos
        if(empty($_POST['name']) || empty($_POST['password'])) {
            echo "El usuario o la contraseña no han sido ingresados. <a href='javascript:history.back();'>Reintentar</a>";
        }else {
            $usuario_nombre = ($_POST['name']);
            $usuario_clave = ($_POST['password']);
            $usuario_clavee = md5($usuario_clave);
            // comprobamos que los datos ingresados en el formulario coincidan con los de la BD
            $sql = "SELECT * FROM users WHERE name = '$usuario_nombre' AND password= '$usuario_clavee'";
            // var_dump($sql);
            $result = mysqli_query($conn, $sql);
            // var_dump($result);
            if (mysqli_num_rows($result) > 0 ) {
              while($row = $result->fetch_assoc()) {
                  // var_dump($row);
                  $_SESSION['name'] = $row["name"]; // creamos la sesion "usuario_nombre" y le asignamos como valor el campo usuario_nombre
                  $date = date("Y-m-d");
                  $ip = $_SERVER['REMOTE_ADDR'];
                  $reg = "INSERT INTO `history`(user_name, datee, confirmed, ip) VALUES ('$usuario_nombre','$date','SI','$ip')";
                  if (mysqli_query($conn, $reg)) {
                    echo "Se ha agregado al historial de accesos correctos";
                  } else {
                    echo "Error (no se agregó al historial): " . $reg . "<br>" . mysqli_error($conn);
                  }
                  mysqli_close($conn);
                  header("Location: login.php");
              }
            }else {
              $date = date("Y-m-d");
              $ip = $_SERVER['REMOTE_ADDR'];
              $reg = "INSERT INTO `history`(user_name, datee, confirmed, ip) VALUES ('$usuario_nombre','$date','NO','$ip')";
              if (mysqli_query($conn, $reg)) {
                echo "Se ha agregado al historial de accesos incorrectos";
                header( "refresh:1;url=login.php" );
              } else {
                echo "Error (no se agregó al historial): " . $reg . "<br>" . mysqli_error($conn);
              }
              mysqli_close($conn);
?>
                Error, <a href="login.php">Reintentar</a>
<?php
            }
        }
    }else {
        header("Location: login.php");
    }
?>
