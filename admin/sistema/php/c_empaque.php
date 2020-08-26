<?php
require_once('../../../conexion.php');
require_once('./crud.php');

$op = $_POST['operacion'];

switch ($op) {
    case 1: //listar Tapas
        $query = "SELECT codigo as id, tapa as nombre FROM tapa";
        ejecutarQuerySelect($conn, $query);
        break;

    case 2: //Listar Envase
        $query = "SELECT codigo as id, envase as nombre FROM envase";
        ejecutarQuerySelect($conn, $query);
        break;

    case 3: //Listar Etiquetas
        $query = "SELECT codigo as id, etiqueta as nombre FROM etiqueta";
        ejecutarQuerySelect($conn, $query);
        break;

    case 4: //Otros Caja
        $query = "SELECT referencia as id, descripcion as nombre FROM otros";
        ejecutarQuerySelect($conn, $query);
        break;
    case 5: //Otros
        $query = "SELECT codigo as id, otro as nombre FROM otro_empaque";
        ejecutarQuerySelect($conn, $query);
        break;

    case 6: //Eliminar
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
