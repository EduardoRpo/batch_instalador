<?php

function conditions($documento, $batchDao, $batch)
{
    //Condiciones del Medio
    $hojaDatosBatch = $documento->createSheet();
    $hojaDatosBatch->setTitle("CondicionesMedio"); 
    $encabezado = ["Fecha", "Temperatura", "Humedad", "modulo"];
    $hojaDatosBatch->fromArray($encabezado, null, 'A1');

    $conditionsEnvironment = $batchDao->findTemperatureByIdBatch($batch);

    $row = 2;

    for ($i = 0; $i < sizeof($conditionsEnvironment); $i++) {
        $date = $conditionsEnvironment[$i]['fecha'];
        $temperature = $conditionsEnvironment[$i]['temperatura'];
        $humidity = $conditionsEnvironment[$i]['humedad'];
        $module = $conditionsEnvironment[$i]['modulo'];

        $hojaDatosBatch->setCellValueByColumnAndRow(1, $row, $date);
        $hojaDatosBatch->setCellValueByColumnAndRow(2, $row, $temperature);
        $hojaDatosBatch->setCellValueByColumnAndRow(3, $row, $humidity);
        $hojaDatosBatch->setCellValueByColumnAndRow(4, $row, $module);
        $row++;
    }
    return $hojaDatosBatch;
}
