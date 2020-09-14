<?php
require_once('../../../conexion.php');
require_once('./crud.php');

$op = $_POST['operacion'];

switch ($op) {
  case 1: //listar parametros
    $query = "SELECT mp.id, p.pregunta, mp.resp, m.modulo FROM modulo_pregunta mp INNER JOIN preguntas p INNER JOIN modulo m ON mp.id_pregunta=p.id AND mp.id_modulo=m.id";
    ejecutarQuerySelect($conn, $query);

    break;

  case 2: //Cargar Select Proceso
    $query = "SELECT * FROM modulo";
    ejecutarQuerySelect($conn, $query);

    break;

  case 3: //Cargar Select preguntas
    $query = "SELECT * FROM preguntas";
    ejecutarQuerySelect($conn, $query);

    break;

  case 4: //Eliminar
    $id = $_POST['id'];
    $sql = "DELETE FROM preguntas WHERE id = :id";
    ejecutarEliminar($conn, $sql, $id);

  case 5: // Guardar y actualizar data
    if (!empty($_POST)) {
      $editar = $_POST['editar'];

      $id_pregunta = $_POST['pregunta'];
      $respuesta = $_POST['respuesta'];
      $modulo = $_POST['modulo'];

      if ($editar == 0) {
        $sql = "SELECT * FROM modulo_pregunta WHERE id_pregunta=:id_pregunta AND resp=:respuesta AND id_modulo=:modulo";
        $query = $conn->prepare($sql);
        $query->execute(['id_pregunta' => $id_pregunta, 'respuesta' => $respuesta, 'modulo' => $modulo]);
        $rows = $query->rowCount();

        if ($rows > 0) {
          echo '2';
          exit();
        } else {
          $sql = "INSERT INTO modulo_pregunta (id_pregunta, resp, id_modulo) VALUES(:pregunta, :respuesta, :modulo)";
          $query = $conn->prepare($sql);
          $result = $query->execute(['pregunta' => $id_pregunta, 'respuesta' => $respuesta, 'modulo' => $modulo]);
          ejecutarQuery($result, $conn);
        }
      } else {
        $sql = "UPDATE modulo_pregunta SET resp = :respuesta, id_modulo = :modulo WHERE id_pregunta = :id_pregunta";
        $query = $conn->prepare($sql);
        $result = $query->execute(['id_pregunta' => $id_pregunta, 'respuesta' => $respuesta, 'modulo' => $modulo]);

        if ($result) {
          echo '3';
          exit();
        }
      }
    }
    break;
}
