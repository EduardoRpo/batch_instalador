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
        $tabla = $_POST['tabla'];
        $dato =  strtoupper($_POST['datos']);

        if (isset($_POST['id_registro'])) {
            $registro = $_POST['id_registro'];

            $query = "UPDATE $tabla SET nombre = '$dato' WHERE id = '$registro'";
        } else {
            $query = "INSERT INTO $tabla (nombre) VALUES('$dato')";
        }

        ejecutarQuery($conn, $query);
        break;

    case 4: // Guardar o actualizar data en parametros min y max
        $tabla = $_POST['tabla'];
        $min =  $_POST['min'];
        $max =  $_POST['max'];

        if (isset($_POST['id_registro'])) {
            $registro = $_POST['id_registro'];
            $query = "UPDATE $tabla SET limite_inferior = $min, limite_superior = $max WHERE id = '$registro'";
        } else {
            $query = "INSERT INTO $tabla (limite_inferior, limite_superior) VALUES('$min', '$max')";
        }

        ejecutarQuery($conn, $query);
        break;
}
