<?php
require_once('../../../conexion.php');
require_once('./crud.php');

$op = $_POST['operacion'];

switch ($op) {
  case 1: //listar parametros
    $query = "SELECT * FROM preguntas INNER JOIN modulo";
    ejecutarQuerySelect($conn, $query);

    break;

  case 2: //Cargar Select Proceso
    $query = "SELECT * FROM modulo";
    ejecutarQuerySelect($conn, $query);

    break;

  case 3: //Eliminar
    $id_pregunta = $_POST['id'];

    $query = "DELETE FROM preguntas WHERE id = $id_pregunta";
    ejecutarQuery($conn, $query);

  case 4: // Guardar y actualizar data
    $id = $_POST['id'];
    $pregunta = $_POST['pregunta'];
    $respuesta = $_POST['respuesta'];
    $modulo = $_POST['modulo'];

    if ($id == '') {
        $query = "SELECT * FROM preguntas WHERE nombre='$pregunta'";
        $result = existeRegistro($conn, $query);

        if ($result > 0) {
            exit();
        } else
            $query = "INSERT INTO preguntas (pregunta, resp) VALUES('$pregunta', '$respuesta')";
    } else
        $query = "UPDATE preguntas SET pregunta = '$pregunta', respuesta=$respuesta WHERE id = $id";

    ejecutarQuery($conn, $query);

    break;
}
