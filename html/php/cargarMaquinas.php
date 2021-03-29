<?php

if (!empty($_POST)) {
    require_once('../../conexion.php');

    $modulo = $_POST['modulo'];
    $batch = $_POST['idBatch'];

    $sql = "SELECT * FROM batch_equipos WHERE modulo = :modulo AND batch = :batch";
    $query = $conn->prepare($sql);
    $query->execute([
        'modulo' => $modulo,
        'batch' => $batch,
    ]);
    $data = $query->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
}
