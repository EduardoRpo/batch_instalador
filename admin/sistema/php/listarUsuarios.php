<?php
require_once('../../../conexion.php');

$query_usuarios = mysqli_query($conn, "SELECT u.id, u.nombre, u.apellido, u.email, c.cargo, m.modulo FROM usuario u INNER JOIN cargo c INNER JOIN modulo m ON u.id_cargo = c.id AND u.id_modulo = m.id");
$result = mysqli_num_rows($query_usuarios);

mysqli_close($conn);

if ($result > 0) {
  while ($data = mysqli_fetch_assoc($query_usuarios)) {
    $arreglo["data"][] = $data;
  }
  echo json_encode($arreglo, JSON_UNESCAPED_UNICODE);
}
mysqli_free_result($query_usuarios);

