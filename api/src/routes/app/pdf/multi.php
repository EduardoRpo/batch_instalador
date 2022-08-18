<?php

function multi($hojaDatosBatch, $batchDao, $batch)
{
    //Mutipresentacion

    $encabezado = ["Referencia", "Presentacion", "Cantidad", "Total"];
    $hojaDatosBatch->fromArray($encabezado, null, 'A51');

    $batch = $batchDao->findMulti($batch);

    $row = 52;

    for ($i = 0; $i < sizeof($batch); $i++) {
        $reference = $batch[$i]['referencia'];
        $presentation = $batch[$i]['presentacion_comercial'];
        $cantidad = $batch[$i]['cantidad'];
        $total = $batch[$i]['total'];

        $hojaDatosBatch->setCellValueByColumnAndRow(1, $row, $reference);
        $hojaDatosBatch->setCellValueByColumnAndRow(2, $row, $presentation);
        $hojaDatosBatch->setCellValueByColumnAndRow(3, $row, $cantidad);
        $hojaDatosBatch->setCellValueByColumnAndRow(4, $row, $total);
        $row++;
    }

    return $hojaDatosBatch;
}
