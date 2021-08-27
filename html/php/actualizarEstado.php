<?php

function actualizarEstado($batch, $modulo, $conn)
{

    $modulo == 6 ? $modulo = 5 : $modulo;
    $modulo == 8 || $modulo == 9 ? $modulo = 7 : $modulo;

    switch ($modulo) {

        case '2': //pesaje
            $estado = 3.5;
            break;
        case '3': //preparacion
            $estado = 4.5;
            break;
        case '4': //aprobacion
            $estado = 5.5;
            break;
        case '5': //envasado, acondicionamiento
            $estado = 6.5;
            break;
        case '6': //despachos
            $estado = 7.5;
            break;
        case '7': //Microbiologia y Acondicionamiento
            $estado = 8.5;
            break;
    }

    //Modifica el estado de acuerdo con el modulo
    ActualizarBatchEstado($conn, $batch, $estado);
}

function cerrarEstado($batch, $modulo, $conn)
{

    //$modulo == 6 || $modulo == 7 ? $modulo = 5 : $modulo;
    $modulo == 8 || $modulo == 9 ? $modulo = 6 : $modulo;

    switch ($modulo) {
        case '2': // pesaje
            $estado = 4;
            break;
        case '3': // Preparacion
            $estado = 5;
            break;
        case '4': // Aprobacion
            $estado = 6;
            break;
        case '5': //Envasado, Acondicionamiento
            $estado = 7;
            break;
        case '6': // Despachos
            $estado = 8;
            break;
        case '7': // Microbiologia y FisicoQuimico
            $estado = 9;
            break;
        case '10': // Liberacion Lote
            $estado = 9;
            break;
    }

    //Modifica el estado de acuerdo con el modulo
    ActualizarBatchEstado($conn, $batch, $estado);
}

function ActualizarBatchEstado($conn, $batch, $estado)
{
    $sql = "UPDATE batch SET estado = :estado WHERE id_batch = :batch";
    $query = $conn->prepare($sql);
    $query->execute(['estado' => $estado, 'batch' => $batch]);
}

function CerrarBatch($conn, $batch)
{
    $sql = "SELECT SUM(cantidad_firmas) as cantidad FROM `batch_control_firmas` WHERE batch = :batch";
    $query = $conn->prepare($sql);
    $query->execute(['batch' => $batch]);
    $firmas = $query->fetch(PDO::FETCH_ASSOC);
    
    if ($firmas['cantidad'] == 28) {
        $sql = "UPDATE batch SET estado = '10' WHERE id_batch = :batch";
        $query = $conn->prepare($sql);
        $query->execute(['batch' => $batch]);
    }
}
