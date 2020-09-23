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
    $sql = "DELETE FROM maquinaria WHERE id = :id";
    ejecutarEliminar($conn, $sql, $id);
    break;

  case 4: // Guardar y actualizar data
    if (!empty($_POST)) {
      $editar = $_POST['editar'];
      $id = $_POST['id'];
      $equipo = strtoupper($_POST['equipo']);
      $linea = $_POST['linea'];

      if ($editar == 0) {
        $sql = "SELECT * FROM maquinaria WHERE maquina=:equipo";
        $query = $conn->prepare($sql);
        $query->execute(['equipo' => $equipo]);
        $rows = $query->rowCount();

        if ($rows > 0) {
          echo '2';
          exit();
        } else {
          $sql = "INSERT INTO maquinaria (maquina, linea) VALUES(:equipo, :linea)";
          $query = $conn->prepare($sql);
          $result = $query->execute(['equipo' => $equipo, 'linea' => $linea]);
          ejecutarQuery($result, $conn);
        }
      } else {
        $id = $_POST['id'];
        $sql = "UPDATE maquinaria SET maquina = :equipo, linea=:linea WHERE id = :id";
        $query = $conn->prepare($sql);
        $result = $query->execute(['equipo' => $equipo, 'linea' => $linea, 'id' => $id]);

        if ($result) {
          echo '3';
          exit();
        }
      }
    }
    break;
}
