<?php

function actualizarEstado($batch, $modulo, $conn)
{

    switch ($modulo) {
        case '2':
            $estado = 3.5;
            break;
        case '3':
            $estado = 4.5;
            break;
        case '4':
            $estado = 6.5;
            break;
        case '5':
            $estado = 6.5;
            break;
        case '6':
            $estado = 7.5;
            break;
    }

    //Modifica el estado de acuerdo con el modulo

    $sql = "UPDATE batch SET estado = :estado WHERE id_batch = :batch";
    $query = $conn->prepare($sql);
    $query->execute(['batch' => $batch, 'estado' => $estado]);
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

    $sql = "UPDATE batch SET estado = :estado WHERE id_batch = :batch";
    $query = $conn->prepare($sql);
    $query->execute(['batch' => $batch, 'estado' => $estado]);
}
