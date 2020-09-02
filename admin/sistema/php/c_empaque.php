<?php
require_once('../../../conexion.php');
require_once('./crud.php');

$op = $_POST['operacion'];

switch ($op) {
    case 1: //listar Tapas
        $tabla = $_POST['tabla'];

        $query = "SELECT codigo as id, descripcion as nombre FROM $tabla";
        ejecutarQuerySelect($conn, $query);
        break;

    
    case 2: //Eliminar
        $id_pregunta = $_POST['id'];

        $query_pregunta = "DELETE FROM preguntas WHERE id = $id_pregunta";
        $result = mysqli_query($conn, $query_pregunta);

        if ($result) {
            echo 'Eliminado';
        } else {
            echo 'No Eliminado';
        }
        //mysqli_free_result($query_pregunta);
        mysqli_close($conn);
        break;


    case 7: // Guardar data
        $id_pregunta = $_POST['id'];

        $query = mysqli_query($conn, "SELECT * FROM preguntas WHERE id = $id_pregunta");
        $data = mysqli_fetch_assoc($query);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        mysqli_close($conn);

        break;
}
