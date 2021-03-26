<?php
if (!empty($_POST)) {
  require_once('../../conexion.php');

  // Buscar mulipresentacion para cargar en observaciones

  $batch = $_POST['idBatch'];

  $sql = "SELECT m.id, m.id_batch, m.referencia, p.nombre_referencia, pc.nombre as presentacion, p.unidad_empaque, linea.densidad, m.cantidad, m.total 
            FROM producto p 
            INNER JOIN multipresentacion m ON m.referencia = p.referencia 
            INNER JOIN presentacion_comercial pc ON pc.id = p.presentacion_comercial 
            INNER JOIN linea ON linea.id = p.id_linea
            WHERE m.id_batch = :id_batch ORDER BY presentacion";

  $query = $conn->prepare($sql);
  $result = $query->execute([
    'id_batch' => $batch,
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
