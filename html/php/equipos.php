<?php

if (!empty($_POST)) {
    require_once('../../conexion.php');

    $equipos = $_POST['equipos'];

    $sql = "SELECT * FROM batch_equipos 
            WHERE referencia = :referencia AND batch = :batch AND modulo = :modulo";
    $query = $conn->prepare($sql);
    $query->execute(['referencia' => $equipos[0]['referencia'], 'batch' => $equipos[0]['batch'], 'modulo' => $equipos[0]['modulo']]);
    $rows = $query->rowCount();

    if ($rows == 0) {
        foreach ($equipos as $equipo) {
            $sql = "INSERT INTO batch_equipos (equipo, referencia, batch, modulo) VALUES(:equipo, :referencia, :batch, :modulo)";
            $query = $conn->prepare($sql);
            $result = $query->execute(['equipo' => $equipo['equipo'], 'referencia' => $equipo['referencia'], 'batch' => $equipo['batch'], 'modulo' => $equipo['modulo']]);
        }
        if ($result) echo true;
        else echo false;
    } else echo true;
}
