<?php

/* Obtener los tanques registrados para el batch record */

if (!empty($_POST)) {
    require_once('../../conexion.php');

    $batch = $_POST['idBatch'];
    $sql = "SELECT tanque, cantidad FROM batch_tanques WHERE id_batch = :batch";
    $query = $conn->prepare($sql);
    $query->execute(['batch' => $batch]);
    $rows = $query->rowCount();

    if ($rows > 0) {
        $data = $query->fetch(PDO::FETCH_ASSOC);
        $arreglo[] = $data;
        echo json_encode($arreglo, JSON_UNESCAPED_UNICODE);
    }
}
