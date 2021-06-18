<?php

if (!empty($_POST)) {
    require_once('../../conexion.php');

    $equipos = $_POST['equipos'];

    foreach ($equipos as $equipo) {
        $sql = "INSERT INTO batch_equipos (equipo, referencia, batch, modulo) VALUES(:equipo, :referencia, :batch, :modulo)";
        $query = $conn->prepare($sql);
        $result = $query->execute(['equipo' => $equipo['equipo'], 'referencia' => $equipo['referencia'], 'batch' => $equipo['batch'], 'modulo' => $equipo['modulo']]);
        if ($result) echo 'true';
        else echo 'false';
    }
}
