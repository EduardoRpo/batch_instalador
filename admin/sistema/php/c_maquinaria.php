<?php
require_once('../../../conexion.php');
require_once('./crud.php');

$op = $_POST['operacion'];

switch ($op) {
  case 1: //listar Equipos
    $query = "SELECT * FROM equipos";
    ejecutarQuerySelect($conn, $query);
    break;

  case 2: //Select Tipo
    $query =  "SELECT DISTINCT tipo FROM equipos";
    ejecutarQuerySelect($conn, $query);

    break;

  case 3: //Eliminar
    $id = $_POST['id'];
    $sql = "DELETE FROM equipos WHERE id = :id";
    ejecutarEliminar($conn, $sql, $id);
    break;

  case 4: // Guardar y actualizar data
    if (!empty($_POST)) {

      $id = $_POST['id'];
      $equipo = ucfirst(mb_strtolower($_POST['equipo'], "UTF-8"));
      $tipo = $_POST['tipo'];

      $sql = "SELECT * FROM equipos WHERE descripcion = :id";
      $query = $conn->prepare($sql);
      $query->execute(['id' => $id]);
      $rows = $query->rowCount();

      if ($rows > 0) {
        $id = $_POST['id'];
        $sql = "UPDATE equipos SET descripcion = :equipo, tipo = :tipo WHERE descripcion = :id";
        $query = $conn->prepare($sql);
        $result = $query->execute([
          'equipo' => $equipo,
          'tipo' => $tipo,
          'id' => $id
        ]);

        if ($result) {
          echo '3';
        }
        exit();

      } else {
        $sql = "INSERT INTO equipos (descripcion, tipo) VALUES (:equipo, :tipo)";
        $query = $conn->prepare($sql);
        $result = $query->execute(['equipo' => $equipo, 'tipo' => $tipo]);
        ejecutarQuery($result, $conn);
      }

      if ($result) {
        echo '1';
      }
    }
    break;
}
