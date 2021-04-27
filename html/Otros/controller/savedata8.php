<?php

  if (isset($_POST['user1']) === true && empty($_POST['user1']) === false) {

    require('../../conexion.php');

    $query = "SELECT * FROM producto WHERE referencia = '" . $_POST['user1'] . "'";
    $result = mysqli_query($conn, $query);


    while ($row = mysqli_fetch_array($result)) {
      echo $row['nombre_referencia'];

    }
  }


?>