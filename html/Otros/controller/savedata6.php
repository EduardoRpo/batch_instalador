<?php

  if (isset($_POST['name']) === true && empty($_POST['name']) === false) {

    require('../../conexion.php');

    $query = "SELECT * FROM producto INNER JOIN presentacion_comercial ON producto.id_presentacion_comercial = presentacion_comercial.id WHERE referencia = '" . $_POST['name'] . "'";
    $result = mysqli_query($conn, $query);


    while ($row = mysqli_fetch_array($result)) {
      echo $row['presentacion'];

    }
  }


?>