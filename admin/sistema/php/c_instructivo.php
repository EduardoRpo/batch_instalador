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

    case 3: //Listar Instructivo
        $referencia = $_POST['referencia'];
        $query = "SELECT ip.id, ip.proceso, ip.tiempo FROM instructivo_preparacion ip WHERE ip.id_producto = $referencia";
        ejecutarQuerySelect($conn, $query);
        break;

    case 4: // Guardar data
        if (!empty($_POST)) {
            $editar = $_POST['editar'];
            $actividad = $_POST['actividad'];
            $tiempo = $_POST['tiempo'];

            if ($editar == 0) {
                $sql = "SELECT * FROM instructivo_preparacion WHERE proceso = :proceso";
                $query = $conn->prepare($sql);
                $query->execute(['proceso' => $actividad]);
                $rows = $query->rowCount();

                if ($rows > 0) {
                    echo '2';
                    exit();
                } else {
                    $sql = "INSERT INTO instructivo_preparacion (proceso, tiempo) VALUES (:proceso, :tiempo )";
                    $query = $conn->prepare($sql);
                    $result = $query->execute(['proceso' => $actividad, 'tiempo' => $tiempo]);
                    if ($result) {
                        echo '1';
                        exit();
                    }
                }
            } else {
                $id = $_POST['id'];
                $sql = "UPDATE instructivo_preparacion SET proceso=:proceso, tiempo=:tiempo WHERE id = :id";
                $query = $conn->prepare($sql);
                $result = $query->execute(['id' => $id, 'proceso' => $proceso, 'tiempo' => $tiempo]);

                if ($result) {
                    echo '3';
                    exit();
                }
            }
        }
        break;

    case 5: //Eliminar
        $id = $_POST['id'];

        $sql = "DELETE FROM instructivo_preparacion WHERE id = :id";
        $query = $conn->prepare($sql);
        $result = $query->execute(['id' => $id]);

        if ($result) {
            echo '1';
        } else {
            die('Error');
            print_r('Error: ' . mysqli_error($conn));
        }

        break;
}
