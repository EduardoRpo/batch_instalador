<?php
function cierreExplosionMaterialesBatch($conn, $batch, $id_producto)
{

    $sql = "DELETE FROM explosion_materiales_batch WHERE batch = :batch AND id_producto = :id_producto";
    $query = $conn->prepare($sql);
    $query->execute(['batch' => $batch, 'id_producto' => $id_producto]);
}
