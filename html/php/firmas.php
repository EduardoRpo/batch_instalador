<?php

//require_once('../../conexion.php');
require_once('./controlFirmas.php');
require_once('./actualizarEstado.php');
require_once '../php/servicios/explosion/cierre_explosion_materiales_batch.php';


function desinfectanteRealizo($conn) // DesinfectanteSeleccionadoDao.php
{
    $batch = $_POST['idBatch'];
    $modulo = $_POST['modulo'];

    $sql = "SELECT * FROM batch_desinfectante_seleccionado WHERE modulo = :modulo AND batch = :batch";
    $query = $conn->prepare($sql);
    $query->execute(['modulo' => $modulo, 'batch' => $batch]);
    $rows = $query->rowCount();

    if ($rows == 0) {

        if ($modulo == 8)
            $dataMicrobiologia = json_decode($_POST['dataMicro'], true);

        $modulo == 8 ? $desinfectante = $dataMicrobiologia[0]["desinfectante"] : $desinfectante = $_POST['desinfectante'];
        $modulo == 8 ? $obs_desinfectante = $dataMicrobiologia[0]["observaciones"] : $obs_desinfectante = $_POST['obs_desinfectante'];
        $realizo = $_POST['realizo'];
        $verifico = '0';

        $sql = "INSERT INTO batch_desinfectante_seleccionado (desinfectante, observaciones, modulo, batch, realizo, verifico) 
                VALUES(:desinfectante, :observaciones, :modulo, :batch, :realizo, :verifico)";
        $query = $conn->prepare($sql);
        $result = $query->execute(['desinfectante' => $desinfectante, 'observaciones' => $obs_desinfectante, 'modulo' => $modulo, 'batch' => $batch, 'realizo' => $realizo, 'verifico' => $verifico]);

        if ($modulo != 4 && $modulo != 8 && $modulo != 9 && $result)
            registrarFirmas($conn, $batch, $modulo);
    }
}


function desinfectanteVerifico($conn) // DesinfectanteSeleccionadoDao.php
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
        $result = $query->execute(['modulo' => $modulo, 'batch' => $batch, 'verifico' => $verifico]);

        if ($modulo != 4 && $modulo != 8 && $modulo != 9 && $result)
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
        $result = $query->execute(['observaciones' => $observaciones, 'ref_multi' => $ref_multi, 'realizo' => $realizo, 'verifico' => $verifico, 'modulo' => $modulo, 'batch' => $batch]);

        if ($result)
            registrarFirmas($conn, $batch, $modulo);
    }
}

function segundaSeccionVerifico($conn) // Firmas2SeccionDao.php
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
            $result = $query->execute(['verifico' => $verifico['id'], 'modulo' => $modulo, 'batch' => $batch, 'ref_multi' => $ref_multi,]);
        } else {
            $ref_multi = 0;
            $sql = "UPDATE batch_firmas2seccion SET verifico = :verifico WHERE modulo = :modulo AND batch = :batch";
            $query = $conn->prepare($sql);
            $result = $query->execute(['verifico' => $verifico, 'modulo' => $modulo, 'batch' => $batch]);
        }

        if ($result)
            registrarFirmas($conn, $batch, $modulo);

        if ($modulo == 2 || $modulo == 3 || $modulo == 4)
            cerrarEstado($batch, $modulo, $conn);

        /* Elimina los registros en explosion de materiales */
        /* if ($modulo == 2) {
            $sql = "SELECT id_producto FROM batch WHERE id_batch = :id_batch";
            $query = $conn->prepare($sql);
            $query->execute(['id_batch' => $batch]);
            $referencia = $query->fetch(PDO::FETCH_ASSOC);
            cierreExplosionMaterialesBatch($conn, $batch, $referencia['id_producto']);
        } */
        CerrarBatch($conn, $batch);
    }
}


function materialSobranteRealizo($conn) // MaterialSobranteDao.php
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
            $result = $query->execute([
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

        if ($result)
            registrarFirmas($conn, $batch, $modulo);
    }
}


function materialSobranteVerifico($conn) // MaterialSobranteDao.php
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
        $result = $query->execute(['modulo' => $modulo, 'batch' => $batch, 'ref_multi' => $ref_multi, 'verifico' => $verifico,]);

        if ($result)
            registrarFirmas($conn, $batch, $modulo);

        CerrarBatch($conn, $batch);
    }
}

