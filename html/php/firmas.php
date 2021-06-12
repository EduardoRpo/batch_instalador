<?php

require_once('./controlFirmas.php');

function desinfectante($conn, $desinfectante, $observaciones, $modulo, $batch, $realizo)
{
    $sql = "INSERT INTO batch_desinfectante_seleccionado (desinfectante, observaciones, modulo, batch, realizo) 
    VALUES(:desinfectante, :observaciones, :modulo, :batch, :realizo)";
    $query = $conn->prepare($sql);
    $result = $query->execute([
        'desinfectante' => $desinfectante,
        'observaciones' => $observaciones,
        'modulo' => $modulo,
        'batch' => $batch,
        'realizo' => $realizo,
    ]);
    //ejecutarQuery($result, $conn);
    registrarFirmas($conn, $batch, $modulo);
}

function segundaSeccionRealizo($conn, $observaciones, $realizo, $batch, $modulo)
{
    $sql = "INSERT INTO batch_firmas2seccion (observaciones, modulo, batch, realizo) 
            VALUES (:observaciones, :modulo, :batch, :realizo)";
    $query = $conn->prepare($sql);
    $result = $query->execute(['realizo' => $realizo, 'modulo' => $modulo, 'batch' => $batch, 'observaciones' => $observaciones]);
    registrarFirmas($conn, $batch, $modulo);
}

function segundaSeccionVerifico($conn, $realizo, $batch, $modulo)
{
    $sql = "UPDATE batch_firmas2seccion SET verifico =:firma WHERE modulo =:modulo AND batch =:batch";
    $query = $conn->prepare($sql);
    $query->execute(['firma' => $realizo, 'modulo' => $modulo, 'batch' => $batch,]);
}


function materialSobrante($conn, $material, $ref_producto, $batch, $modulo, $id_firma)
{
    foreach ($material as $valor) {
        $sql = "INSERT INTO batch_material_sobrante (ref_material, envasada, averias, sobrante, ref_producto, batch, modulo, realizo) 
                VALUES(:referencia, :envasada, :averias, :sobrante, :producto, :batch, :modulo, :realizo)";
        $query = $conn->prepare($sql);
        $result = $query->execute([
            'referencia' => $valor['referencia'],
            'envasada' => $valor['envasada'],
            'averias' => $valor['averias'],
            'sobrante' => $valor['sobrante'],
            'producto' => $ref_producto,
            'batch' => $batch,
            'modulo' => $modulo,
            'realizo' => $id_firma,
        ]);
    }
}

function conciliacionRendimiento($conn, $unidades, $retencion, $movimiento, $cajas, $batch, $modulo, $referencia, $entrego)
{
    $sql = "INSERT INTO batch_conciliacion_rendimiento 
                    SET unidades_producidas = :unidades, muestras_retencion = :retencion, mov_inventario = :movimiento, cajas = :cajas, 
                        batch = :batch, modulo = :modulo, ref_multi = :referencia, entrego = :entrego";
    $query = $conn->prepare($sql);
    $query->execute([
        'unidades' => $unidades,
        'retencion' => $retencion,
        'movimiento' => $movimiento,
        'cajas' => $cajas,
        'batch' => $batch,
        'modulo' => $modulo,
        'referencia' => $referencia,
        'entrego' => $entrego,
    ]);
}

function analisisMicrobiologiaRealizo()
{
}

function AnalisisMicrobiologiaVerifico($conn, $batch, $verifico)
{
    $sql = "UPDATE `batch_desinfectante_seleccionado` SET verifico = :verifico WHERE batch = :batch";
    $query = $conn->prepare($sql);
    $result = $query->execute(['verifico' => $verifico, 'batch' => $batch]);

    $sql = "UPDATE `batch_analisis_microbiologico` SET verifico = :verifico WHERE batch = :batch";
    $query = $conn->prepare($sql);
    $result = $query->execute(['verifico' => $verifico, 'batch' => $batch]);
}
