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
        $sql = "DELETE FROM modulo WHERE id = :id";
        ejecutarEliminar($conn, $sql, $id);
        break;

    case 3: // Guardar datos o actualizar

        if (!empty($_POST)) {
            $editar = $_POST['editar'];
            $proceso = ucfirst(strtolower($_POST['proceso']));

            if ($editar == 0) {
                $sql = "SELECT * FROM modulo WHERE modulo= :proceso";
                $query = $conn->prepare($sql);
                $query->execute(['proceso' => $proceso]);
                $rows = $query->rowCount();

                if ($rows > 0) {
                    echo '2';
                    exit();
                } else {
                    $sql = "INSERT INTO modulo (modulo) VALUES(:proceso)";
                    $query = $conn->prepare($sql);
                    $result = $query->execute(['proceso' => $proceso]);
                    ejecutarQuery($result, $conn);
                }
            } else {
                $id = $_POST['id'];
                $sql = "UPDATE modulo SET modulo = '$proceso' WHERE id = :id";
                $query = $conn->prepare($sql);
                $result = $query->execute(['id' => $id]);

                if ($result) {
                    echo '3';
                    exit();
                }
            }
        }
        break;
}
