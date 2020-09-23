<?php
require_once('../../../conexion.php');
require_once('./crud.php');

$op = $_POST['operacion'];

switch ($op) {
    case 1: //listar Condiciones del medio
        $query = "SELECT * FROM tanques ORDER BY id";
        ejecutarQuerySelect($conn, $query);
        break;

    case 2: //Eliminar
        $id = $_POST['id'];
        $sql = "DELETE FROM tanques WHERE id = :id";
        ejecutarEliminar($conn, $sql, $id);
        break;

    case 3: // Guardar y Actualizar
        if (!empty($_POST)) {
            $editar = $_POST['editar'];
            $capacidad = $_POST['capacidad'];

            if ($editar == 0) {
                $sql = "SELECT * FROM tanques WHERE capacidad=:capacidad";
                $query = $conn->prepare($sql);
                $query->execute(['capacidad' => $capacidad]);
                $rows = $query->rowCount();

                if ($rows > 0) {
                    echo '2';
                    exit();
                } else {
                    $sql = "INSERT INTO tanques (capacidad) VALUES(:capacidad)";
                    $query = $conn->prepare($sql);
                    $result = $query->execute(['capacidad' => $capacidad]);
                    ejecutarQuery($result, $conn);
                }
            } else {
                $id = $_POST['id'];
                $sql = "UPDATE tanques SET capacidad = :capacidad WHERE id = :id";
                $query = $conn->prepare($sql);
                $result = $query->execute(['capacidad' => $capacidad, 'id' => $id]);

                if ($result) {
                    echo '3';
                    exit();
                }
            }
        }




        break;
}
