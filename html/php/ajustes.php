<?php
if (!empty($_POST)) {

    require_once('../../conexion.php');
    $batch = $_POST['batch'];
    $sql = "SELECT * FROM batch_req_ajuste WHERE id_batch = :batch";
    $query = $conn->prepare($sql);
    $query->execute(['batch' => $batch]);
    $data = $query->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
}
