<?php
require_once('../../../conexion.php');

$sql = "SELECT DISTINCT id_batch FROM batch WHERE estado > 0";
$query = $conn->prepare($sql);
$query->execute();
$batchs = $query->fetchAll(PDO::FETCH_ASSOC);

foreach ($batchs as $batch) {
    /* $batch = 478; */
    $sql = "SELECT * FROM batch_control_firmas WHERE batch = :batch";
    $query = $conn->prepare($sql);
    $query->execute(['batch' => $batch['id_batch']]);
    /* $query->execute(['batch' => $batch]); */
    $batchFirmas = $query->fetchAll(PDO::FETCH_ASSOC);

    for ($i = 2; $i < 11; $i++) {
        $key = array_search($i, array_column($batchFirmas, 'modulo'));

        if ($key) {
            /* if (!$key) { */

            /* Validar si existe multipresentacion */
            $modulo = $i;
            $sql = "SELECT * FROM multipresentacion WHERE id_batch = :batch";
            $query_multi = $conn->prepare($sql);
            $query_multi->execute(['batch' => $batch['id_batch']]);
            /* $query_multi->execute(['batch' => $batch]); */
            $rows_multi = $query_multi->rowCount();

            if ($modulo == 2) $total_firmas = 4;
            if ($modulo == 3) $total_firmas = 4;
            if ($modulo == 4) $total_firmas = 2;
            if ($modulo == 5) $rows_multi == 0 ? $total_firmas = 6 : $total_firmas = ($rows_multi * 4) + 2;
            if ($modulo == 6) $rows_multi == 0 ? $total_firmas = 7 : $total_firmas = ($rows_multi * 5) + 2;
            if ($modulo == 7) $rows_multi == 0 ? $total_firmas = 1 : $total_firmas = $rows_multi;
            if ($modulo == 8) $rows_multi == 0 ? $total_firmas = 2 : $total_firmas = $rows_multi;
            if ($modulo == 9) $rows_multi == 0 ? $total_firmas = 2 : $total_firmas = $rows_multi;
            if ($modulo == 10) $rows_multi == 0 ? $total_firmas = 3 : $total_firmas = $rows_multi;


            /* $sql = "INSERT INTO batch_control_firmas (modulo, batch, cantidad_firmas, total_firmas) 
                    VALUES(:modulo, :batch, :cantidad_firmas, :total_firmas)";
            $query_insert = $conn->prepare($sql);
            $query_insert->execute(['modulo' => $i, 'batch' => $batch['id_batch'], 'cantidad_firmas' => 0, 'total_firmas' => $total_firmas]); */

            $sql = "UPDATE batch_control_firmas SET total_firmas = :total_firmas WHERE modulo = :modulo AND batch = :batch";
            $query_update = $conn->prepare($sql);
            $query_update->execute(['modulo' => $i, 'batch' => $batch['id_batch'], 'total_firmas' => $total_firmas]);
            /* $query_update->execute(['modulo' => $i, 'batch' => $batch, 'total_firmas' => $total_firmas]); */
        }
    }
}
