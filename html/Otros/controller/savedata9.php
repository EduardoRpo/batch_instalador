<?php

  if (isset($_POST['name']) === true && empty($_POST['name']) === false) {

    require('../../conexion.php');

    $query = "SELECT l.densidad FROM producto as p inner join  linea as l ON l.id = p.id_linea WHERE referencia = '" . $_POST['name'] . "' ";
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_array($result)) {
      echo $row['densidad'];

    }

  }


?>
