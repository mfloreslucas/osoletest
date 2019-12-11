<?php
session_start();
include('connectdb.php');
if(empty($_SESSION['name'])) { // comprobamos que las variables de sesión estén vacías
  ?>
  <!DOCTYPE html>
  <html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
      <h2>Login</h2>
      <form action="comprobar.php" method="post">
        <label>Usuario:</label>

        <input type="text" name="name" />

        <label>Contraseña:</label>

        <input type="password" name="password" />

        <input type="submit" name="enviar" value="Ingresar" />
      </form>
      <button onclick="history.go(-1);">Back </button>

    </div>
  </body>
  </html>
  <?php
}else {
  ?>
  <!DOCTYPE html>
  <html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
      <p>Hola <strong><?=$_SESSION['name']?></strong> | <a href="logout.php">Salir</a></p>
      <p><a href="index.php"><strong>Acceder</strong></a></p>

    </div>
  </body>
  </html>
  <?php
}
?>
