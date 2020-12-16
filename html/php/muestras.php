<?php
if (!empty($_POST)) {

  require_once('../../conexion.php');

  //Carga las variables

  $batch = $_POST['id'];
  $muestras = $_POST['muestras'];
  $referencia = $_POST['referencia'];

  // Guardar el numero de muestras

  if (count($muestras) > 0) {
    for ($i = 0; $i < count($muestras); ++$i) {
      $sql = "INSERT INTO batch_muestras (muestra, id_batch, referencia) VALUES (:muestras, :batch, :referencia)";
      $query = $conn->prepare($sql);
      $result = $query->execute([
        'muestras' => $muestras[$i],
        'batch' => $batch,
        'referencia' => $referencia,
      ]);
    }
  }

  if ($result) {
    echo "1";
  } else {
    echo "0";
  }
}
