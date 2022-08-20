<?php

function muestrasAcondicionamiento($documento, $batchDao, $batch)
{
    $hojaDatosBatch = $documento->createSheet();
    $hojaDatosBatch->setTitle("muestrasAcondicionamiento");
    $encabezado = ["No", "Apariencia Etiqueta", "Apariencia Termoencogible", "Cumplimiento Empaque", "Posicion Producto", "Rotulo Caja"];
    $hojaDatosBatch->fromArray($encabezado, null, 'A1');

    $batch = $batchDao->findMuestras($batch, 6);

    $row = 2;

    for ($i = 0; $i < sizeof($batch); $i++) {
        $num = $i + 1;
        $apariencia_etiquetas = $batch[$i]['apariencia_etiquetas'];
        $apariencia_termoencogible = $batch[$i]['apariencia_termoencogible'];
        $cumplimiento_empaque = $batch[$i]['cumplimiento_empaque'];
        $posicion_producto = $batch[$i]['posicion_producto'];
        $rotulo_caja = $batch[$i]['rotulo_caja'];

        $hojaDatosBatch->setCellValueByColumnAndRow(1, $row, $num);
        $hojaDatosBatch->setCellValueByColumnAndRow(2, $row, $apariencia_etiquetas);
        $hojaDatosBatch->setCellValueByColumnAndRow(3, $row, $apariencia_termoencogible);
        $hojaDatosBatch->setCellValueByColumnAndRow(4, $row, $cumplimiento_empaque);
        $hojaDatosBatch->setCellValueByColumnAndRow(5, $row, $posicion_producto);
        $hojaDatosBatch->setCellValueByColumnAndRow(6, $row, $rotulo_caja);
        $row++;
    }

    return $hojaDatosBatch;
}
