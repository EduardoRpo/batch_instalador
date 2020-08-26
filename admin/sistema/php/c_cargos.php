<?php
require_once('../../../conexion.php');
require_once('./crud.php');

$op = $_POST['operacion'];

switch ($op) {
    case 1: //listar Condiciones del medio
        $query = "SELECT * FROM cargo";
        ejecutarQuerySelect($conn, $query);

        break;

    case 2: //Eliminar
        $id_pregunta = $_POST['id'];
        $query = "DELETE FROM preguntas WHERE id = $id_pregunta";
        ejecutarQuery($conn, $query);

    case 6: // Actualizar y Guardar data
        
        break;
}
