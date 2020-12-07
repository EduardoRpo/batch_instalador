<?php
  if (!empty($_POST)) {
  require_once('../../conexion.php');

// Buscar mulipresentacion para cargar en observaciones

    $id_batch = $_POST['id'];

    $sql = "SELECT m.id, m.id_batch, m.referencia, p.nombre_referencia, pc.nombre as presentacion, m.cantidad, m.total 
            FROM multipresentacion m INNER JOIN producto p INNER JOIN presentacion_comercial pc 
            ON m.referencia = p.referencia AND p.id_presentacion_comercial = pc.id 
            WHERE m.id_batch = :id_batch";
    $query = $conn->prepare($sql);
    $result = $query->execute([
        'id_batch' => $id_batch,
    ]);
    while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
      $arreglo[] = $data;
      
  }
  if (empty($arreglo)) {
      echo '0';
      exit();
  }

  echo json_encode($arreglo, JSON_UNESCAPED_UNICODE);


    
  }