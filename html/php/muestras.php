<?php
require_once('../../conexion2.php');

function utf8ize($d)
{
    if (is_array($d))
        foreach ($d as $k => $v)
            $d[$k] = utf8ize($v);

    else if (is_object($d))
        foreach ($d as $k => $v)
            $d->$k = utf8ize($v);

    else
        return utf8_encode($d);

    return $d;
}

// guardar el numero de muestras

$id_batch = $_POST['id'];
$muestras = $_POST['muestras'];

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