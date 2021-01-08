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
        $query = "SELECT p.referencia, p.nombre_referencia, p.base_instructivo 
                  FROM producto p 
                  WHERE p.referencia = $referencia";
        ejecutarQuerySelect($conn, $query);
        break;

    case 3: //Listar Instructivo
        $referencia = $_POST['referencia'];

        $sql = "SELECT * FROM producto WHERE referencia =:referencia";
        $query = $conn->prepare($sql);
        $query->execute([
            'referencia' => $referencia
        ]);

        $data = $query->fetch(PDO::FETCH_ASSOC);
        $tabla = $data["base_instructivo"];
        $producto = $data["instructivo"];

        if ($tabla == 0) {
            $query = "SELECT ip.id, ip.pasos, ip.tiempo FROM instructivo_preparacion ip WHERE ip.id_producto = $referencia";
            ejecutarQuerySelect($conn, $query);
        } else {

            $sql = "SELECT id, pasos, tiempo FROM instructivos_base WHERE producto = :producto";
            $query = $conn->prepare($sql);
            $result = $query->execute([
                'producto' => $producto
            ]);

            if ($result) {
                while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
                    $arreglo["data"][] = $data;
                }

                if (empty($arreglo)) {
                    echo '3';
                    exit();
                }
            } else {
                echo '2';
            }

            echo json_encode($arreglo, JSON_UNESCAPED_UNICODE);
        }

        break;

    case 4: // Guardar data
        if (!empty($_POST)) {
            $editar = $_POST['editar'];
            $referencia = $_POST['referencia'];
            $actividad = ucfirst(mb_strtolower($_POST['actividad'], "UTF-8"));
            $tiempo = $_POST['tiempo'];

            if ($editar == 0) {
                $sql = "SELECT * FROM instructivo_preparacion WHERE pasos = :proceso AND id_producto =:referencia";
                $query = $conn->prepare($sql);
                $query->execute(['proceso' => $actividad, 'referencia' => $referencia]);
                $rows = $query->rowCount();

                if ($rows > 0) {
                    echo '2';
                    exit();
                } else {
                    $sql = "INSERT INTO instructivo_preparacion (pasos, tiempo, id_producto) VALUES (:proceso, :tiempo, :referencia )";
                    $query = $conn->prepare($sql);
                    $result = $query->execute(['proceso' => $actividad, 'tiempo' => $tiempo, 'referencia' => $referencia]);
                    if ($result) {
                        echo '1';
                        exit();
                    }
                }
            } else {
                $id = $_POST['id'];
                $sql = "UPDATE instructivo_preparacion 
                        SET pasos = :instruccion, tiempo = :tiempo 
                        WHERE pasos = :id AND id_producto = CAST(:referencia AS INT)";
                $query = $conn->prepare($sql);
                $result = $query->execute([
                    'id' => $id,
                    'instruccion' => $actividad,
                    'tiempo' => $tiempo,
                    'referencia' => intval($referencia),
                ]);

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
        
        $sql = "DELETE FROM instructivo_preparacion 
                WHERE pasos = :id AND id_producto = CAST(:referencia AS INT)";
        $query = $conn->prepare($sql);
        $result = $query->execute([
            'id' => $id,
            'referencia' => $referencia,
            ]);

        if ($result) {
            echo '1';
        } else {
            die('Error');
            print_r('Error: ' . mysqli_error($conn));
        }

        break;
}
