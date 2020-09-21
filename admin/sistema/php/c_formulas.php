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
        if (!empty($_POST)) {
            $editar = $_POST['editar'];
            $id_producto = $_POST['ref_producto'];
            $id_materiaprima = $_POST['ref_materiaprima'];
            $porcentaje = $_POST['porcentaje'];

            if ($editar == 0) {
                $sql = "SELECT * FROM formula WHERE id_materiaprima = :id_materiaprima AND id_producto = :id_producto";
                $query = $conn->prepare($sql);
                $query->execute(['id_materiaprima' => $id_materiaprima, 'id_producto' => $id_producto]);
                $rows = $query->rowCount();

                if ($rows > 0) {
                    echo '2';
                    exit();
                } else {
                    $sql = "INSERT INTO formula (id_producto, id_materiaprima, porcentaje) VALUES (:id_producto, :id_materiaprima, :porcentaje )";
                    $query = $conn->prepare($sql);
                    $result = $query->execute(['id_materiaprima' => $id_materiaprima, 'id_producto' => $id_producto, 'porcentaje' => $porcentaje]);
                    if ($result) {
                        echo '1';
                        exit();
                    }
                }
            } else {
                $id = $_POST['id'];
                $sql = "UPDATE formula SET porcentaje=:porcentaje WHERE id_materiaprima = :id_materiaprima AND id_producto = :id_producto";
                $query = $conn->prepare($sql);
                $result = $query->execute(['id_materiaprima' => $id_materiaprima, 'id_producto' => $id_producto, 'porcentaje' => $porcentaje]);

                if ($result) {
                    echo '3';
                    exit();
                }
            }
        }
        break;

    case 7: //Eliminar
        $ref_materiaprima = $_POST['ref_materiaprima'];
        $ref_producto = $_POST['ref_producto'];

        $id = $_POST['id'];
        $sql = "DELETE FROM formula WHERE id_producto = :ref_producto AND id_materiaprima = :ref_materiaprima";
        $query = $conn->prepare($sql);
        $result = $query->execute(['ref_producto' => $ref_producto, 'ref_materiaprima' => $ref_materiaprima]);

        if ($result) {
            echo '1';
        } else {
            die('Error');
            print_r('Error: ' . mysqli_error($conn));
        }

        break;
}
