<?php

//require_once('../../conexion.php');
require_once('./controlFirmas.php');
require_once('./actualizarEstado.php');


function desinfectanteRealizo($conn)
{
    $batch = $_POST['idBatch'];
    $modulo = $_POST['modulo'];

    $sql = "SELECT * FROM batch_desinfectante_seleccionado WHERE modulo = :modulo AND batch = :batch";
    $query = $conn->prepare($sql);
    $query->execute(['modulo' => $modulo, 'batch' => $batch]);
    $rows = $query->rowCount();

    if ($rows == 0) {

        if ($modulo == 8)
            $dataMicrobiologia = $_POST['dataMicro'];

        $modulo == 8 ? $desinfectante = $dataMicrobiologia[0]["desinfectante"] : $desinfectante = $_POST['desinfectante'];
        $modulo == 8 ? $obs_desinfectante = $dataMicrobiologia[0]["desinfectante_observaciones"] : $obs_desinfectante = $_POST['obs_desinfectante'];
        $realizo = $_POST['realizo'];
        $verifico = '0';

        $sql = "INSERT INTO batch_desinfectante_seleccionado (desinfectante, observaciones, modulo, batch, realizo, verifico) 
        VALUES(:desinfectante, :observaciones, :modulo, :batch, :realizo, :verifico)";
        $query = $conn->prepare($sql);
        $query->execute(['desinfectante' => $desinfectante, 'observaciones' => $obs_desinfectante, 'modulo' => $modulo, 'batch' => $batch, 'realizo' => $realizo, 'verifico' => $verifico]);
        registrarFirmas($conn, $batch, $modulo);
    }
}


function desinfectanteVerifico($conn)
{
    $batch = $_POST['idBatch'];
    $modulo = $_POST['modulo'];

    $sql = "SELECT * FROM batch_desinfectante_seleccionado WHERE modulo = :modulo AND batch = :batch";
    $query = $conn->prepare($sql);
    $query->execute(['modulo' => $modulo, 'batch' => $batch]);
    $rows = $query->rowCount();

    if ($rows > 0) {
        $verifico = $_POST['verifico'];
        $sql = "UPDATE batch_desinfectante_seleccionado SET verifico = :verifico WHERE batch = :batch AND modulo = :modulo";
        $query = $conn->prepare($sql);
        $query->execute(['modulo' => $modulo, 'batch' => $batch, 'verifico' => $verifico]);
        registrarFirmas($conn, $batch, $modulo);
    }
}



function segundaSeccionRealizo($conn)
{
    //require_once('../../conexion.php');

    $batch = $_POST['idBatch'];
    $modulo = $_POST['modulo'];

    if ($modulo == 5 || $modulo == 6) {
        $ref_multi = $_POST['ref_multi'];
        $sql = "SELECT * FROM batch_firmas2seccion WHERE modulo = :modulo AND batch = :batch AND ref_multi = :ref_multi";
        $query = $conn->prepare($sql);
        $query->execute(['modulo' => $modulo, 'batch' => $batch, 'ref_multi' => $ref_multi]);
        $rows = $query->rowCount();
    } else {

        $sql = "SELECT * FROM batch_firmas2seccion WHERE modulo = :modulo AND batch = :batch";
        $query = $conn->prepare($sql);
        $query->execute(['modulo' => $modulo, 'batch' => $batch]);
        $rows = $query->rowCount();
    }

    if ($rows == 0) {
        $modulo == 4 || $modulo == 9 ? $observaciones = $_POST['obs_batch'] : $observaciones = "";
        $modulo == 5 || $modulo == 6 ? $ref_multi = $_POST['ref_multi'] : $ref_multi = "";
        $realizo = $_POST['realizo'];
        $verifico = '0';

        $sql = "INSERT INTO batch_firmas2seccion (observaciones, ref_multi, modulo, batch, realizo, verifico) 
                VALUES (:observaciones, :ref_multi, :modulo, :batch, :realizo, :verifico)";
        $query = $conn->prepare($sql);
        $query->execute(['observaciones' => $observaciones, 'ref_multi' => $ref_multi, 'realizo' => $realizo, 'verifico' => $verifico, 'modulo' => $modulo, 'batch' => $batch]);
        registrarFirmas($conn, $batch, $modulo);
        
    }
}

