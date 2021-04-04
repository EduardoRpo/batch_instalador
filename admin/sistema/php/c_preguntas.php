<?php
header("Content-Type: text/html;charset=utf-8");
if (!empty($_POST)) {

  require_once('../../../conexion.php');
  require_once('./crud.php');

  $op = $_POST['operacion'];

  switch ($op) {
    case 1: //listar parametros
      $query = "SELECT * FROM preguntas";
      ejecutarQuerySelect($conn, $query);

      break;

    case 2: //Eliminar
      $id = $_POST['id'];

      $sql = "DELETE FROM preguntas WHERE id = :id";
      $query = $conn->prepare($sql);
      $query->execute(['id' => $id]);
      break;

    case 3: // Guardar y actualizar data

      $id = $_POST['id'];
      $pregunta = ucfirst(mb_strtolower($_POST['pregunta'], "UTF-8"));

      $sql = "SELECT * FROM preguntas WHERE id = :id";
      $query = $conn->prepare($sql);
      $query->execute(['id' => $id]);
      $rows = $query->rowCount();

      if ($rows > 0) {
        $sql = "UPDATE preguntas SET pregunta = :pregunta WHERE id = :id";
        $query = $conn->prepare($sql);
        $result = $query->execute(['pregunta' => $pregunta, 'id' => $id]);
        if ($result) echo '3';
      } else {
        $sql = "INSERT INTO preguntas (pregunta) VALUES(:pregunta)";
        $query = $conn->prepare($sql);
        $result = $query->execute(['pregunta' => $pregunta]);
        if ($result) echo '1';
      }
      break;
  }
}
