<?php

function muestrasEnvasado($documento, $batchDao, $batch)
{
    $hojaDatosBatch = $documento->createSheet();
    $hojaDatosBatch->setTitle("muestrasEnvasado");
    $encabezado = ["No", "Muestra", "Modulo"];
    $hojaDatosBatch->fromArray($encabezado, null, 'A1');

    $batch = $batchDao->findMuestras($batch, 5);

    $row = 2;

    for ($i = 0; $i < sizeof($batch); $i++) {
        $num = $i + 1;
        $muestra = $batch[$i]['muestra'];
        $modulo = $batch[$i]['modulo'];

        $hojaDatosBatch->setCellValueByColumnAndRow(1, $row, $num);
        $hojaDatosBatch->setCellValueByColumnAndRow(2, $row, $muestra);
        $hojaDatosBatch->setCellValueByColumnAndRow(3, $row, $modulo);
        $row++;
    }

    return $hojaDatosBatch;
}
