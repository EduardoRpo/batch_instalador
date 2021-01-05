<?php
require_once('../../../conexion.php');
require_once('./crud.php');

$op = $_POST['operacion'];

switch ($op) {
    case 1: //listar nombres de Productos
        $query = "SELECT * FROM nombre_producto";
        ejecutarQuerySelect($conn, $query);
        break;

    case 2: //Obtener nombre producto
        $referencia = $_POST['referencia'];

        $query = "SELECT * FROM instructivos_base WHERE producto = $referencia";
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
            $referencia = $_POST['referencia'];
            $actividad = ucfirst(mb_strtolower($_POST['actividad'], "UTF-8"));
            $tiempo = $_POST['tiempo'];

            if ($editar == 0) {
                $sql = "SELECT * FROM instructivos_base WHERE pasos = :pasos AND producto =:referencia";
                $query = $conn->prepare($sql);
                $query->execute(['pasos' => $actividad, 'referencia' => $referencia]);
                $rows = $query->rowCount();

                if ($rows > 0) {
                    echo '2';
                    exit();
                } else {
                    $sql = "INSERT INTO instructivos_base (pasos, tiempo, producto) VALUES (:pasos, :tiempo, :referencia )";
                    $query = $conn->prepare($sql);
                    $result = $query->execute([
                        'pasos' => $actividad, 
                        'tiempo' => $tiempo, 
                        'referencia' => $referencia]);
                    if ($result) {
                        echo '1';
                        exit();
                    }
                }
            } else {
                $id = $_POST['id'];
                $sql = "UPDATE instructivos_base SET pasos=:pasos, tiempo=:tiempo WHERE pasos = :id AND producto = :referencia";
                $query = $conn->prepare($sql);
                $result = $query->execute([
                    'referencia' => $referencia, 
                    'pasos' => $actividad, 
                    'id' => $id, 
                    'tiempo' => $tiempo]);

                if ($result) {
                    echo '3';
                    exit();
                }
            }
        }
        break;

    case 5: //Eliminar
        $id = $_POST['id'];
        $referencia = $_POST['referencia'];

        $sql = "DELETE FROM instructivos_base WHERE pasos = :id AND producto = :referencia ";
        $query = $conn->prepare($sql);
        $result = $query->execute([
            'id' => $id,
            'referencia' => $referencia
            ]);

        if ($result) {
            echo '1';
        } else {
            die('Error');
            print_r('Error: ' . mysqli_error($conn));
        }

        break;
}
