<?php
require_once('../../../conexion.php');
require_once('./crud.php');

$op = $_POST['operacion'];

switch ($op) {
    case 1: //listar Condiciones del medio
        $query = "SELECT * FROM desinfectante";
        ejecutarQuerySelect($conn, $query);

        break;

    case 2: //Eliminar
        $id = $_POST['id'];

        $query = "DELETE FROM desinfectante WHERE id = $id";
        ejecutarQuery($conn, $query);

        break;

    case 3: // Guardar data


        break;
}