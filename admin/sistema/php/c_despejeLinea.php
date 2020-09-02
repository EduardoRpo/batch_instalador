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
    $id_pregunta = $_POST['id'];

    $query = "DELETE FROM preguntas WHERE id = $id_pregunta";
    ejecutarQuery($conn, $query);

  case 5: // Guardar y actualizar data
    $pregunta = $_POST['pregunta'];
    $respuesta = $_POST['respuesta'];
    $modulo = $_POST['modulo'];

    $query = "SELECT * FROM modulo_pregunta WHERE id_pregunta='$pregunta'";
    $result = existeRegistro($conn, $query);

    if ($result > 0)
      $query = "UPDATE modulo_pregunta SET resp = '$respuesta', id_modulo = $modulo WHERE id_pregunta = $pregunta";
    else
      $query = "INSERT INTO moudlo_pregunta (id_pregunta, resp, id_modulo) VALUES('$pregunta', '$respuesta', '$modulo')";

    ejecutarQuery($conn, $query);

    break;
}
