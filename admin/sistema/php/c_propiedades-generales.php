<?php
require_once('../../../conexion.php');
require_once('./crud.php');

$op = $_POST['operacion'];

switch ($op) {

    case 1: //listar tablas Generales
        $tabla = $_POST['tabla'];

        if ($tabla == 'densidad_gravedad' || $tabla == 'grado_alcohol' || $tabla == 'ph' || $tabla == 'viscosidad')
            $query = "SELECT id, CONCAT(limite_inferior, ' - ' ,limite_superior) AS nombre FROM $tabla";
        else
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
            $tabla = $_POST['tabla'];
            $dato =  strtoupper($_POST['datos']);

            if ($editar == 0) {
                $sql = "SELECT * FROM $tabla WHERE nombre= :dato";
                $query = $conn->prepare($sql);
                $query->execute(['dato' => $dato]);
                $rows = $query->rowCount();

                if ($rows > 0) {
                    echo '2';
                    exit();
                } else {
                    $sql = "INSERT INTO $tabla (nombre) VALUES(:dato)";
                    $query = $conn->prepare($sql);
                    $result = $query->execute(['dato' => $dato]);
                    ejecutarQuery($result, $conn);
                }
            } else {
                $id_registro = $_POST['id_registro'];
                $sql = "UPDATE $tabla SET nombre = :dato WHERE id = :registro";
                $query = $conn->prepare($sql);
                $result = $query->execute(['dato' => $dato, 'registro' => $id_registro]);

                if ($result) {
                    echo '3';
                    exit();
                }
            }
        }

        break;

    case 4: // Guardar o actualizar data en parametros min y max
        if (!empty($_POST)) {

            $editar = $_POST['editar'];
            $tabla = $_POST['tabla'];
            $limite_min =  $_POST['min'];
            $limite_max =  $_POST['max'];

            if ($editar == 0) {
                $sql = "SELECT * FROM $tabla WHERE limite_inferior =:t_min AND limite_superior =:tmax";
                $query = $conn->prepare($sql);
                $query->execute(['t_min' => $limite_min, 'tmax' => $limite_max]);
                $rows = $query->rowCount();

                if ($rows > 0) {
                    echo '2';
                    exit();
                } else {
                    $sql = "INSERT INTO $tabla (limite_inferior, limite_superior) VALUES(:limite_min, :limite_max)";
                    $query = $conn->prepare($sql);
                    $result = $query->execute(['limite_min' => $limite_min, 'limite_max' => $limite_max]);
                    ejecutarQuery($result, $conn);
                }
            } else {
                $registro = $_POST['id_registro'];
                $sql = "UPDATE $tabla SET limite_inferior = :limite_min, limite_superior = :limite_max WHERE id = :registro";
                $query = $conn->prepare($sql);
                $result = $query->execute(['limite_min' => $limite_min, 'limite_max' => $limite_max, 'registro' => $registro]);

                if ($result) {
                    echo '3';
                    exit();
                }
            }
        }
        break;
}
