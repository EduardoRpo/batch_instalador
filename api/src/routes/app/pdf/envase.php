<?php

function envase($documento, $batchDao, $reference)
{
    $hojaDatosBatch = $documento->createSheet();
    $hojaDatosBatch->setTitle("EnvaseEntregado");

    $encabezado = ["id_envase", "Envase", "id_tapa", "Tapa", "id_etiqueta", "Etiqueta", "id_empaque", "Empaque", "id_otros", "Otros"];
    $hojaDatosBatch->fromArray($encabezado, null, 'A1');

    $batch = $batchDao->findEnvase($reference);

    $row = 2;

    for ($i = 0; $i < sizeof($batch); $i++) {
        $id_envase = $batch[$i]['id_envase'];
        $envase = $batch[$i]['envase'];
        $id_tapa = $batch[$i]['id_tapa'];
        $tapa = $batch[$i]['tapa'];
        $id_etiqueta = $batch[$i]['id_etiqueta'];
        $etiqueta = $batch[$i]['etiqueta'];
        $id_empaque = $batch[$i]['id_empaque'];
        $empaque = $batch[$i]['empaque'];
        $id_otros = $batch[$i]['id_otros'];
        $otros = $batch[$i]['otros'];

        $hojaDatosBatch->setCellValueByColumnAndRow(1, $row, $id_envase);
        $hojaDatosBatch->setCellValueByColumnAndRow(2, $row, $envase);
        $hojaDatosBatch->setCellValueByColumnAndRow(3, $row, $id_tapa);
        $hojaDatosBatch->setCellValueByColumnAndRow(4, $row, $tapa);
        $hojaDatosBatch->setCellValueByColumnAndRow(5, $row, $id_etiqueta);
        $hojaDatosBatch->setCellValueByColumnAndRow(6, $row, $etiqueta);
        $hojaDatosBatch->setCellValueByColumnAndRow(7, $row, $id_empaque);
        $hojaDatosBatch->setCellValueByColumnAndRow(8, $row, $empaque);
        $hojaDatosBatch->setCellValueByColumnAndRow(9, $row, $id_otros);
        $hojaDatosBatch->setCellValueByColumnAndRow(10, $row, $otros);
        $row++;
    }

    return $hojaDatosBatch;
}
