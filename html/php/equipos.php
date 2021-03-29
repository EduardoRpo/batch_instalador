<?php

if (!empty($_POST)) {
    require_once('../../conexion.php');

    $equipos = $_POST['equipos'];

    foreach ($equipos as $equipo) {
        $sql = "INSERT INTO batch_equipos (equipo, batch, modulo) 
                            VALUES(:equipo, :batch, :modulo)";
        $query = $conn->prepare($sql);
        $result = $query->execute([
            'equipo' => $equipo['equipo'],
            'batch' => $equipo['batch'],
            'modulo' => $equipo['modulo'],
        ]);
    }
}
