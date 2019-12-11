<?php
include('connectdb.php'); // incluimos el archivo de conexión a la Base de Datos
if(isset($_POST['enviar'])) { // comprobamos que se han enviado los datos desde el formulario
  // creamos una función que nos parmita validar el email
  function valida_email($email) {
    if (preg_match('/^[A-Za-z0-9-_.+%]+@[A-Za-z0-9-.]+\.[A-Za-z]{2,4}$/', $email)) return true;
    else return false;
  }

  // Procedemos a comprobar que los campos del formulario no estén vacíos
  $sin_espacios = count_chars($_POST['name'], 1);
  if(!empty($sin_espacios[32])) { // comprobamos que el campo usuario_nombre no tenga espacios en blanco
    echo "El campo <em>name</em> no debe contener espacios en blanco. <a href='javascript:history.back();'>Reintentar</a>";
  }elseif(empty($_POST['name'])) { // comprobamos que el campo usuario_nombre no esté vacío
    echo "No haz ingresado tu usuario. <a href='javascript:history.back();'>Reintentar</a>";
  }elseif(empty($_POST['password'])) { // comprobamos que el campo usuario_clave no esté vacío
    echo "No haz ingresado contraseña. <a href='javascript:history.back();'>Reintentar</a>";
  }elseif($_POST['password'] != $_POST['password_confirm']) { // comprobamos que las contraseñas ingresadas coincidan
    echo "Las contraseñas ingresadas no coinciden. <a href='javascript:history.back();'>Reintentar</a>";
  }elseif(!valida_email($_POST['email'])) { // validamos que el email ingresado sea correcto
    echo "El email ingresado no es válido. <a href='javascript:history.back();'>Reintentar</a>";
  }else {
    // "limpiamos" los campos del formulario de posibles códigos maliciosos
    $user_name = ($_POST['name']);
    $user_password = ($_POST['password']);
    $user_email = ($_POST['email']);
    var_dump($user_name); echo "<br>";
    var_dump($user_password); echo "<br>";
    var_dump($user_email); echo "<br>";

    $user_password = md5($user_password); //encript
    $reg = "INSERT INTO `users`(name,email,password) VALUES ('$user_name','$user_email','$user_password')";
    if (mysqli_query($conn, $reg)) {
      echo "New user created successfully";
    } else {
      echo "Error: " . $reg . "<br>" . mysqli_error($conn);
    }
    mysqli_close($conn);
    header("Location: login.php");
  }
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
      <h2>Registro de usuario</h2>
      <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
        <label>Usuario:</label>

        <input type="text" name="name" maxlength="15" /> <br>

        <label>Contraseña:</label>

        <input type="password" name="password" maxlength="15" /> <br>

        <label>Confirmar Contraseña:</label>

        <input type="password" name="password_confirm" maxlength="15" /> <br>

        <label>Email:</label>

        <input type="text" name="email" maxlength="50" /> <br>

        <input type="submit" name="enviar" value="Registrar" />
        <input type="reset" value="Borrar" />
      </form>
      <button onclick="history.go(-1);">Back </button>

    </div>
  </body>
  </html>

  <?php
}
?>
