<?php

if (!empty($_POST)) {

    require_once('../../conexion.php');
    require_once('../../admin/sistema/php/crud.php');

    $op = $_POST['operacion'];

    $modulo = $_POST['modulo'];
    $batch = $_POST['idBatch'];

    switch ($op) {
        case 1: //firma realizo 2da seccion 

            /* $linea = $_POST['linea']; */
            $firma = $_POST['id_firma'];
            $ref_multi = $_POST['ref_multi'];

            $sql = "INSERT INTO batch_firmas2seccion (modulo, batch, ref_multi, realizo) 
            VALUES (:modulo, :batch, :ref_multi, :realizo)";
            $query = $conn->prepare($sql);
            $result = $query->execute([
                /* 'observaciones' => $linea, */
                'modulo' => $modulo,
                'batch' => $batch,
                'ref_multi' => $ref_multi,
                'realizo' => $firma,
            ]);

            if ($result) {
                echo '1';
            } else
                echo '0';
            break;

        case 2: // firma calidad 2da seccion 

            $firma = $_POST['id_firma'];
            $ref_multi = $_POST['ref_multi'];

            $sql = "UPDATE batch_firmas2seccion SET verifico = :verifico WHERE modulo = :modulo AND batch = :batch AND ref_multi = :ref_multi";
            $query = $conn->prepare($sql);
            $result = $query->execute([
                'verifico' => $firma,
                'modulo' => $modulo,
                'batch' => $batch,
                'ref_multi' => $ref_multi,
            ]);
            break;

        case 3: //Obtener los datos y firmas de la tabla firma2 

            $ref_multi = $_POST['ref_multi'];

            $sql = "SELECT bf2.observaciones as linea, bf2.modulo, bf2.batch, u.urlfirma as realizo, u.urlfirma as verifico 
                    FROM batch_firmas2seccion bf2 
                    INNER JOIN usuario u ON u.id = bf2.realizo
                    INNER JOIN usuario us ON us.id = bf2.verifico
                    WHERE modulo = :modulo AND batch = :batch AND ref_multi = :ref_multi";
            $query = $conn->prepare($sql);
            $result = $query->execute([
                'modulo' => $modulo,
                'batch' => $batch,
                'ref_multi' => $ref_multi,
            ]);

            while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
                $arreglo["data"][] = $data;
            }
            if (empty($arreglo)) {
                $sql = "SELECT bf2.observaciones as linea, bf2.modulo, bf2.batch, u.urlfirma as realizo 
                    FROM batch_firmas2seccion bf2 
                    INNER JOIN usuario u ON u.id = bf2.realizo
                    WHERE modulo = :modulo AND batch = :batch AND ref_multi = :ref_multi";
                $query = $conn->prepare($sql);
                $result = $query->execute([
                    'modulo' => $modulo,
                    'batch' => $batch,
                    'ref_multi' => $ref_multi,
                ]);

                while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
                    $arreglo["data"][] = $data;
                }
                if (empty($arreglo)) {
                    echo '3';
                    exit();
                }
            }

            echo json_encode($arreglo, JSON_UNESCAPED_UNICODE);

            break;

        case 4: // Obtener material sobrante y firmas

            $ref_multi = $_POST['ref_multi'];

            $sql = "SELECT bms.id, bms.ref_material, bms.envasada, bms.averias, bms.sobrante, bms.ref_producto, bms.batch, bms.modulo, u.urlfirma as realizo, us.urlfirma as verifico 
                    FROM batch_material_sobrante bms 
                    INNER JOIN usuario u ON u.id = bms.realizo
                    INNER JOIN usuario us ON us.id = bms.verifico 
                    WHERE modulo = :modulo AND batch = :batch AND ref_producto = :ref_multi";

            $query = $conn->prepare($sql);
            $result = $query->execute([
                'modulo' => $modulo,
                'batch' => $batch,
                'ref_multi' => $ref_multi,
            ]);

            while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
                $arreglo["data"][] = $data;
            }
            if (empty($arreglo)) {
                $sql = "SELECT bms.id, bms.ref_material, bms.envasada, bms.averias, bms.sobrante, bms.ref_producto, bms.batch, bms.modulo, u.urlfirma as realizo 
                    FROM batch_material_sobrante bms 
                    INNER JOIN usuario u ON u.id = bms.realizo
                    WHERE modulo = :modulo AND batch = :batch AND ref_producto = :ref_multi";

                $query = $conn->prepare($sql);
                $result = $query->execute([
                    'modulo' => $modulo,
                    'batch' => $batch,
                    'ref_multi' => $ref_multi,
                ]);

                while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
                    $arreglo["data"][] = $data;
                }
                if (empty($arreglo)) {
                    echo '3';
                    exit();
                }
            }

            echo json_encode($arreglo, JSON_UNESCAPED_UNICODE);
            break;

        case 5: // Insertar Firma Calidad

            $ref_multi = $_POST['ref_multi'];
            $firma = $_POST['id_firma'];

            $sql = "UPDATE batch_material_sobrante 
                    SET verifico=:verifico 
                    WHERE modulo = :modulo AND batch = :batch AND ref_producto = :ref_multi";
            $query = $conn->prepare($sql);
            $result = $query->execute([
                'modulo' => $modulo,
                'batch' => $batch,
                'ref_multi' => $ref_multi,
                'verifico' => $firma,
            ]);

            if ($result) {
                echo '1';
            } else
                echo '0';
            break;

        case 6:
            $ref_multi = $_POST['ref_multi'];

            $sql = "SELECT * 
                    FROM batch_muestras 
                    WHERE batch = :batch AND ref_multi = :ref_multi";
            $query = $conn->prepare($sql);
            $result = $query->execute([
                'modulo' => $modulo,
                'batch' => $batch,
                'ref_multi' => $ref_multi,
            ]);

            while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
                $arreglo["data"][] = $data;
            }
            if (empty($arreglo)) {
                echo '3';
                exit();
            }
            echo json_encode($arreglo, JSON_UNESCAPED_UNICODE);

            break;
    }
}
