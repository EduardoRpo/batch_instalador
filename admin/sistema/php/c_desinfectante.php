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

    case 3: // Guardar o actualizar data
        $id = $_POST['id'];
        $desinfectante = strtoupper($_POST['desinfectante']);
        $concentracion = $_POST['concentracion'];

        if ($id == '') {
            $query = "SELECT * FROM desinfectante WHERE nombre='$desinfectante'";
            $result = existeRegistro($conn, $query);

            if ($result > 0) {
                exit();
            } else
                $query = "INSERT INTO desinfectante (nombre, concentracion) VALUES('$desinfectante', '$concentracion')";
        } else
            $query = "UPDATE desinfectante SET nombre = '$desinfectante', concentracion=$concentracion WHERE id = $id";

        ejecutarQuery($conn, $query);

        break;
}
