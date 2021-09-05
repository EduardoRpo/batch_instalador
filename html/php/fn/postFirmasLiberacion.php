<?php
require_once('../../../conexion.php');

$sql = "SELECT * FROM batch_liberacion ORDER BY batch ASC";
$query = $conn->prepare($sql);
$query->execute();
$batch_liberacion = $query->fetchAll(PDO::FETCH_ASSOC);

for ($i = 0; $i < sizeof($batch_liberacion); $i++) {

    $batch = $batch_liberacion[$i]['batch'];

    $sql = "SELECT * FROM batch_control_firmas WHERE modulo = 10 AND batch = :batch";
    $query = $conn->prepare($sql);
    $query->execute(['batch' => $batch]);
    $batch_firmas = $query->fetchAll(PDO::FETCH_ASSOC);
    $rows = $query->rowCount();

    if (!$rows) {
        $cantidad_firmas = 0;

        if ($batch_liberacion[$i]['dir_produccion'] > 0)
            $cantidad_firmas = $cantidad_firmas + 1;

        if ($batch_liberacion[$i]['dir_calidad'] > 0)
            $cantidad_firmas = $cantidad_firmas + 1;

        if ($batch_liberacion[$i]['dir_tecnica'] > 0)
            $cantidad_firmas = $cantidad_firmas + 1;


        $sql = "INSERT INTO batch_control_firmas (modulo, batch, cantidad_firmas, total_firmas) VALUES(:modulo, :batch, :cantidad_firmas, :total_firmas)";
        $query = $conn->prepare($sql);
        $query->execute(['modulo' => 10, 'batch' => $batch, 'cantidad_firmas' => $cantidad_firmas, 'total_firmas' => 3]);
    }
}
