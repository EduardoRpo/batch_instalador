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

      $sql = "DELETE FROM preguntas WHERE pregunta = :id";
      ejecutarEliminar($conn, $sql, $id);
      break;

    case 3: // Guardar y actualizar data
      $editar = $_POST['editar'];
      $pregunta = ucfirst(mb_strtolower($_POST['pregunta'], "UTF-8"));

      if ($editar == 0) {
        $sql = "SELECT * FROM preguntas WHERE pregunta = :pregunta";
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
        $sql = "UPDATE preguntas SET pregunta = :pregunta WHERE pregunta = :id";
        $query = $conn->prepare($sql);
        $result = $query->execute([
          'pregunta' => $pregunta,
          'id' => $id
        ]);

        if ($result) {
          echo '3';
          exit();
        }
      }

      break;
  }
}
