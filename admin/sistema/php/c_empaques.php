<?php
require_once('../../../conexion.php');
require_once('./crud.php');

$op = $_POST['operacion'];

switch ($op) {

    case 1: //listar tablas Generales
        $tabla = $_POST['tabla'];
        $query = "SELECT * FROM $tabla";
        ejecutarQuerySelect($conn, $query);
        break;

    case 2: //Eliminar
        $id = $_POST['id'];
        $tabla = $_POST['tabla'];

        $sql = "DELETE FROM $tabla WHERE id = :id";
        ejecutarEliminar($conn, $sql, $id);
        break;

    case 3: // Guardar o actualizar data
        if (!empty($_POST)) {
            $editar = $_POST['editar'];
            $tabla = $_POST['nombre'];
            $codigo =  $_POST['codigo'];
            $descripcion =  ucfirst(strtolower($_POST['descripcion']));

            if ($editar == 0) {
                $sql = "SELECT * FROM $tabla WHERE id = :codigo";
                $query = $conn->prepare($sql);
                $query->execute(['codigo' => $codigo]);
                $rows = $query->rowCount();

                if ($rows > 0) {
                    echo '2';
                    exit();
                } else {
                    $sql = "INSERT INTO $tabla (id, nombre) VALUES(:codigo, :descripcion)";
                    $query = $conn->prepare($sql);
                    $result = $query->execute(['codigo' => $codigo, 'descripcion' => $descripcion]);
                    ejecutarQuery($result, $conn);
                }
            } else {
                $id = $_POST['id'];
                $sql = "UPDATE $tabla SET id = :codigo, nombre = :descripcion WHERE id = :id";
                $query = $conn->prepare($sql);
                $result = $query->execute(['codigo' => $codigo, 'descripcion' => $descripcion, 'id' => $id]);

                if ($result) {
                    echo '3';
                    exit();
                }
            }
        }
        break;
}
