<?php

function registrarFirmas($conn, $batch, $modulo)
{
    /* Buscar si existen firmas registradas */

    $sql = "SELECT * FROM batch_control_firmas WHERE batch = :batch AND modulo = :modulo";
    $query = $conn->prepare($sql);
    $query->execute(['batch' => $batch, 'modulo' => $modulo]);
    $rows = $query->rowCount();

    /* Validar si existe multipresentacion */

    $sql = "SELECT * FROM multipresentacion WHERE id_batch = :batch";
    $query_multi = $conn->prepare($sql);
    $query_multi->execute(['batch' => $batch]);
    $rows_multi = $query->rowCount();

    if ($modulo == 5) $rows_multi == 0 ? $total_firmas = 6 : $total_firmas = ($rows_multi * 4) + 2;
    if ($modulo == 6) $rows_multi == 0 ? $total_firmas = 7 : $total_firmas = ($rows_multi * 5) + 2;
    if ($modulo == 7) $rows_multi == 0 ? $total_firmas = 1 : $total_firmas = $rows_multi;
    if ($modulo == 8) $rows_multi == 0 ? $total_firmas = 2 : $total_firmas = $rows_multi;
    if ($modulo == 9) $rows_multi == 0 ? $total_firmas = 2 : $total_firmas = $rows_multi;
    if ($modulo == 10) $rows_multi == 0 ? $total_firmas = 3 : $total_firmas = $rows_multi;

    if ($rows > 0) {
        $data = $query->fetchAll(PDO::FETCH_ASSOC);

        if (sizeof($data) > 0)
            $cantidad = $data[0]['cantidad_firmas'] + 1;
        else
            $cantidad = 1;

        $sql = "UPDATE batch_control_firmas SET cantidad_firmas = :cantidad, total_firmas = :total_firmas 
                WHERE batch = :batch AND modulo = :modulo";
        $query = $conn->prepare($sql);
        $query->execute(['cantidad' => $cantidad, 'total_firmas' => $total_firmas, 'batch' => $batch, 'modulo' => $modulo]);
    } else {

        $sql = "INSERT INTO batch_control_firmas (modulo, batch, cantidad_firmas, total_firmas) VALUES(:modulo, :batch, :cantidad_firmas, :total_firmas)";
        $query = $conn->prepare($sql);
        $query->execute(['modulo' => $modulo, 'batch' => $batch, 'cantidad_firmas' => 1, 'total_firmas' => $total_firmas]);
    }
}
