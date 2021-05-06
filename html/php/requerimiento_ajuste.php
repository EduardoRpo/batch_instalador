<?php

/* Almacena los datos de requerimiento */

if (!empty($_POST)) {
    require_once('../../conexion.php');
    require_once('../../admin/sistema/php/crud.php');

    $materia_prima = $_POST['materia_prima'];
    $procedimiento = $_POST['procedimiento'];
    $modulo = $_POST['modulo'];
    $batch = $_POST['batch'];

    /* Buscar si existe un requerimiento para el batch */

    $sql = "SELECT * FROM batch_req_ajuste WHERE modulo = :modulo AND id_batch = :batch";
    $query = $conn->prepare($sql);
    $result = $query->execute(['modulo' => $modulo, 'batch' => $batch]);
    $rows = $query->rowCount();

    if ($rows > 0) {
        $sql = "UPDATE batch_req_ajuste SET materia_prima = :materia_prima, procedimiento = :procedimiento 
                WHERE modulo = :modulo AND id_batch = :batch)";
    } else {
        $sql = "INSERT INTO batch_req_ajuste (materia_prima, procedimiento, modulo, id_batch) 
                VALUES (:materia_prima, :procedimiento,:modulo, :batch)";
    }

    $query = $conn->prepare($sql);
    $result = $query->execute([
        'materia_prima' => $materia_prima, 'procedimiento' => $procedimiento, 'modulo' => $modulo, 'batch' => $batch,
    ]);

    if ($result) {
        echo '1';
    } else
        echo '0';
}
