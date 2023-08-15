<?php
  /*
if (!empty($_POST)) {

  require_once('../../conexion.php');

  $op = $_POST['operacion'];
  $batch = $_POST['idBatch'];
  switch ($op) {
      case 1: // Guardar el numero de muestras de envasado
      $modulo = $_POST['modulo'];
      $ref_multi = $_POST['ref_multi'];
      $muestras = $_POST['muestras'];

      $sql = "SELECT * FROM batch_muestras 
              WHERE referencia = :referencia AND batch = :batch AND modulo = :modulo";
      $query = $conn->prepare($sql);
      $query->execute(['referencia' => $ref_multi, 'batch' => $batch, 'modulo' => $modulo]);
      $rows = $query->rowCount();

      if ($rows == 0) {
        if (count($muestras) > 0) {
          for ($i = 0; $i < count($muestras); ++$i) {
            $sql = "INSERT INTO batch_muestras (muestra, modulo, batch, referencia) VALUES (:muestras, :modulo, :batch, :referencia)";
            $query = $conn->prepare($sql);
            $result = $query->execute(['muestras' => $muestras[$i], 'modulo' => $modulo, 'batch' => $batch, 'referencia' => $ref_multi]);
          }
        }

        if ($result) echo true;
        else echo false;
      } else
        echo true;


      break;

    case 2:
      $modulo = $_POST['modulo'];
      $ref_multi = $_POST['ref_multi'];

      $sql = "SELECT * FROM batch_muestras WHERE modulo = :modulo AND batch = :batch AND referencia = :ref_multi";
      $query = $conn->prepare($sql);
      $result = $query->execute(['modulo' => $modulo, 'batch' => $batch, 'ref_multi' => $ref_multi]);
      $data = $query->fetchAll(PDO::FETCH_ASSOC);

      if (empty($data)) echo false;
      else echo json_encode($data, JSON_UNESCAPED_UNICODE);

      break;

    case 3:
      $modulo = $_POST['modulo'];
      $ref_multi = $_POST['ref_multi'];
      $muestras = $_POST['muestras'];
      $cantidad_muestras = count($muestras) / 5;

      $sql = "SELECT * FROM batch_muestras_acondicionamiento 
              WHERE referencia = :referencia AND batch = :batch AND modulo = :modulo";
      $query = $conn->prepare($sql);
      $query->execute(['referencia' => $ref_multi, 'batch' => $batch, 'modulo' => $modulo]);
      $rows = $query->rowCount();

      if ($rows == 0) {
        // Guardar el numero de muestras de acondicionamiento
        $ae = 0;
        $at = 1;
        $ce = 2;
        $pp = 3;
        $rc = 4;

        if (count($muestras) > 0) {
          for ($i = 1; $i <= $cantidad_muestras; ++$i) {
            $sql = "INSERT INTO batch_muestras_acondicionamiento 
                              (apariencia_etiquetas, apariencia_termoencogible, cumplimiento_empaque,	
                              posicion_producto, rotulo_caja,	batch,	modulo,	referencia)
                  VALUES (:apariencia_etiquetas, :apariencia_termoencogible	,:cumplimiento_empaque,	
                          :posicion_producto, :rotulo_caja,	:batch,	:modulo,	:referencia)";
            $query = $conn->prepare($sql);
            $result = $query->execute([
              'apariencia_etiquetas' => $muestras[$ae],
              'apariencia_termoencogible' => $muestras[$at],
              'cumplimiento_empaque' => $muestras[$ce],
              'posicion_producto' => $muestras[$pp],
              'rotulo_caja' => $muestras[$rc],
              'modulo' => $modulo,
              'batch' => $batch,
              'referencia' => $ref_multi,
            ]);
            $ae += 5;
            $at += 5;
            $ce += 5;
            $pp += 5;
            $rc += 5;
          }
        }

        if ($result) echo true;
        else echo false;
      } else echo true;

      break;

    case 4:
      $modulo = $_POST['modulo'];
      $ref_multi = $_POST['ref_multi'];
      $sql = "SELECT * FROM batch_muestras_acondicionamiento WHERE modulo = :modulo AND batch = :batch AND referencia = :ref_multi";
      $query = $conn->prepare($sql);
      $result = $query->execute(['modulo' => $modulo, 'batch' => $batch, 'ref_multi' => $ref_multi,]);

      while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
        $arreglo["data"][] = $data;
      }

      if (empty($arreglo))
        echo '3';
      else
        echo json_encode($arreglo, JSON_UNESCAPED_UNICODE);

      break;

    case 5:
      $modulo = $_POST['modulo'];
      $ref_multi = $_POST['ref_multi'];
      $sql = "SELECT AVG(muestra) as promedio FROM batch_muestras WHERE modulo = :modulo AND batch = :batch";
      $query = $conn->prepare($sql);
      $result = $query->execute(['modulo' => $modulo, 'batch' => $batch,]);
      $data = $query->fetchAll(PDO::FETCH_ASSOC);
      echo json_encode($data, JSON_UNESCAPED_UNICODE);
      break;

    case 6:
      $sql = "SELECT * FROM batch_muestras WHERE batch = :batch";
      $query = $conn->prepare($sql);
      $result = $query->execute(['batch' => $batch,]);
      $data = $query->fetchAll(PDO::FETCH_ASSOC);
      echo json_encode($data, JSON_UNESCAPED_UNICODE);
      break;

    case 7:
      $sql = "SELECT * FROM batch_muestras_acondicionamiento WHERE batch = :batch";
      $query = $conn->prepare($sql);
      $result = $query->execute(['batch' => $batch,]);
      $data = $query->fetchAll(PDO::FETCH_ASSOC);
      echo json_encode($data, JSON_UNESCAPED_UNICODE);
      break;
  } 
  
}
*/