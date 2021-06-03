<?php
require_once('../../../conexion.php');
$batch = $_POST['batch'];

if ($batch == 1) {
    $sql = "SELECT id_batch, id_modulo  FROM `batch_condicionesmedio` ORDER BY `batch_condicionesmedio`.`id_batch` ASC";
    $query = $conn->prepare($sql);
    $query->execute();
} else {
    $sql = "SELECT id_batch, id_modulo  FROM `batch_condicionesmedio` WHERE id_batch = :batch ORDER BY `batch_condicionesmedio`.`id_batch` ASC";
    $query = $conn->prepare($sql);
    $query->execute(['batch' => $batch]);
}

$data = $query->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($data, JSON_UNESCAPED_UNICODE);
