<?php
require_once('../../../conexion.php');
$batch = $_POST['batch'];

if ($batch == 1) {
    $sql = "SELECT id_batch, id_modulo  FROM `batch_condicionesmedio` ORDER BY `batch_condicionesmedio`.`id_batch` ASC";
    //$sql = "SELECT id_batch, IF(id_modulo=2, 1, 0) as pesaje, IF(id_modulo=3, 1, 0) as preparacion, IF(id_modulo=4, 1, 0) as aprobacion, IF(id_modulo=5, 1, 0) as envasado, IF(id_modulo=6, 1, 0) as acondicionamiento, IF(id_modulo=8, 1, 0) as microbiologia, IF(id_modulo=9, 1, 0) as fisicoquimico FROM `batch_condicionesmedio` ORDER BY `batch_condicionesmedio`.`id_batch` ASC";
    $query = $conn->prepare($sql);
    $query->execute();
} else {
    $sql = "SELECT id_batch, id_modulo  FROM `batch_condicionesmedio` WHERE id_batch = :batch ORDER BY `batch_condicionesmedio`.`id_batch` ASC";
    $query = $conn->prepare($sql);
    $query->execute(['batch' => $batch]);
}

$data = $query->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($data, JSON_UNESCAPED_UNICODE);
