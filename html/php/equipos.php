<?php

if (!empty($_POST)) {
    require_once('../../conexion.php');

    $equipos = $_POST['equipos'];
    //$datos = json_decode($equipos, true);

    foreach ($equipos as $equipo) {
        $sql = "INSERT INTO batch_equipos (equipo, batch, modulo) 
                            VALUES (:equipo, :batch ,:modulo)";
        $query = $conn->prepare($sql);
        $result = $query->execute([
            'equipo' => $equipo[0],
            'modulo' => $equipo[1],
            'batch' => $equipo[2],
        ]);
    }

    if (!$result)
        exit();
}
