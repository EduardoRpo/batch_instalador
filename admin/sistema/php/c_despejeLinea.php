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

  case 4: // obtener data
    $id_pregunta = $_POST['id'];

    $query = mysqli_query($conn, "SELECT * FROM preguntas WHERE id = $id_pregunta");
    $data = mysqli_fetch_assoc($query);
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    mysqli_close($conn);

    break;
}
