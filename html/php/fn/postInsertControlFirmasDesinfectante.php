<?php
require_once('../../../conexion.php');

$sql = "SELECT * FROM batch_control_firmas WHERE batch > 999 AND batch < 1801";
$query = $conn->prepare($sql);
$query->execute();
$batchFirmas = $query->fetchAll(PDO::FETCH_ASSOC);

for ($i = 999; $i < sizeof($batchFirmas); $i++) {
    if ($batchFirmas[$i]['modulo'] != 7 and $batchFirmas[$i]['modulo'] != 8 and $batchFirmas[$i]['modulo'] != 9 and $batchFirmas[$i]['modulo'] != 10) {
        if ($batchFirmas[$i]['cantidad_firmas'] == 0) {
            $sql = "UPDATE batch_control_firmas SET cantidad_firmas = 2 WHERE modulo = :modulo AND batch = :batch";
            $query_update = $conn->prepare($sql);
            $query_update->execute(['modulo' => $batchFirmas[$i]['modulo'], 'batch' => $batchFirmas[$i]['batch']]);
        }
    }
}
