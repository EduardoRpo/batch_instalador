<?php
require_once('../../../conexion.php');
require_once('./crud.php');

$op = $_POST['operacion'];

switch ($op) {
    case 1: //listar Materia Prima
        $query = "SELECT * FROM materia_prima";
        ejecutarQuerySelect($conn, $query);
        break;

    case 2: //Eliminar
        $id = $_POST['id'];
        $sql = "DELETE FROM materia_prima WHERE referencia = :id";
        ejecutarEliminar($conn, $sql, $id);
        break;

    case 3: // Almacenar o actualizar data
        $referencia = $_POST['referencia'];
        $materia_prima = $_POST['materiaprima'];
        $alias = $_POST['alias'];

        if (isset($_POST['txtId'])) {
            $id = $_POST['txtId'];
            $query = "UPDATE materia_prima SET referencia = '$referencia', nombre='$materia_prima, alias='$alias ' WHERE referencia = $id";
        } else {
            $query = "SELECT * FROM materia_prima WHERE referencia='$referencia'";
            $result = existeRegistro($conn, $query);

            if ($result > 0) {
                echo '2';
                exit();
            } else
                $query = "INSERT INTO materia_prima (referencia, nombre, alias) VALUES('$referencia', '$materia_prima', '$alias')";
        }

        ejecutarQuery($conn, $query);

        break;
}
