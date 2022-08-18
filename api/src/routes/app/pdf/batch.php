<?php

function batch($hojaDatosBatch, $batchDao, $batch)
{
    $encabezado = [
        "referencia", "Descripcion", "Marca", "Propietario", "Linea", "Notificacion", "Orden", "Lote", "F.Creacion", "Tamaño Lote", "Unidad Lote"
    ];
    $hojaDatosBatch->fromArray($encabezado, null, 'A1');
    $batch = $batchDao->findByIdBatch($batch);

    $row = 2;

    for ($i = 0; $i < sizeof($batch); $i++) {
        $referencia = $batch[$i]['referencia'];
        $nombre_referencia = $batch[$i]['nombre_referencia'];
        $marca = $batch[$i]['marca'];
        $propietario = $batch[$i]['propietario'];
        $linea = $batch[$i]['linea'];
        $notificacion = $batch[$i]['notificacion'];
        $orden = $batch[$i]['numero_orden'];
        $lote = $batch[$i]['numero_lote'];
        $fecha_creacion = $batch[$i]['fecha_creacion'];
        $tamanio_lote = $batch[$i]['tamano_lote'];
        $unidad_lote = $batch[$i]['unidad_lote'];

        $hojaDatosBatch->setCellValueByColumnAndRow(1, $row, $referencia);
        $hojaDatosBatch->setCellValueByColumnAndRow(2, $row, $nombre_referencia);
        $hojaDatosBatch->setCellValueByColumnAndRow(3, $row, $marca);
        $hojaDatosBatch->setCellValueByColumnAndRow(4, $row, $propietario);
        $hojaDatosBatch->setCellValueByColumnAndRow(5, $row, $linea);
        $hojaDatosBatch->setCellValueByColumnAndRow(6, $row, $notificacion);
        $hojaDatosBatch->setCellValueByColumnAndRow(7, $row, $orden);
        $hojaDatosBatch->setCellValueByColumnAndRow(8, $row, $lote);
        $hojaDatosBatch->setCellValueByColumnAndRow(9, $row, $fecha_creacion);
        $hojaDatosBatch->setCellValueByColumnAndRow(10, $row, $tamanio_lote);
        $hojaDatosBatch->setCellValueByColumnAndRow(11, $row, $unidad_lote);
        $row++;
    }
    return $hojaDatosBatch;
}
