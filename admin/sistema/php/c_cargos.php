<?php

if (!empty($_POST)) {

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
            $sql = "DELETE FROM cargo WHERE id = :id";
            ejecutarEliminar($conn, $sql, $id);
            break;

        case 3: // Actualizar y Guardar data

            $editar = $_POST['editar'];
            $cargo = strtoupper($_POST['cargo']);

            if ($editar == 0) {
                $sql = "SELECT * FROM cargo WHERE cargo= :cargo";
                $query = $conn->prepare($sql);
                $query->execute(['cargo' => $cargo]);
                $rows = $query->rowCount();

                if ($rows > 0) {
                    echo '2';
                    exit();
                } else {
                    $sql = "INSERT INTO cargo (cargo) VALUES(:cargo)";
                    $query = $conn->prepare($sql);
                    $result = $query->execute(['cargo' => $cargo]);
                    ejecutarQuery($result, $conn);
                }
            } else {
                $id = $_POST['id'];
                $sql = "UPDATE cargo SET cargo = :cargo WHERE id = :id";
                $query = $conn->prepare($sql);
                $result = $query->execute(['cargo' => $cargo, 'id' => $id]);

                if ($result) {
                    echo '3';
                    exit();
                }
            }
            break;
    }
}
