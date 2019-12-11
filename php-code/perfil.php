<?php
   session_start();
   include('connectdb.php');
 $ident = mysql_real_escape_string($_GET['id']);
    $perfil = mysql_query("SELECT * FROM users WHERE id='".$ident."'") or die(mysql_error());
   if(mysql_num_rows($perfil)) { // Comprobamos que exista el registro con la ID ingresada
       $row = mysql_fetch_array($perfil);
       $id = $row["id"];
       $nick = $row["name"];
       $email = $row["email"];
?>
       <strong>Nick:</strong> <?=$nick?>

       <strong>Email:</strong> <?=$email?>

       <strong>URL del perfil:</strong> <a href="perfil.php?id=<?=$id?>">Click aquí</a>
<?php
   }else {
?>
       <p>El perfil seleccionado no existe o ha sido eliminado.</p>
<?php
   }
