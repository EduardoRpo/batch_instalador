<?php
require_once('../../conexion.php');

$sql = "SELECT referencia FROM producto";
$query = $conn->prepare($sql);
$query->execute();
$datos = $query->fetchAll(PDO::FETCH_ASSOC);

foreach ($datos as $dato) {
    $path = '../../html/img/referencias/' . $dato['referencia'] . '.jpg';
    //echo $path . '\n';

    $sql = "UPDATE producto SET img = :img  WHERE referencia = :referencia";
    $query = $conn->prepare($sql);
    $query->execute(['referencia' => $dato['referencia'], 'img' => $path]);
}
