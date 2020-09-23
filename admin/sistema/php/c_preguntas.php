<?php
require_once('../../../conexion.php');
require_once('./crud.php');

$op = $_POST['operacion'];

switch ($op) {
  case 1: //listar parametros
    $query = "SELECT * FROM preguntas";
    ejecutarQuerySelect($conn, $query);

    break;

  case 2: //Eliminar
    $id_pregunta = $_POST['id'];
    $sql = "DELETE FROM preguntas WHERE id = :id";
    ejecutarEliminar($conn, $sql, $id);

  case 3: // Guardar y actualizar data
    if (!empty($_POST)) {
      $editar = $_POST['editar'];
      $pregunta = strtoupper($_POST['pregunta']);

      if ($editar == 0) {
        $sql = "SELECT * FROM preguntas WHERE pregunta=:pregunta";
        $query = $conn->prepare($sql);
        $query->execute(['pregunta' => $pregunta]);
        $rows = $query->rowCount();

        if ($rows > 0) {
          echo '2';
          exit();
        } else {
          $sql = "INSERT INTO preguntas (pregunta) VALUES(:pregunta)";
          $query = $conn->prepare($sql);
          $result = $query->execute(['pregunta' => $pregunta]);
          ejecutarQuery($result, $conn);
        }
      } else {
        $id = $_POST['id'];
        $sql = "UPDATE preguntas SET pregunta = :pregunta WHERE id = :id";
        $query = $conn->prepare($sql);
        $result = $query->execute(['pregunta' => $pregunta, 'id' => $id]);

        if ($result) {
          echo '3';
          exit();
        }
      }
    }
    break;
}
