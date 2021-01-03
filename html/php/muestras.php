<?php
if (!empty($_POST)) {

  require_once('../../conexion.php');

  $op = $_POST['operacion'];
  
  $batch = $_POST['idBatch'];
  $modulo = $_POST['modulo'];
  $ref_multi = $_POST['ref_multi'];
  
  switch ($op) {
    case 1:
      //Carga las variables
      $muestras = $_POST['muestras'];

      // Guardar el numero de muestras

      if (count($muestras) > 0) {
        for ($i = 0; $i < count($muestras); ++$i) {
          $sql = "INSERT INTO batch_muestras (muestra, modulo, batch, referencia) VALUES (:muestras, :modulo, :batch, :referencia)";
          $query = $conn->prepare($sql);
          $result = $query->execute([
            'muestras' => $muestras[$i],
            'modulo' => $modulo,
            'batch' => $batch,
            'referencia' => $ref_multi,
          ]);
        }
      }

      if ($result) {
        echo "1";
      } else {
        echo "0";
      }
      break;

    case 2:
      
      $sql = "SELECT * FROM batch_muestras 
              WHERE modulo = :modulo AND batch = :batch AND referencia = :ref_multi";

      $query = $conn->prepare($sql);
      $result = $query->execute([
        'modulo' => $modulo,
        'batch' => $batch,
        'ref_multi' => $ref_multi,
      ]);

      while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
        $arreglo["data"][] = $data;
      }
      
      if (empty($arreglo))
        echo '3';
      else
        echo json_encode($arreglo, JSON_UNESCAPED_UNICODE);

      break;
  }
}
