<?php
    session_start();
    include('connectdb.php'); // incluímos los datos de conexión a la BD
    if(isset($_SESSION['name'])) {
        session_destroy();
        $user_name = $_SESSION['name'];
        $sql = "DELETE FROM `users` WHERE `users`.`name`='$user_name'";
        if ($conn->query($sql)) {
          echo "Borrado";
        } else {
          echo "Error deleting record: " . $conn->error;
        }
        header("Location: index.php");
    }else {
        echo "Operación incorrecta.";
        echo "<p> <a href='index.php'>Go home</a></p>";
    }

    ?>
