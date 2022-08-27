<?php

function envaseSobrante($documento, $batchDao, $batch)
{
    $hojaDatosBatch = $documento->createSheet();
    $hojaDatosBatch->setTitle("EnvaseSobrante");
    $encabezado = ["Referencia", "Envasada", "Averias", "Sobrante", "modulo"];
    $hojaDatosBatch->fromArray($encabezado, null, 'A1');

    $batch = $batchDao->findEnvaseSobrante($batch);

    $row = 2;

    for ($i = 0; $i < sizeof($batch); $i++) {
        $ref_material = $batch[$i]['ref_material'];

        $envase = $batch[$i]['envase'];
        $tapa = $batch[$i]['tapa'];
        $etiqueta = $batch[$i]['etiqueta'];

        $envase ? $material = $envase : ($tapa ? $material = $tapa : $material = $etiqueta);

        $envasada = $batch[$i]['envasada'];
        $sobrante = $batch[$i]['sobrante'];
        $modulo = $batch[$i]['modulo'];

        $hojaDatosBatch->setCellValueByColumnAndRow(1, $row, $ref_material);
        $hojaDatosBatch->setCellValueByColumnAndRow(2, $row, $material);
        $hojaDatosBatch->setCellValueByColumnAndRow(3, $row, $envasada);
        $hojaDatosBatch->setCellValueByColumnAndRow(4, $row, $sobrante);
        $hojaDatosBatch->setCellValueByColumnAndRow(5, $row, $modulo);
        $row++;
    }

    return $hojaDatosBatch;
}