function segundaSeccionVerifico($conn)
{
    $batch = $_POST['idBatch'];
    $modulo = $_POST['modulo'];

    $sql = "SELECT * FROM batch_firmas2seccion WHERE modulo = :modulo AND batch = :batch";
    $query = $conn->prepare($sql);
    $query->execute(['modulo' => $modulo, 'batch' => $batch]);
    $rows = $query->rowCount();

    if ($rows > 0) {
        $verifico = $_POST['verifico'];

        if ($modulo == 5 || $modulo == 6) {
            $ref_multi = $_POST['ref_multi'];
            $sql = "UPDATE batch_firmas2seccion SET verifico = :verifico WHERE modulo = :modulo AND batch = :batch AND ref_multi = :ref_multi";
            $query = $conn->prepare($sql);
            $query->execute(['verifico' => $verifico, 'modulo' => $modulo, 'batch' => $batch, 'ref_multi' => $ref_multi,]);
        } else {
            $ref_multi = 0;
            $sql = "UPDATE batch_firmas2seccion SET verifico = :verifico WHERE modulo = :modulo AND batch = :batch";
            $query = $conn->prepare($sql);
            $query->execute(['verifico' => $verifico, 'modulo' => $modulo, 'batch' => $batch]);
        }

        registrarFirmas($conn, $batch, $modulo);
        if ($modulo == 2 || $modulo == 3 || $modulo == 4) cerrarEstado($batch, $modulo, $conn);
    }
}


function materialSobranteRealizo($conn)
{

    $batch = $_POST['idBatch'];
    $modulo = $_POST['modulo'];

    if ($modulo == 5 || $modulo == 6) {
        $referencia = $_POST['ref_multi'];
        $sql = "SELECT * FROM batch_material_sobrante WHERE modulo = :modulo AND batch = :batch AND ref_producto = :referencia";
        $query = $conn->prepare($sql);
        $query->execute(['modulo' => $modulo, 'batch' => $batch, 'referencia' => $referencia]);
        $rows = $query->rowCount();
    } else {
        $sql = "SELECT * FROM batch_material_sobrante WHERE modulo = :modulo AND batch = :batch";
        $query = $conn->prepare($sql);
        $query->execute(['modulo' => $modulo, 'batch' => $batch]);
        $rows = $query->rowCount();
    }

    if ($rows == 0) {

        $material = $_POST['materialsobrante'];
        $ref_producto = $_POST['ref_multi'];
        $realizo = $_POST['realizo'];
        $verifico = 0;

        foreach ($material as $valor) {
            $sql = "INSERT INTO batch_material_sobrante (ref_material, envasada, averias, sobrante, ref_producto, batch, modulo, realizo, verifico) 
                VALUES(:referencia, :envasada, :averias, :sobrante, :producto, :batch, :modulo, :realizo, :verifico)";
            $query = $conn->prepare($sql);
            $query->execute([
                'referencia' => $valor['referencia'],
                'envasada' => $valor['envasada'],
                'averias' => $valor['averias'],
                'sobrante' => $valor['sobrante'],
                'producto' => $ref_producto,
                'batch' => $batch,
                'modulo' => $modulo,
                'realizo' => $realizo,
                'verifico' => $verifico
            ]);
        }
        registrarFirmas($conn, $batch, $modulo);
    }
}


function materialSobranteVerifico($conn)
{

    $modulo = $_POST['modulo'];
    $batch = $_POST['idBatch'];

    $sql = "SELECT * FROM batch_material_sobrante WHERE modulo = :modulo AND batch = :batch";
    $query = $conn->prepare($sql);
    $query->execute(['modulo' => $modulo, 'batch' => $batch]);
    $rows = $query->rowCount();

    if ($rows > 0) {
        $ref_multi = $_POST['ref_multi'];
        $verifico = $_POST['verifico'];

        $sql = "UPDATE batch_material_sobrante SET verifico = :verifico WHERE batch = :batch AND modulo = :modulo AND ref_producto = :ref_multi";
        $query = $conn->prepare($sql);
        $query->execute(['modulo' => $modulo, 'batch' => $batch, 'ref_multi' => $ref_multi, 'verifico' => $verifico,]);
        registrarFirmas($conn, $batch, $modulo);
    }
}

