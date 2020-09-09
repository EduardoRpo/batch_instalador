<?php
require_once('../../../conexion.php');
require_once('./crud.php');

$op = $_POST['operacion'];

switch ($op) {
  case 1: //listar Equipos
    $query = "SELECT m.id, m.maquina, l.nombre FROM maquinaria m INNER JOIN linea l ON l.id = m.linea ORDER BY m.id ASC";
    ejecutarQuerySelect($conn, $query);
    break;

  case 2: //Select lineas
    $query =  "SELECT id, nombre as linea FROM linea";
    ejecutarQuerySelect($conn, $query);

    break;

  case 3: //Eliminar
    $id = $_POST['id'];
    $query = "DELETE FROM maquinaria WHERE id = $id";
    ejecutarQuery($conn, $query);
    break;

  case 4: // Guardar y actualizar data
    $id = $_POST['id'];
    $equipo = strtoupper($_POST['equipo']);
    $linea = $_POST['linea'];

    if ($id == '') {
      $query = "SELECT * FROM maquinaria WHERE maquina='$equipo'";
      $result = existeRegistro($conn, $query);

      if ($result > 0) {
        exit();
      } else
        $query = "INSERT INTO maquinaria (maquina, linea) VALUES('$equipo', '$linea')";
    } else
      $query = "UPDATE maquinaria SET maquina = '$equipo', linea='$linea' WHERE id = $id";

    ejecutarQuery($conn, $query);
    break;
}
