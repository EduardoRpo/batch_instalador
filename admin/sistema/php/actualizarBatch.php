<?php

function ActualizarBatch($conn, $result, $id_producto)
{
    $estado = $result['estado'];
    $sql = "UPDATE batch SET estado = $estado WHERE id_producto = :referencia";
    $query = $conn->prepare($sql);
    $result = $query->execute(['referencia' => $id_producto]);
    return $result;
}
