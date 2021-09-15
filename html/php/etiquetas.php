<?php

if (!empty($_POST)) {
    require_once('../../conexion.php');

    $batch = $_POST['idBatch'];
    $referencia = $_POST['referencia'];

    /* Busca a cantidad de registro de parciales del batch y referencia */

    $sql = "SELECT * FROM batch_conciliacion_parciales WHERE batch = :batch AND ref_multi = :referencia";
    $query = $conn->prepare($sql);
    $query->execute(['batch' => $batch, 'referencia' => $referencia]);
    $data = $query->fetchAll(PDO::FETCH_ASSOC);
    $rows_parciales = $query->rowCount();


    /* si los parciales son mayores a uno o no hay se busca todas las muestras */

    if ($rows_parciales == 1 || $rows_parciales == 0) {
        $sql = "SELECT * FROM `batch_muestras_retencion` WHERE batch = :batch AND referencia = :referencia";
        $query = $conn->prepare($sql);
        $query->execute(['batch' => $batch, 'referencia' => $referencia]);
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
}
