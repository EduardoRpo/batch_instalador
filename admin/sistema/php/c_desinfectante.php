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
        $sql = "DELETE FROM desinfectante WHERE id = :id";
        ejecutarEliminar($conn, $sql, $id);

        break;

    case 3: // Guardar o actualizar data
        if (!empty($_POST)) {
            $editar = $_POST['editar'];

            $id = $_POST['id'];
            $desinfectante = ucfirst(strtolower($_POST['desinfectante']));
            $concentracion = $_POST['concentracion'];

            if ($editar == 0) {
                $sql = "SELECT * FROM desinfectante WHERE nombre=:desinfectante";
                $query = $conn->prepare($sql);
                $query->execute(['desinfectante' => $desinfectante]);
                $rows = $query->rowCount();

                if ($rows > 0) {
                    echo '2';
                    exit();
                } else {
                    $sql = "INSERT INTO desinfectante (nombre, concentracion) VALUES(:desinfectante, :concentracion)";
                    $query = $conn->prepare($sql);
                    $result = $query->execute(['desinfectante' => $desinfectante, 'concentracion' => $concentracion]);
                    ejecutarQuery($result, $conn);
                }
            } else {
                $id = $_POST['id'];
                $sql = "UPDATE desinfectante SET nombre = :desinfectante, concentracion=:concentracion WHERE id = :id";
                $query = $conn->prepare($sql);
                $result = $query->execute(['desinfectante' => $desinfectante, 'concentracion' => $concentracion, 'id' => $id]);

                if ($result) {
                    echo '3';
                    exit();
                }
            }
        }
        break;
}
