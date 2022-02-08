<?php

function control_firmas_multi($conn, $batch)
{
    $sql = "SELECT * FROM multipresentacion WHERE id_batch = :batch";
    $query_multi = $conn->prepare($sql);
    $query_multi->execute(['batch' => $batch]);
    $rows_multi = $query_multi->rowCount();

    for ($i = 5; $i < 9; $i++) {
        if ($i == 5) $rows_multi == 0 ? $total_firmas = 6 : $total_firmas = ($rows_multi * 4) + 2;
        if ($i == 6) $rows_multi == 0 ? $total_firmas = 7 : $total_firmas = ($rows_multi * 5) + 2;
        if ($i == 7) $rows_multi == 0 ? $total_firmas = 1 : $total_firmas = $rows_multi;
        if ($i == 8) $rows_multi == 0 ? $total_firmas = 2 : $total_firmas = ($rows_multi * 2);

        $sql = "UPDATE batch_control_firmas SET total_firmas = :total_firmas WHERE batch = :batch AND modulo = :modulo";
        $query = $conn->prepare($sql);
        $query->execute(['total_firmas' => $total_firmas, 'batch' => $batch, 'modulo' => $i]);
    }
}
