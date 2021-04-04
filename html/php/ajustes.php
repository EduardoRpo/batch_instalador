<?php
if (!empty($_POST)) {

    require_once('../../conexion.php');

    $sql = "SELECT * FROM batch_req_ajuste";
    $query = $conn->prepare($sql);
    $query->execute();
    $data = $query->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
}