function conciliacionRendimientoRealizo($conn) // ConciliacionDao.php
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
        $modulo == 6 ? $retencion =  $_POST['retencion'] : $retencion = 0;
        $movimiento =  $_POST['mov'];
        $cajas = $_POST['cajas'];
        $modulo = $_POST['modulo'];
        $realizo = $_POST['realizo'];
        $entrega_final = $_POST['entrega_final'];

        $sql = "SELECT SUM(unidades) as unidades FROM batch_conciliacion_parciales WHERE modulo =:modulo AND batch = :batch AND ref_multi = :ref_multi";
        $query = $conn->prepare($sql);
        $query->execute(['modulo' => $modulo, 'batch' => $batch, 'ref_multi' => $referencia]);
        $data = $query->fetch(PDO::FETCH_ASSOC);

        $sql = "INSERT INTO batch_conciliacion_parciales (unidades, cajas, movimiento, modulo, batch, ref_multi, realizo, entrega_final)
                VALUES(:unidades, :cajas, :movimiento, :modulo, :batch, :ref_multi, :realizo, :entrega_final)";
        $query = $conn->prepare($sql);
        $query->execute([
            'unidades' => $unidades,
            'cajas' => $cajas,
            'movimiento' => $movimiento,
            'modulo' => $modulo,
            'batch' => $batch,
            'ref_multi' => $referencia,
            'realizo' => $realizo,
            'entrega_final' => $entrega_final,

        ]);

        // proceso por recalculo de parciales de datos ingresados antes de la creacion de la función

        if ($modulo == 7 && $batch < 131) {
            $sql = "INSERT INTO batch_conciliacion_parciales (unidades, cajas, movimiento, modulo, batch, ref_multi, realizo) 
                    VALUES(:unidades, :cajas, :movimiento, :modulo, :batch, :ref_multi, :realizo)";
            $query = $conn->prepare($sql);
            $query->execute([
                'unidades' => $unidades,
                'cajas' => $cajas,
                'movimiento' => $movimiento,
                'modulo' => 6,
                'batch' => $batch,
                'ref_multi' => $referencia,
                'realizo' => $realizo
            ]);
        }



        $unidades = intval($unidades) + intval($data['unidades']);

        $sql = "INSERT INTO batch_conciliacion_rendimiento 
                SET unidades_producidas = :unidades, muestras_retencion = :retencion, mov_inventario = :movimiento, cajas = :cajas, 
                    batch = :batch, modulo = :modulo, ref_multi = :referencia, entrego = :realizo";
        $query = $conn->prepare($sql);
        $result = $query->execute([
            'unidades' => $unidades,
            'retencion' => $retencion,
            'movimiento' => $movimiento,
            'cajas' => $cajas,
            'batch' => $batch,
            'modulo' => $modulo,
            'referencia' => $referencia,
            'realizo' => $realizo,
        ]);

        if ($result)
            registrarFirmas($conn, $batch, $modulo);

        CerrarBatch($conn, $batch);
    }
}

function analisisMicrobiologiaRealizo($conn) // AnalisisMicrobiologicoDao.php
{
    $modulo = $_POST['modulo'];
    $batch = $_POST['idBatch'];
    $realizo = $_POST['realizo'];
    $dataMicrobiologia = json_decode($_POST['dataMicro'], true);

    for ($i = 2; $i < sizeof($dataMicrobiologia); $i++) {
        $sql = "INSERT INTO `batch_analisis_microbiologico`(mesofilos, pseudomona, escherichia, staphylococcus, fecha_siembra, fecha_resultados, realizo, referencia, batch, modulo) 
                    VALUES(:mesofilos, :pseudomona, :escherichia, :staphylococcus, :fecha_siembra, :fecha_resultados, :realizo, :referencia, :batch, :modulo)";
        $query = $conn->prepare($sql);
        $query->execute([
            'mesofilos' => $dataMicrobiologia[$i]["mesofilos"],
            'pseudomona' => $dataMicrobiologia[$i]["pseudomona"],
            'escherichia' => $dataMicrobiologia[$i]["escherichia"],
            'staphylococcus' => $dataMicrobiologia[$i]["staphylococcus"],
            'fecha_siembra' => $dataMicrobiologia[$i]["fechaSiembra"],
            'fecha_resultados' => $dataMicrobiologia[$i]["fechaResultados"],
            'referencia' => $dataMicrobiologia[$i]["referencia"],
            'realizo' => $realizo,
            'batch' => $batch,
            'modulo' => $modulo
        ]);
    }

    $sql = "SELECT * FROM `batch_analisis_microbiologico` WHERE batch = :batch AND modulo = :modulo";
    $query = $conn->prepare($sql);
    $query->execute(['batch' => $batch, 'modulo' => $modulo]);
    $cantMicro = $query->rowCount();

    $sql = "SELECT * FROM `multipresentacion` WHERE id_batch = :batch";
    $query = $conn->prepare($sql);
    $result = $query->execute(['batch' => $batch]);
    $cantMulti = $query->rowCount();

    /* Validacion referencia sin multipresentacion */
    if ($cantMulti == 0) $cantMulti = 1;

    if ($cantMicro == $cantMulti)
        echo '1';

    if ($result)
        registrarFirmas($conn, $batch, $modulo);
}

function AnalisisMicrobiologiaVerifico($conn) // AnalisisMicrobiologicoDao.php
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
        $result = $query->execute(['verifico' => $verifico, 'batch' => $batch]);

        if ($result)
            registrarFirmas($conn, $batch, $modulo);

        CerrarBatch($conn, $batch);
    }
}
