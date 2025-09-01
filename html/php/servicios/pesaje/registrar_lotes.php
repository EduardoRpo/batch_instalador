<?php

function registrarLotes($conn)
{

    $lotes = $_POST['lotes'];

    foreach ($lotes as $lote) {
        $sql = "INSERT INTO batch_lote_materiales (ref_material, lote, cantidad_pesada, tanque, batch) VALUES (:ref_material, :lote, :cantidad_pesada, :tanque, :batch)";
        $query = $conn->prepare($sql);
        $query->execute([
            'ref_material' => $lote['referenciaMP'], 
            'lote' => $lote['lote'], 
            'cantidad_pesada' => $lote['cantidad_pesada'] ?? null,
            'tanque' => $lote['tanque'], 
            'batch' => $lote['batch']
        ]);
    }
}
