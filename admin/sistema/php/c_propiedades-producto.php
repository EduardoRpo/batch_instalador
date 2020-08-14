<?php
//require_once('../../../conexion.php');

$op = $_POST['operacion'];

switch ($op) {
    case 1: //listar Nombres de Productos
        $query = "SELECT id, nombre_producto as nombre FROM nombre_producto";
        listar($query);
        break;

    case 2: //marca
        $query = "SELECT * FROM marca";
        listar($query);
        break;
        
    case 3: //marca
        $query = "SELECT id, color as nombre FROM color";
        listar($query);
        break;

    case 4: //olor
        $query = "SELECT id, olor as nombre FROM olor";
        listar($query);
        break;
    case 5: //densidad
        $query = "SELECT id, limite_inferior as min, limite_superior as max FROM densidad_gravedad";
        listar($query);
        break;
    case 6: //grado de alcohol
        $query = "SELECT id, limite_inferior as min, limite_superior as max FROM grado_alcohol";
        listar($query);
        break;

    case 7: //PH
        $query = "SELECT id, limite_inferior as min, limite_superior as max FROM ph";
        listar($query);
        break;

    case 8: //Viscosidad
        $query = "SELECT id, limite_inferior as min, limite_superior as max FROM viscosidad";
        listar($query);
        break;

        /* case 2: //Eliminar
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

        break; */
}


function listar($query)
{
    require_once('../../../conexion.php');

    $query = mysqli_query($conn, $query);
    $result = mysqli_num_rows($query);

    mysqli_close($conn);

    if ($result > 0) {
        while ($data = mysqli_fetch_assoc($query)) {
            $arreglo["data"][] = $data;
        }
        echo json_encode($arreglo, JSON_UNESCAPED_UNICODE);
    } else {
        echo false;
    }
    mysqli_free_result($query);
}
