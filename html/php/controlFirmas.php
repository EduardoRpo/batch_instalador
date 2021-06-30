<?php

function registrarFirmas($conn, $batch, $modulo)
{
    $sql = "SELECT * FROM batch_control_firmas WHERE batch = :batch AND modulo = :modulo";
    $query = $conn->prepare($sql);
    $query->execute(['batch' => $batch, 'modulo' => $modulo]);
    $rows = $query->rowCount();

    if ($rows > 0) {
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        $cantidad = $data[0]['cantidad_firmas'] + 1;
        $sql = "UPDATE batch_control_firmas SET cantidad_firmas = :cantidad WHERE batch = :batch AND modulo = :modulo";
        $query = $conn->prepare($sql);
        $query->execute(['cantidad' => $cantidad, 'batch' => $batch, 'modulo' => $modulo]);
    } else {
        $sql = "INSERT INTO batch_control_firmas (modulo, batch, cantidad_firmas) VALUES(:modulo, :batch, :cantidad_firmas)";
        $query = $conn->prepare($sql);
        $query->execute(['modulo' => $modulo, 'batch' => $batch, 'cantidad_firmas' => 1]);
    }
}
