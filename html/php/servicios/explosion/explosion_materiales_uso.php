<?php

function registrarExplosionMaterialesUso($conn)
{

    $batch = $_POST['idBatch'];

    /* Inicio Batch para cargar informacion de pesaje materia prima */
    if ($batch < 600) exit();

    /* buscar la referencia del producto */

    $sql = "SELECT id_producto, tamano_lote FROM batch WHERE id_batch = :batch";
    $query = $conn->prepare($sql);
    $query->execute(['batch' => $batch]);
    $productoTamanio = $query->fetch(PDO::FETCH_ASSOC);

    /* busca la materia prima */

    $sql = "SELECT f.id, mp.referencia, cast(AES_DECRYPT(porcentaje, 'Wf[Ht^}2YL=D^DPD') as char)porcentaje 
            FROM formula f INNER JOIN materia_prima mp ON f.id_materiaprima = mp.referencia 
            WHERE f.id_producto = :id_producto";
    $query = $conn->prepare($sql);
    $query->execute(['id_producto' => $productoTamanio['id_producto']]);
    $materiales = $query->fetchAll(PDO::FETCH_ASSOC);

    /* Calcula la cantidad de materia prima */

    foreach ($materiales as $material) {
        $tanques = $_POST['tanques'];
        $cantidad = (($material['porcentaje'] / 100) * $productoTamanio['tamano_lote']) / $tanques;

        $sql = "SELECT * FROM batch_explosion_materiales WHERE batch = :batch AND id_producto = :id_producto AND id_materiaprima = :id_materia_prima";
        $query = $conn->prepare($sql);
        $query->execute([
            'batch' => $batch,
            'id_producto' => $productoTamanio['id_producto'],
            'id_materia_prima' => $material['referencia']
        ]);
        $rows = $query->rowCount();

        if ($rows > 0) {
            $materia_prima = $query->fetch(PDO::FETCH_ASSOC);

            $cantidadUsoOld = floatval($materia_prima['uso']);
            $cantidadUsoNueva = $cantidad + $cantidadUsoOld;

            /* Actualiza */

            $sql = "UPDATE batch_explosion_materiales SET uso = :uso WHERE batch = :batch AND id_producto = :id_producto AND id_materiaprima = :id_materia_prima";
            $query = $conn->prepare($sql);
            $query->execute([
                'uso' => $cantidadUsoNueva,
                'id_producto' => $productoTamanio['id_producto'],
                'batch' => $batch,
                'id_materia_prima' => $material['referencia']
            ]);
        } /* else {
            $sql = "INSERT INTO batch_explosion_materiales (id_materiaprima, cantidad) 
                    VALUES(:id_materiaprima, :cantidad)";
            $query = $conn->prepare($sql);
            $query->execute(['id_materia_prima' => $material['id_materiaprima'], 'uso' => $cantidad]);
        } */
    }
}
