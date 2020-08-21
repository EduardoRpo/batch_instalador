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

    case 2: // Guardar data
        $tabla = $_POST['tabla'];
        $datos = $_POST['datos'];

        //validar si existe el registro
        /* $query = "SELECT COUNT(id) from $tabla where nombre = $datos";
        $row = existeRegistro($conn, $query);
        
        if ($row > 0)
            exit(); */

        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $query = "UPDATE $tabla SET nombre = '$datos' WHERE id = $id";
        } else {
            $query = "INSERT INTO $tabla (nombre) VALUES ('$datos')";
        }

        ejecutarQuery($conn, $query);

        break;

    case 3: // obtener data para actualizar
        $id = $_POST['id'];
        $tabla = $_POST['tabla'];

        $query = "SELECT * FROM $tabla WHERE id = $id";
        ejecutarQuerySelect($conn, $query);

        break;

    case 4: //Eliminar
        $id = $_POST['id'];
        $tabla = $_POST['tabla'];

        $query = "DELETE FROM $tabla WHERE id = $id";
        ejecutarQuery($conn, $query);
        break;

        /*
    case 7: // Cargar Selector Modulos

        $query_mod = mysqli_query($conn, "SELECT * FROM modulo");

        $result = mysqli_num_rows($query_mod);

        if ($result > 0) {
            while ($data = mysqli_fetch_assoc($query_mod)) {
                $arreglo[] = $data;
            }

            echo json_encode($arreglo, JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode('');
        }
        mysqli_free_result($query_mod);
        mysqli_close($conn);

        break; */
}
