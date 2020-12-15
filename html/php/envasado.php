<?php

if (!empty($_POST)) {

    require_once('../../conexion.php');
    require_once('../../admin/sistema/php/crud.php');

    $op = $_POST['operacion'];
    $firma = $_POST['id_firma'];
    $modulo = $_POST['modulo'];
    $batch = $_POST['idBatch'];

    switch ($op) {
        case '1':
            $linea = $_POST['linea'];

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
            $sql = "UPDATE batch_firmas2seccion SET verifico = :verifico WHERE modulo = :modulo AND batch = :batch";
            $query = $conn->prepare($sql);
            $result = $query->execute([
                'verifico' => $firma,
                'modulo' => $modulo,
                'batch' => $batch,
            ]);
            break;
    }
}
