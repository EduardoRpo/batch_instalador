<?php

function actualizarEstado($batch, $modulo, $conn)
{

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
        case '5': //envasado
            $estado = 7;
            break;
        case '6': //acondicionamiento
            $estado = 7.5;
            break;
        case '7': //despachos
            $estado = 8.5;
            break;
        case '8': //microbiologico
            $estado = 8.5;
            break;
        case '9': //fisicoquimico
            $estado = 8.5;
            break;
        case '10': //liberacion lote
            $estado = 8.5;
            break;
    }

    //Modifica el estado de acuerdo con el modulo
    ActualizarBatchEstado($conn, $batch, $estado);
}

function cerrarEstado($batch, $modulo, $conn)
{

    switch ($modulo) {
        case '2':
            $estado = 4;
            break;
        case '3':
            $estado = 5;
            break;
        case '4':
            $estado = 6;
            break;
        case '5':
            $estado = 7;
            break;
        case '6':
            $estado = 8;
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
