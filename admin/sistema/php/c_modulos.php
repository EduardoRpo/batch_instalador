<?php
require_once('../../../conexion.php');
require_once('./crud.php');

$op = $_POST['operacion'];

switch ($op) {
    case 1: //listar Modulos
        $query = "SELECT * FROM modulo";
        ejecutarQuerySelect($conn, $query);
        break;

    case 2: //Eliminar
        $id = $_POST['id'];
        $query = "DELETE FROM modulo WHERE id = $id";
        ejecutarQuery($conn, $query);
        break;

    case 3: // Guardar datos o actualizar
        $id = $_POST['id'];
        $proceso = $_POST['proceso'];
        
        if ($id == '') {
            $query = "SELECT * FROM modulo WHERE modulo='$proceso'";
            $result = existeRegistro($conn, $query);

            if ($result > 0) {
                exit();
            } else
                $query = "INSERT INTO modulo (modulo) VALUES('$proceso')";
        } else
            $query = "UPDATE modulo SET modulo = '$proceso' WHERE id = $id";

        ejecutarQuery($conn, $query);


        break;
}
