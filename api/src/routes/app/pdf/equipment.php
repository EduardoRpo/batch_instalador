<?php

function equipment($hojaDatosBatch, $equiposDao, $batch)
{
    //Equipos

    $encabezado = ["Equipo", "Modulo"];
    $hojaDatosBatch->fromArray($encabezado, null, 'A37');

    $equipos = $equiposDao->findByBatch($batch);

    $row = 38;

    for ($i = 0; $i < sizeof($equipos); $i++) {
        $description = $equipos[$i]['descripcion'];
        $module = $equipos[$i]['modulo'];

        $hojaDatosBatch->setCellValueByColumnAndRow(1, $row, $description);
        $hojaDatosBatch->setCellValueByColumnAndRow(2, $row, $module);
        $row++;
    }

    return $hojaDatosBatch;
}
