<?php
require_once('../../../conexion.php');

$query_productos = mysqli_query($conn, "SELECT p.referencia, p.nombre_referencia, p.unidad_empaque, np.nombre_producto as producto, ns.notificacion_sanitaria as notificacion, linea.nombre_linea as linea 
                                        FROM producto p INNER JOIN nombre_producto np INNER JOIN notificacion_sanitaria ns INNER JOIN linea 
                                        ON np.id = p.id_nombre_producto AND linea.id = p.id_linea AND ns.id = p.id_notificacion_sanitaria");

$result = mysqli_num_rows($query_productos);

if ($result > 0) {
  while ($data = mysqli_fetch_assoc($query_productos)) {
    $arreglo["data"][] = $data;
  }
  echo json_encode($arreglo, JSON_UNESCAPED_UNICODE);
}
mysqli_free_result($query_productos);
mysqli_close($conn);
