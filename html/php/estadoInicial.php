<?php

function estadoInicial($conn, $referencia, $fechaprogramacion)
{
    /* validar que exista la formula*/
    $query_buscarFormula =  mysqli_query($conn, "SELECT * FROM formula WHERE id_producto = '$referencia'");
    $resultFormula = mysqli_num_rows($query_buscarFormula);

    /* validar que exista el instructivo */
    $query_buscarInstructivo =  mysqli_query($conn, "SELECT * FROM instructivo_preparacion WHERE id_producto = '$referencia'");
    $resultPreparacionInstructivos = mysqli_num_rows($query_buscarInstructivo);

    /* si el instructivo no existe valida que exista el instructivo en Bases*/
    if ($resultPreparacionInstructivos == 0) {
        $query_buscarInstructivo =  mysqli_query($conn, "SELECT instructivo FROM producto WHERE referencia = '$referencia'");
        $resultPreparacion = mysqli_fetch_assoc($query_buscarInstructivo);
        $resultPreparacionInstructivos = $resultPreparacion['instructivo'];
    }

    /* consolida resultados */
    $result = $resultFormula * $resultPreparacionInstructivos;

    /* Asigna el estado de acuerdo con el resultado */
    if ($result === 0) {
        $estado = '1';  //Sin formula
        $fechaprogramacion = '';
    }

    if ($result > 0 && $fechaprogramacion == '') {
        $estado = '2'; // Inactivo  
    }

    if ($result > 0 && $fechaprogramacion != '') {
        $estado = '3';  //Pesaje
    }
    return array($estado, $fechaprogramacion);
}