function conciliacionRendimientoRealizo($conn)
{

    $batch =  $_POST['idBatch'];
    $modulo =  $_POST['modulo'];
    $referencia = $_POST['ref_multi'];

    $sql = "SELECT * FROM batch_conciliacion_rendimiento WHERE modulo = :modulo AND batch = :batch AND ref_multi = :referencia";
    $query = $conn->prepare($sql);
    $query->execute(['modulo' => $modulo, 'batch' => $batch, 'referencia' => $referencia]);
    $rows = $query->rowCount();

    if ($rows == 0) {
        $unidades =  $_POST['unidades'];
        $retencion =  $_POST['retencion'];
        $movimiento =  $_POST['mov'];
        $cajas = $_POST['cajas'];
        $modulo = $_POST['modulo'];
        $realizo = $_POST['realizo'];

        $sql = "INSERT INTO batch_conciliacion_rendimiento 
                SET unidades_producidas = :unidades, muestras_retencion = :retencion, mov_inventario = :movimiento, cajas = :cajas, 
                    batch = :batch, modulo = :modulo, ref_multi = :referencia, entrego = :realizo";
        $query = $conn->prepare($sql);
        $query->execute([
            'unidades' => $unidades,
            'retencion' => $retencion,
            'movimiento' => $movimiento,
            'cajas' => $cajas,
            'batch' => $batch,
            'modulo' => $modulo,
            'referencia' => $referencia,
            'realizo' => $realizo,
        ]);
        registrarFirmas($conn, $batch, $modulo);
    }
}

function analisisMicrobiologiaRealizo($conn)
{
    $modulo = $_POST['modulo'];
    $batch = $_POST['idBatch'];

    $sql = "SELECT * FROM batch_analisis_microbiologico WHERE modulo = :modulo AND batch = :batch";
    $query = $conn->prepare($sql);
    $query->execute(['modulo' => $modulo, 'batch' => $batch]);
    $rows = $query->rowCount();

    if ($rows == 0) {

        $dataMicrobiologia = $_POST['dataMicro'];
        $realizo = $_POST['realizo'];

        $sql = "INSERT INTO `batch_analisis_microbiologico`(mesofilos, pseudomona, escherichia, staphylococcus, fecha_siembra, fecha_resultados, observaciones, realizo, batch, modulo) 
        VALUES(:mesofilos, :pseudomona, :escherichia, :staphylococcus, :fecha_siembra, :fecha_resultados, :observaciones, :realizo, :batch, :modulo)";
        $query = $conn->prepare($sql);
        $query->execute([
            'mesofilos' => $dataMicrobiologia[0]["mesofilos"],
            'pseudomona' => $dataMicrobiologia[0]["pseudomona"],
            'escherichia' => $dataMicrobiologia[0]["escherichia"],
            'staphylococcus' => $dataMicrobiologia[0]["staphylococcus"],
            'fecha_siembra' => $dataMicrobiologia[0]["fechaSiembra"],
            'fecha_resultados' => $dataMicrobiologia[0]["fechaResultados"],
            'observaciones' => $dataMicrobiologia[0]["observaciones"],
            'realizo' => $realizo,
            'batch' => $batch,
            'modulo' => $modulo
        ]);
        registrarFirmas($conn, $batch, $modulo);
    }
}

function AnalisisMicrobiologiaVerifico($conn)
{
    $batch = $_POST['idBatch'];

    $sql = "SELECT * FROM batch_analisis_microbiologico WHERE batch = :batch";
    $query = $conn->prepare($sql);
    $query->execute(['batch' => $batch]);
    $rows = $query->rowCount();

    if ($rows > 0) {
        $verifico = $_POST['verifico'];
        $modulo = $_POST['modulo'];

        $sql = "UPDATE `batch_analisis_microbiologico` SET verifico = :verifico WHERE batch = :batch";
        $query = $conn->prepare($sql);
        $query->execute(['verifico' => $verifico, 'batch' => $batch]);
        registrarFirmas($conn, $batch, $modulo);
    }
}
