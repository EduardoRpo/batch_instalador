<?php

function equipment($documento, $equiposDao, $batch)
{
    //Equipos
    $hojaDatosBatch = $documento->createSheet();
    $hojaDatosBatch->setTitle("Equipos");
    $encabezado = ["Equipo", "Modulo"];
    $hojaDatosBatch->fromArray($encabezado, null, 'A1');

    $equipos = $equiposDao->findByBatch($batch);

    $row = 2;

    for ($i = 0; $i < sizeof($equipos); $i++) {
        $description = $equipos[$i]['descripcion'];
        $module = $equipos[$i]['modulo'];

        $hojaDatosBatch->setCellValueByColumnAndRow(1, $row, $description);
        $hojaDatosBatch->setCellValueByColumnAndRow(2, $row, $module);
        $row++;
    }

    return $hojaDatosBatch;
}
