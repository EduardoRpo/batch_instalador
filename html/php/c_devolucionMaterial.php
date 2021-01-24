<?php
if (!empty($_POST)) {
  require_once('../../conexion.php');

  $material = $_POST['materialsobrante'];
  $ref_producto = $_POST['ref_multi'];
  $idBatch = $_POST['idBatch'];
  $modulo = $_POST['modulo'];
  $id_firma = $_POST['info'];
  
  foreach ($material as $valor) {
    $sql = "INSERT INTO batch_material_sobrante (ref_material, envasada, averias, sobrante, ref_producto, batch, modulo, realizo) 
            VALUES(:referencia, :envasada, :averias, :sobrante, :producto, :batch, :modulo, :realizo)";
    $query = $conn->prepare($sql);
    $result = $query->execute([
      'referencia' => $valor['referencia'],
      'envasada' => $valor['envasada'],
      'averias' => $valor['averias'],
      'sobrante' => $valor['sobrante'],
      'producto' => $ref_producto,
      'batch' => $idBatch,
      'modulo' => $modulo,
      'realizo' => $id_firma,
    ]);
  }
  if ($result)
    echo '1';
  else
    echo '0';
}
