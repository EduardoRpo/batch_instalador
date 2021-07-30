<?php
require_once('../../../conexion.php');

if (!empty($_GET['data'])) {
    $valor = $_GET['data'];

    $sql = "SELECT b.id_batch, p.referencia, p.nombre_referencia, b.numero_lote FROM batch b 
            INNER JOIN producto p ON b.id_producto = p.referencia
            WHERE numero_lote = :lote";
    $query = $conn->prepare($sql);
    $query->execute(['lote' => $valor]);
    $data = $query->fetchAll(PDO::FETCH_ASSOC);

    if (sizeof($data) == 0) {
        $sql = "SELECT b.id_batch, p.referencia, p.nombre_referencia, b.numero_lote FROM batch b 
            INNER JOIN producto p ON b.id_producto = p.referencia
            WHERE id_batch = :batch";
        $query = $conn->prepare($sql);
        $query->execute(['batch' => $valor]);
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        if (sizeof($data) == 0) {
            echo '0';
        } else
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
    } else
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
}
