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
            $sql = "SELECT * FROM batch_firmas2seccion bf2 
                    INNER JOIN batch_control_especificaciones bce ON bf2.batch = bce.batch AND bf2.modulo = bce.modulo 
                    INNER JOIN batch_liberacion bl ON bf2.batch = bl.batch 
                    WHERE bf2.batch = :batch AND bf2.modulo = :modulo";
            $query = $conn->prepare($sql);
            $query->execute(['batch' => $batch, 'modulo' => 9]);
            $data = $query->fetch(PDO::FETCH_ASSOC);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            break;

        case '3':
            $sql = "SELECT b.numero_orden, p.nombre_referencia, pp.nombre as propietario, b.numero_lote, b.lote_presentacion, ns.nombre as notificacion_sanitaria 
                    FROM batch b 
                    INNER JOIN producto p ON p.referencia = b.id_producto 
                    INNER JOIN propietario pp ON pp.id = p.id_propietario 
                    INNER JOIN notificacion_sanitaria ns ON ns.id = p.id_notificacion_sanitaria 
                    WHERE b.id_batch = :batch";
            $query = $conn->prepare($sql);
            $query->execute(['batch' => $batch]);
            $data = $query->fetch(PDO::FETCH_ASSOC);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            break;

        case '4':
            $sql = "SELECT * FROM batch_liberacion WHERE batch = :batch";
            $query = $conn->prepare($sql);
            $query->execute(['batch' => $batch]);
            $data = $query->fetch(PDO::FETCH_ASSOC);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            break;
    }
}
