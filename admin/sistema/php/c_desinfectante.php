<?php
require_once('../../../conexion.php');

$op = $_POST['operacion'];

switch ($op) {
    case 1: //listar Condiciones del medio
        $query_desinfectantes = mysqli_query($conn, "SELECT * FROM desinfectante");

        $result = mysqli_num_rows($query_desinfectantes);

        mysqli_close($conn);

        if ($result > 0) {
            while ($data = mysqli_fetch_assoc($query_desinfectantes)) {
                $arreglo["data"][] = $data;
            }
            echo json_encode($arreglo, JSON_UNESCAPED_UNICODE);
        } else {
            echo false;
        }
        mysqli_free_result($query_desinfectantes);

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

    case 3: // obtener data
        $id_pregunta = $_POST['id'];

        $query = mysqli_query($conn, "SELECT * FROM preguntas WHERE id = $id_pregunta");
        $data = mysqli_fetch_assoc($query);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        mysqli_close($conn);

        break;

    case 6: // Guardar data
        $id_pregunta = $_POST['id'];

        $query = mysqli_query($conn, "SELECT * FROM preguntas WHERE id = $id_pregunta");
        $data = mysqli_fetch_assoc($query);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        mysqli_close($conn);

        break;
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

        break;
}