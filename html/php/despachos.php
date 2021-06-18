<?php

if (!empty($_POST)) {

    require_once('../../conexion.php');

    $op = $_POST['op'];
    $batch = $_POST['idBatch'];
    $referencia = $_POST['ref_multi'];


    switch ($op) {
        case 1:
            $sql = "SELECT * FROM batch_conciliacion_rendimiento WHERE batch = :batch AND ref_multi = :referencia";
            $query = $conn->prepare($sql);
            $result = $query->execute(['batch' => $batch, 'referencia' => $referencia]);
            $data = $query->fetch(PDO::FETCH_ASSOC);
            if (empty($data)) echo '0';
            else echo json_encode($data, JSON_UNESCAPED_UNICODE);

            break;
    }
}
