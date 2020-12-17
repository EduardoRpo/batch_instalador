<?php

if (!empty($_POST)) {

    require_once('../../conexion.php');
    require_once('../../admin/sistema/php/crud.php');

    $op = $_POST['operacion'];

    $modulo = $_POST['modulo'];
    $batch = $_POST['idBatch'];

    switch ($op) {
        case '1':
            $linea = $_POST['linea'];
            $firma = $_POST['id_firma'];

            $sql = "INSERT INTO batch_firmas2seccion (observaciones, modulo, batch, realizo) 
            VALUES (:observaciones, :modulo, :batch, :realizo)";
            $query = $conn->prepare($sql);
            $result = $query->execute([
                'observaciones' => $linea,
                'modulo' => $modulo,
                'batch' => $batch,
                'realizo' => $firma,
            ]);

            if ($result) {
                echo '1';
            } else
                echo '0';
            break;

        case 2:
            $firma = $_POST['id_firma'];

            $sql = "UPDATE batch_firmas2seccion SET verifico = :verifico WHERE modulo = :modulo AND batch = :batch";
            $query = $conn->prepare($sql);
            $result = $query->execute([
                'verifico' => $firma,
                'modulo' => $modulo,
                'batch' => $batch,
            ]);
            break;
        case 3:
            $sql = "SELECT bf2.observaciones as linea, bf2.modulo, bf2.batch, u.urlfirma, bf2.verifico FROM batch_firmas2seccion bf2 INNER JOIN usuario U ON U.id=bf2.id  WHERE modulo = :modulo AND batch = :batch";
            $query = $conn->prepare($sql);
            $result = $query->execute([
                'modulo' => $modulo,
                'batch' => $batch,
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
