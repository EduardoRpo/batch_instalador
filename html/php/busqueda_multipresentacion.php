<?php
if (!empty($_POST)) {
  require_once('../../conexion.php');

  // Buscar mulipresentacion para cargar en observaciones

  $batch = $_POST['idBatch'];

  $sql = "SELECT m.id, m.id_batch, m.referencia, p.nombre_referencia, p.presentacion_comercial as presentacion, linea.densidad, m.cantidad, m.total 
            FROM multipresentacion m 
            INNER JOIN producto p ON m.referencia = p.referencia 
            INNER JOIN linea ON p.id_linea = linea.id
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
