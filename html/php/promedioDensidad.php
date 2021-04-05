<?php
if (!empty($_POST)) {

    require_once('../../conexion.php');
    $batch = $_POST['batch'];
    $sql = "SELECT AVG(densidad) as densidad FROM batch_control_especificaciones WHERE batch = :batch";
    $query = $conn->prepare($sql);
    $query->execute(['batch' => $batch]);
    $data = $query->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
}
