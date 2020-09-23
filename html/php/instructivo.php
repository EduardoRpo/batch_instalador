<?php
require_once('../../conexion.php');
require_once('../../admin/sistema/php/crud.php');

//listar Condiciones del medio

$query = "SELECT * FROM instructivo_preparacion WHERE id_producto = :referencia";
$query = $conn->prepare($sql);
$result = $query->execute(['referencia' => $referencia]);

ejecutarQuery($result, $conn);
