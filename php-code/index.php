<?php
session_start();
include('connectdb.php');
?>
<!doctype html>
<html lang="en">
<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <meta charset="UTF-8">
  <title>Document</title>
</head>
<body>
  <div class="container">

    <?php
    if(isset($_SESSION['name'])) {
      ?>
      <p>Bienvenido: <strong><?=$_SESSION['name']?></strong></p>
      <h3>Control de accesos</h3>
      <p><a href="paginaR.php">Acceder a Control de accesos</a></p>
      <h3>Usuarios</h3>
      <p><a href="addUser.php">Agregar otro usuario</a></p>
      <p><a href="editarPerfil.php">Cambiar nombre o contraseña</a></p>
      <p> <a href="borrarUser.php">Borrar esta cuenta</a></p>
      <br>
      <br>
      <a href="logout.php">Cerrar Sesión</a>


      <?php
    }else {
      ?>
      <a href="register.php">Registrarse</a> | <a href="login.php">Ingresar</a>
      <?php
    }
    ?>

  </div>
</body>
</html>
