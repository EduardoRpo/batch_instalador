<?php

if (!empty($_POST)) {
    $op = $_POST['op'];

    switch ($variable) {
        case 1:
            $batch = $_POST['idBatch'];
            $sql = "SELECT numero_orden, id_producto, tamano_lote FROM batch";
            $query = $conn->prepare($sql);
            $query->execute(['batch' => $batch]);
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            break;
    }
}
