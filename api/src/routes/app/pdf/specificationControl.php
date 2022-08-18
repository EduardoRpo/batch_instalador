<?php

function specificationControl($hojaDatosBatch, $batchDao, $batch)
{
    //Control de Especificaciones

    $encabezado = ["Color", "Olor", "Apariencia", "PH", "Viscosidad", "Densidad", "Untuosidad", "Espumoso", "Alcohol", "Aguja", "RPM", "Modulo"];
    $hojaDatosBatch->fromArray($encabezado, null, 'A30');

    $specificationsControl = $batchDao->findSpecificationsControl($batch);

    $row = 31;

    for ($i = 0; $i < sizeof($specificationsControl); $i++) {
        $color = $specificationsControl[$i]['color'];
        $color == '1' ? $color = 'Cumple' : ($color == 2 ? $color = 'No cumple' : $color = 'No aplica');

        $olor = $specificationsControl[$i]['olor'];
        $olor == 1 ? $olor = 'Cumple' : ($olor == 2 ? $olor = 'No cumple' : $olor = 'No aplica');

        $apariencia = $specificationsControl[$i]['apariencia'];
        $apariencia == 1 ? $apariencia = 'Cumple' : ($apariencia == 2 ? $apariencia = 'No cumple' : $apariencia = 'No aplica');

        $ph = $specificationsControl[$i]['ph'];
        $viscosidad = $specificationsControl[$i]['viscosidad'];
        $densidad = $specificationsControl[$i]['densidad'];

        $untuosidad = $specificationsControl[$i]['untuosidad'];
        $untuosidad == 1 ? $untuosidad = 'Cumple' : ($untuosidad == 2 ? $untuosidad = 'No cumple' : $untuosidad = 'No aplica');

        $espumoso = $specificationsControl[$i]['espumoso'];
        $espumoso == 1 ? $espumoso = 'Cumple' : ($espumoso == 2 ? $espumoso = 'No cumple' : $espumoso = 'No aplica');

        $alcohol = $specificationsControl[$i]['alcohol'];
        $alcohol == 1 ? $alcohol = 'Cumple' : ($alcohol == 2 ? $alcohol = 'No cumple' : $alcohol = 'No aplica');

        $aguja = $specificationsControl[$i]['aguja'];
        $rpm = $specificationsControl[$i]['rpm'];
        $module = $specificationsControl[$i]['modulo'];

        $hojaDatosBatch->setCellValueByColumnAndRow(1, $row, $color);
        $hojaDatosBatch->setCellValueByColumnAndRow(2, $row, $olor);
        $hojaDatosBatch->setCellValueByColumnAndRow(3, $row, $apariencia);
        $hojaDatosBatch->setCellValueByColumnAndRow(4, $row, $ph);
        $hojaDatosBatch->setCellValueByColumnAndRow(5, $row, $viscosidad);
        $hojaDatosBatch->setCellValueByColumnAndRow(6, $row, $densidad);
        $hojaDatosBatch->setCellValueByColumnAndRow(7, $row, $untuosidad);
        $hojaDatosBatch->setCellValueByColumnAndRow(8, $row, $espumoso);
        $hojaDatosBatch->setCellValueByColumnAndRow(9, $row, $alcohol);
        $hojaDatosBatch->setCellValueByColumnAndRow(10, $row, $aguja);
        $hojaDatosBatch->setCellValueByColumnAndRow(11, $row, $rpm);
        $hojaDatosBatch->setCellValueByColumnAndRow(12, $row, $module);
        $row++;
    }

    return $hojaDatosBatch;
}
