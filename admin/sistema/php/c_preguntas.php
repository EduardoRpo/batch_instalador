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
    $id = $_POST['id'];
    $pregunta = strtoupper($_POST['pregunta']);

    if ($id == '') {
        $query = "SELECT * FROM preguntas WHERE pregunta='$pregunta'";
        $result = existeRegistro($conn, $query);

        if ($result > 0) {
            echo '2';
        
        } else
            $query = "INSERT INTO preguntas (pregunta) VALUES('$pregunta')";
    } else
        $query = "UPDATE preguntas SET pregunta = '$pregunta' WHERE id = $id";

    ejecutarQuery($conn, $query);

    break;
}
