<?php
   session_start();
   include('connectdb.php'); // incluímos los datos de acceso a la BD
   // comprobamos que se haya iniciado la sesión
   if(isset($_SESSION['name'])) {
?>
       <!DOCTYPE html>
       <html lang="es" dir="ltr">
         <head>
           <meta charset="utf-8">
           <title>Usuario Registrado</title>
           <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
         </head>
         <body>
           <div class="container">
             <p><a href="logout.php">Cerrar Sesión</a></p>
             <p><a href="index.php">Home</a></p>
           <h1>Control de accesos</h1>
           <table class="table">
             <thead class="thead-dark">
               <tr>
                 <th scope="col">Usuario</th>
                 <th scope="col">Fecha</th>
                 <th scope="col">Acceso</th>
                 <th scope="col">IP</th>
               </tr>
             </thead>
             <tbody>
               <?php
               $sql = "SELECT user_name, datee, confirmed, ip FROM history";
               $result = $conn->query($sql);

               if ($result->num_rows > 0) {
                 while ($row = $result->fetch_assoc()) {
                   echo"<tr>
                     <th scope='row'>". $row["user_name"]. "</th>
                     <td>". $row["datee"] ."</td>
                     <td>". $row["confirmed"] ."</td>
                     <td>". $row["ip"] ."</td>
                   </tr>";
                 }
               }
               ?>
             </tbody>
           </table>

         </div>
         </body>
       </html>
<?php
   }else {
       echo "Estás accediendo a una página restringida, para ver su contenido debes estar registrado.

       <a href='acceso.php'>Ingresar</a> / <a href='registro.php'>Regitrarme</a>";
   }
?>
