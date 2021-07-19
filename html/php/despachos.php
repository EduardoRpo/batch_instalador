<?php

if (!empty($_POST)) {

    require_once('../../conexion.php');

    $op = $_POST['op'];
    $batch = $_POST['idBatch'];
    $referencia = $_POST['ref_multi'];
    $modulo = $_POST['modulo'];

    switch ($op) {
        case 1:
            if ($modulo == 7) {
                $sql = "SELECT * FROM batch_conciliacion_parciales WHERE batch = :batch AND ref_multi = :referencia";
                $query = $conn->prepare($sql);
                $query->execute(['batch' => $batch, 'referencia' => $referencia]);
                $data = $query->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $sql = "SELECT * FROM batch_conciliacion_rendimiento WHERE batch = :batch AND modulo = :modulo AND ref_multi = :referencia";
                $query = $conn->prepare($sql);
                $result = $query->execute(['batch' => $batch, 'modulo' => $modulo, 'referencia' => $referencia]);
                $data = $query->fetch(PDO::FETCH_ASSOC);
            }

            if (empty($data)) {
                $sql = "SELECT * FROM batch_conciliacion_parciales WHERE batch = :batch AND ref_multi = :referencia";
                $query = $conn->prepare($sql);
                $query->execute(['batch' => $batch, 'referencia' => $referencia]);
                $data = $query->fetchAll(PDO::FETCH_ASSOC);
            }

            echo json_encode($data, JSON_UNESCAPED_UNICODE);

            break;

        case '2':
            $sql = "SELECT u.urlfirma FROM batch_conciliacion_rendimiento bcr INNER JOIN usuario u ON u.id = bcr.entrego 
                    WHERE batch = :batch AND modulo = :modulo AND ref_multi = :referencia";
            $query = $conn->prepare($sql);
            $result = $query->execute(['batch' => $batch, 'modulo' => $modulo, 'referencia' => $referencia]);
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            break;
    }
}
