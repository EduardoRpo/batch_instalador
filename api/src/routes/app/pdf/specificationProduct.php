<?php

function specificationProduct($hojaDatosBatch, $productDao, $ref)
{
    $encabezado = [
        "Referencia", "Nombre Referencia",
        "Color", "Olor",
        "Apariencia", "Viscosidad",
        "Densidad", "Untuosidad",
        "Espumoso", "Alcohol",
        "PH", "Mesofilos",
        "Pseudomona", "Escherichia",
        "Staphylococcus",
    ];

    $hojaDatosBatch->fromArray($encabezado, null, 'A22');
    $product = $productDao->findDetailsByProduct($ref);

    $row = 23;

    $reference = $product['referencia'];
    $name_reference = $product['nombre_referencia'];
    $color = $product['color'];
    $olor = $product['olor'];
    $appearance = $product['apariencia'];
    $viscosidad_li = $product['limite_inferior_viscosidad'];
    $viscosidad_ls = $product['limite_superior_viscosidad'];
    $densidad_li = $product['limite_inferior_densidad_gravedad'];
    $densidad_ls = $product['limite_superior_densidad_gravedad'];
    $untuosidad = $product['untuosidad'];
    $espumoso = $product['poder_espumoso'];
    $alcohol_li = $product['limite_inferior_grado_alcohol'];
    $alcohol_ls = $product['limite_superior_grado_alcohol'];
    $ph_li = $product['limite_inferior_ph'];
    $ph_ls = $product['limite_superior_ph'];
    $mesofilos = $product['mesofilos'];
    $pseudomona = $product['pseudomona'];
    $escherichia = $product['escherichia'];
    $staphylococcus = $product['staphylococcus'];

    $hojaDatosBatch->setCellValueByColumnAndRow(1, $row, $reference);
    $hojaDatosBatch->setCellValueByColumnAndRow(2, $row, $name_reference);
    $hojaDatosBatch->setCellValueByColumnAndRow(3, $row, $color);
    $hojaDatosBatch->setCellValueByColumnAndRow(4, $row, $olor);
    $hojaDatosBatch->setCellValueByColumnAndRow(5, $row, $appearance);
    $hojaDatosBatch->setCellValueByColumnAndRow(6, $row, $viscosidad_li);
    $hojaDatosBatch->setCellValueByColumnAndRow(7, $row, $viscosidad_ls);
    $hojaDatosBatch->setCellValueByColumnAndRow(8, $row, $densidad_li);
    $hojaDatosBatch->setCellValueByColumnAndRow(9, $row, $densidad_ls);
    $hojaDatosBatch->setCellValueByColumnAndRow(10, $row, $untuosidad);
    $hojaDatosBatch->setCellValueByColumnAndRow(11, $row, $espumoso);
    $hojaDatosBatch->setCellValueByColumnAndRow(12, $row, $alcohol_li);
    $hojaDatosBatch->setCellValueByColumnAndRow(13, $row, $alcohol_ls);
    $hojaDatosBatch->setCellValueByColumnAndRow(14, $row, $ph_li);
    $hojaDatosBatch->setCellValueByColumnAndRow(15, $row, $ph_ls);
    $hojaDatosBatch->setCellValueByColumnAndRow(16, $row, $mesofilos);
    $hojaDatosBatch->setCellValueByColumnAndRow(17, $row, $pseudomona);
    $hojaDatosBatch->setCellValueByColumnAndRow(18, $row, $escherichia);
    $hojaDatosBatch->setCellValueByColumnAndRow(19, $row, $staphylococcus);
    $row++;

    return $hojaDatosBatch;
}
