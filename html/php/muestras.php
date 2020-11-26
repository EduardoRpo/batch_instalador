<?php
require_once('../../conexion2.php');

// guardar el numero de muestras

$id_batch = $_POST['id'];
$muestras = $_POST['muestras'];

//la popup de muestras guarda solo una porcion hasta el final cuando firma debe validarse que todas las muestras estan almacenadas

$query_eliminar_tanque = mysqli_query($conn, "DELETE FROM batch_muestras WHERE id_batch ='$id_batch'");

if(count($muestras) > 0 ){
    for($i=0; $i < count($muestras); ++$i){
      $query_muestras = "INSERT INTO batch_muestras (muestra, id_batch) VALUES('$muestras[$i]', '$id_batch')";
      $result = mysqli_query($conn, $query_muestras);
    }
  }
//$result = mysqli_num_rows($query_muestras);

if ($result) {
    echo "Muestras insertadas";
} else {
    echo "Error al insertar las muestras"; //. msqli_error($conn);
}

mysqli_close($conn);

?>