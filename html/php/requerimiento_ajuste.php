<?php

/* Almacena los datos de requerimiento */

if (!empty($_POST)) {
    require_once('../../conexion.php');
    require_once('../../admin/sistema/php/crud.php');

    $materia_prima = $_POST['materia_prima'];
    $procedimiento = $_POST['procedimiento'];
    $modulo = $_POST['modulo'];
    $batch = $_POST['batch'];

    $sql = "INSERT INTO batch_req_ajuste (materia_prima, procedimiento, modulo, id_batch) 
            VALUES (:materia_prima, :procedimiento,:modulo, :batch)";
    $query = $conn->prepare($sql);
    $result = $query->execute([
        'materia_prima' => $materia_prima,
        'procedimiento' => $procedimiento,
        'modulo' => $modulo,
        'batch' => $batch,
    ]);

    if ($result) {
        echo '1';
    } else
        echo '0';
}

?>