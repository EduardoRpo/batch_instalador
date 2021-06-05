<?php

if (!empty($_POST)) {
    require_once('../../conexion.php');

    $batch = $_POST['idBatch'];
    $referencia = $_POST['referencia'];

    $sql = "SELECT * FROM `batch_muestras_retencion` WHERE batch = :batch AND referencia = :referencia";
    $query = $conn->prepare($sql);
    $query->execute(['batch' => $batch, 'referencia' => $referencia]);
    $data = $query->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
}
