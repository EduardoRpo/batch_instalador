<?php
function cierreExplosionMaterialesBatch($conn, $batch, $id_producto)
{

    $sql = "DELETE FROM batch_explosion_materiales WHERE batch = :batch AND id_producto = :id_producto";
    $query = $conn->prepare($sql);
    $query->execute(['batch' => $batch, 'id_producto' => $id_producto]);
}
