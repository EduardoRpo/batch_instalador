<?php

require_once(__DIR__ . '/muestras_retencion.php');

/* Almacenar muestras retencion */

function almacenar_muestras_retencion($conn, $retencion, $referencia, $batch)
{

    $sql = "SELECT * FROM batch_muestras_retencion WHERE batch = :batch AND referencia=:referencia";
    $query = $conn->prepare($sql);
    $query->execute(['referencia' => $referencia, 'batch' => $batch]);
    $rows = $query->rowCount();

    if (!$rows) {
        $sql = "SELECT MAX(muestra) as consecutivo FROM  batch_muestras_retencion";
        $query = $conn->prepare($sql);
        $query->execute();
        $data = $query->fetch(PDO::FETCH_ASSOC);

        if ($data['consecutivo'] == null)
            $muestra = 1;
        else
            $muestra = $data['consecutivo'] + 1;

        for ($i = 1; $i < $retencion; $i++) {
            $sql = "INSERT INTO batch_muestras_retencion SET referencia = :referencia, muestra = :muestra,  batch = :batch";
            $query = $conn->prepare($sql);
            $query->execute(['referencia' => $referencia, 'muestra' => $muestra, 'batch' => $batch]);
            $muestra = $muestra + 1;
        }
    }
}
