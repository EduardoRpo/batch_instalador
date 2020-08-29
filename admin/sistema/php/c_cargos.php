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
        $id = $_POST['id'];
        $query = "DELETE FROM cargo WHERE id = $id";
        ejecutarQuery($conn, $query);
        break;

    case 3: // Actualizar y Guardar data
        $cargo = $_POST['cargo'];
        $id_cargo = $_POST['id'];

        if ($id_cargo == '') {
            $query = "SELECT * FROM cargo WHERE cargo='$cargo'";
            $result = existeRegistro($conn, $query);

            if ($result > 0) {
                exit();
            } else
                $query = "INSERT INTO cargo (cargo, posicion) VALUES('$cargo', '0')";
        } else
            $query = "UPDATE cargo SET cargo = '$cargo' WHERE id = $id_cargo";

        ejecutarQuery($conn, $query);

        break;
}
