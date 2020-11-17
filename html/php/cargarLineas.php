<?php

if (!empty($_POST)) {
  require_once('../../conexion.php');
  require_once('../../admin/sistema/php/crud.php');

  $op = $_POST['operacion'];
  
  switch ($op) {
    case 1: //listar lineas para el proceso de preparacion
      $query = "SELECT id, nombre as linea FROM linea";
      ejecutarQuerySelect($conn, $query);
      break;

    case 2: //Seleccionar linea al cargar el batch con informacion
      $batch = $_POST['idBatch'];
      $modulo = $_POST['modulo'];

      $sql = "SELECT linea FROM batch_tanques_chks  
                    WHERE modulo = :modulo AND batch = :batch";
      $query = $conn->prepare($sql);
      $result = $query->execute([
        'modulo' => $modulo,
        'batch' => $batch,
      ]);
      if ($result > 0) {
        $data = $query->fetch(PDO::FETCH_ASSOC);
        $arreglo[] = $data;
        echo json_encode($arreglo, JSON_UNESCAPED_UNICODE);
      }
  }
}
