<?php

function updateBatchAprobado($batch, $conn)
{
    $sql = "UPDATE batch SET ok_aprobado = 1 WHERE id_batch = :batch";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['batch' => $batch]);
}
