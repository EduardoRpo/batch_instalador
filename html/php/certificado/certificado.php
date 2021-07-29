<?php

if (!empty($_GET)) {
    require_once('../../../conexion.php');

    $op = $_GET['op'];
    $batch = $_GET['idBatch'];

    switch ($op) {
        case '1':
            $sql = "SELECT * FROM batch_analisis_microbiologico WHERE batch = :batch";
            $query = $conn->prepare($sql);
            $query->execute(['batch' => $batch]);
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            break;

        case '2': //
            $sql = "SELECT * FROM batch_control_especificaciones WHERE batch = :batch AND modulo = :modulo";
            $query = $conn->prepare($sql);
            $query->execute(['batch' => $batch, 'modulo' => 9]);
            $data = $query->fetch(PDO::FETCH_ASSOC);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            break;
    }
}
