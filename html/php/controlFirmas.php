<?php

function registrarFirmas($conn, $batch, $modulo)
{
    /* Buscar si existen firmas registradas */

    $sql = "SELECT * FROM batch_control_firmas WHERE batch = :batch AND modulo = :modulo";
    $query = $conn->prepare($sql);
    $query->execute(['batch' => $batch, 'modulo' => $modulo]);
    $rows = $query->rowCount();

    if ($rows > 0) {
        $data = $query->fetchAll(PDO::FETCH_ASSOC);

        if (sizeof($data) > 0)
            $cantidad = $data[0]['cantidad_firmas'] + 1;
        else
            $cantidad = 1;

        $sql = "UPDATE batch_control_firmas SET cantidad_firmas = :cantidad 
                WHERE batch = :batch AND modulo = :modulo";
        $query = $conn->prepare($sql);
        $query->execute(['cantidad' => $cantidad, 'batch' => $batch, 'modulo' => $modulo]);
    }
}
