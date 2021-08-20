<?php

function registrarFirmas($conn, $batch, $modulo)
{
    $sql = "SELECT * FROM batch_control_firmas WHERE batch = :batch AND modulo = :modulo";
    $query = $conn->prepare($sql);
    $query->execute(['batch' => $batch, 'modulo' => $modulo]);
    $rows = $query->rowCount();

    if ($rows > 0) {
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        $cantidad = $data[0]['cantidad_firmas'] + 1;
        $sql = "UPDATE batch_control_firmas SET cantidad_firmas = :cantidad WHERE batch = :batch AND modulo = :modulo";
        $query = $conn->prepare($sql);
        $query->execute(['cantidad' => $cantidad, 'batch' => $batch, 'modulo' => $modulo]);
    } else {
        $sql = "SELECT * FROM multipresentacion WHERE id_batch = :batch";
        $query = $conn->prepare($sql);
        $query->execute(['batch' => $batch]);
        $rows = $query->rowCount();

        if ($modulo == 5) $rows == 0 ? $total_firmas = 6 : $total_firmas = ($rows * 4) + 2;
        if ($modulo == 6) $rows == 0 ? $total_firmas = 7 : $total_firmas = ($rows * 5) + 2;
        if ($modulo == 7) $rows == 0 ? $total_firmas = 1 : $total_firmas = $rows;
        if ($modulo == 8) $rows == 0 ? $total_firmas = 2 : $total_firmas = $rows;
        if ($modulo == 9) $rows == 0 ? $total_firmas = 2 : $total_firmas = $rows;

        $sql = "INSERT INTO batch_control_firmas (modulo, batch, cantidad_firmas, total_firmas) VALUES(:modulo, :batch, :cantidad_firmas, :total_firmas)";
        $query = $conn->prepare($sql);
        $query->execute(['modulo' => $modulo, 'batch' => $batch, 'cantidad_firmas' => 1, 'total_firmas' => $total_firmas]);
    }
}
