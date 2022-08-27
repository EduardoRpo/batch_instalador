<?php

function desifectant($documento, $batchDao, $batch)
{
    $hojaDatosBatch = $documento->createSheet();
    $hojaDatosBatch->setTitle("Desinfectante"); 
    $encabezado = ["Desinfectante", "Concentracion", "modulo", "realizo", "verifico", "fecha_registro"];
    $hojaDatosBatch->fromArray($encabezado, null, 'A1');

    /* $hojaDatosBatch = $documento->createSheet();
    $hojaDatosBatch->setTitle("Desinfectante");  
    $encabezado = ["Desinfectante", "Concentracion", "modulo", "realizo", "verifico", "fecha_registro"];
    $hojaDatosBatch->fromArray($encabezado, null, 'A4');*/

    $desinfect = $batchDao->findDesinfectByIdBatch($batch);

    $row = 2;

    for ($i = 0; $i < sizeof($desinfect); $i++) {
        $desinfectante = $desinfect[$i]['desinfectante'];
        $concentracion = $desinfect[$i]['concentracion'];
        $modulo = $desinfect[$i]['modulo'];
        $realizo = $desinfect[$i]['nombre_realizo'];
        $verifico = $desinfect[$i]['nombre_verifico'];
        $fecha_registro = $desinfect[$i]['fecha_registro'];

        $hojaDatosBatch->setCellValueByColumnAndRow(1, $row, $desinfectante);
        $hojaDatosBatch->setCellValueByColumnAndRow(2, $row, $concentracion);
        $hojaDatosBatch->setCellValueByColumnAndRow(3, $row, $modulo);
        $hojaDatosBatch->setCellValueByColumnAndRow(4, $row, $realizo);
        $hojaDatosBatch->setCellValueByColumnAndRow(5, $row, $verifico);
        $hojaDatosBatch->setCellValueByColumnAndRow(6, $row, $fecha_registro);
        $row++;
    }
    return $hojaDatosBatch;
}
