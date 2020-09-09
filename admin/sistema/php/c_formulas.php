<?php
require_once('../../../conexion.php');
require_once('./crud.php');

$op = $_POST['operacion'];

switch ($op) {
    case 1: //listar referencias Productos
        $query = "SELECT p.referencia FROM producto p";
        ejecutarQuerySelect($conn, $query);
        break;

    case 2: //Obtener nombre producto

        $referencia = $_POST['referencia'];

        $query = "SELECT p.referencia, p.nombre_referencia FROM producto p WHERE referencia = $referencia";
        ejecutarQuerySelect($conn, $query);
        break;

    case 3: //Listar Formula

        $referencia = $_POST['referencia'];
        //echo $referencia;
        $query = "SELECT f.id_producto, f.id_materiaprima as referencia, m.nombre, m.alias, f.porcentaje FROM formula f INNER JOIN materia_prima m ON f.id_materiaprima=m.referencia WHERE f.id_producto = '$referencia'";
        ejecutarQuerySelect($conn, $query);
        break;

    case 4: //Referencias Materias Primas

        $query = "SELECT referencia FROM materia_prima";
        ejecutarQuerySelect($conn, $query);
        break;

    case 5: //Obtener Materia Prima y Alias

        $referencia = $_POST['referencia'];

        $query = "SELECT mp.referencia, mp.nombre, mp.alias FROM materia_prima mp WHERE referencia = $referencia";
        ejecutarQuerySelect($conn, $query);
        break;

    case 6: // Guardar data
        $editar = $_POST['editar'];
        $id_producto = $_POST['ref_producto'];
        $id_materiaprima = $_POST['ref_materiaprima'];
        $porcentaje = $_POST['porcentaje'];

        if ($editar == 'true')
            $query = "UPDATE formula SET porcentaje='$porcentaje' WHERE id_materiaprima = '$id_materiaprima' AND id_producto = '$id_producto'";
        else
            $query = "INSERT INTO formula (id_producto, id_materiaprima, porcentaje) VALUES ($id_producto, $id_materiaprima, $porcentaje )";

        ejecutarQuery($conn, $query);

        break;

    case 7: //Eliminar
        $ref_materiaprima = $_POST['ref_materiaprima'];
        $ref_producto = $_POST['ref_producto'];

        $query = "DELETE FROM formula WHERE id_producto = $ref_producto AND id_materiaprima = $ref_materiaprima";
        ejecutarQuery($conn, $query);
        break;
        /*
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
