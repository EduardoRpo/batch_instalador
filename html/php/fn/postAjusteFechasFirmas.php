<?php

require_once('../../../conexion.php');

$sql = "SELECT id_batch FROM batch WHERE batch.estado > 0 ORDER BY `batch`.`id_batch` ASC";
$query = $conn->prepare($sql);
$query->execute();
$batch = $query->fetchAll(PDO::FETCH_ASSOC);

/* $batchInicial = 21;
$array = []; */

$sql = "SELECT modulo, batch, fecha_registro FROM batch_firmas2seccion WHERE modulo = 2 ORDER BY `batch_firmas2seccion`.`batch` ASC";
$query = $conn->prepare($sql);
$query->execute();
$fechas_registro = $query->fetchAll(PDO::FETCH_ASSOC);

for ($i = 0; $i <= sizeof($batch); $i++) {
    for ($j = 0; $j <= sizeof($fechas_registro); $j++) {

        if ($batch[$i]['id_batch'] == $fechas_registro[$j]['batch']) {

            echo $fechas_registro[$j]['batch'] . "<br><br>";
            $batchProceso = $fechas_registro[$j]['batch'];

            if ($fechas_registro[$j]['modulo'] == 2) {
                $date = date_create();
                $fecha_inicio = $fechas_registro[$j]['fecha_registro'];
                echo 'Fecha Inicio: ' . $fecha_inicio . "<br><br>";

                $pes_date = strtotime($fecha_inicio . "+ 0 days");
                date_timestamp_set($date, $pes_date);
                echo 'Pesaje: ' . date_format($date, "Y-m-d") . "<br><br>";
                $date_pesaje = date_format($date, "Y-m-d");

                InsertarFechaDesinfectante($conn, $batchProceso, $date_pesaje, 2);
                InsertarFecha($conn, $batchProceso, $date_pesaje, 2);

                $day = random_int(0, 1);
                $prep_date = strtotime($fecha_inicio . "+ $day days");
                date_timestamp_set($date, $prep_date);
                echo 'Preparacion: ' . date_format($date, "Y-m-d") . "<br><br>";
                $date_preparacion = date_format($date, "Y-m-d");
                
                InsertarFechaDesinfectante($conn, $batchProceso, $date_preparacion, 3);
                InsertarFecha($conn, $batchProceso, $date_preparacion, 3);

                $day = random_int(1, 2);
                $aprob_date = $prep_date + (86400 * $day);
                date_timestamp_set($date, $aprob_date);
                echo 'Aprobacion: ' . date_format($date, "Y-m-d") . "<br><br>";
                $date_aprobacion = date_format($date, "Y-m-d");
                
                InsertarFechaDesinfectante($conn, $batchProceso, $date_aprobacion, 4);
                InsertarFecha($conn, $batchProceso, $date_aprobacion, 4);

                $day = random_int(1, 2);
                $envas_date = $aprob_date + (86400 * $day);
                date_timestamp_set($date, $envas_date);
                echo 'Envasado: ' . date_format($date, "Y-m-d") . "<br><br>";
                $date_envasado = date_format($date, "Y-m-d");

                echo 'Acondicionamiento: ' . date_format($date, "Y-m-d") . "<br><br>";
                InsertarFechaDesinfectante($conn, $batchProceso, $date_envasado, 5);
                InsertarFecha($conn, $batchProceso, $date_envasado, 5);
                InsertarFechaMaterialSobrante($conn, $batchProceso, $date_envasado, 5);
                
                InsertarFechaDesinfectante($conn, $batchProceso, $date_envasado, 6);
                InsertarFecha($conn, $batchProceso, $date_envasado, 6);
                InsertarFechaMaterialSobrante($conn, $batchProceso, $date_envasado, 6);

                InsertarFechaRendimiento($conn, $batchProceso, $date_envasado, 6);

                $day = random_int(2, 3);
                $micro_date = $envas_date + (86400 * $day);
                date_timestamp_set($date, $micro_date);
                echo 'Microbiologia: ' . date_format($date, "Y-m-d") . "<br><br>";
                $date_microbiologia = date_format($date, "Y-m-d");
                echo 'Fisicoquimico: ' . date_format($date, "Y-m-d") . "<br><br>";
                echo 'Despachos: ' . date_format($date, "Y-m-d") . "<br><br>";

                InsertarFechaRendimiento($conn, $batchProceso, $date_envasado, 7);
                
                InsertarFechaDesinfectante($conn, $batchProceso, $date_microbiologia, 8);
                InsertarFechaMicrobiologia($conn, $batchProceso, $date_microbiologia, 8);
                
                InsertarFechaDesinfectante($conn, $batchProceso, $date_microbiologia, 9);
                InsertarFecha($conn, $batchProceso, $date_microbiologia, 9);

                $lib_date = $micro_date + (86400);
                date_timestamp_set($date, $lib_date);
                echo 'Liberacion: ' . date_format($date, "Y-m-d") . "<br><br>";
                $date_liberacion = date_format($date, "Y-m-d");

                InsertarFechaLiberacion($conn, $batchProceso, $date_liberacion, 10);
            }
            break;
        }
    }
}


function InsertarFecha($conn, $batchProceso, $date, $modulo)
{
    $sql = "SELECT * FROM batch_firmas2seccion WHERE batch = :batch AND modulo = :modulo";
    $query = $conn->prepare($sql);
    $query->execute(['batch' => $batchProceso, 'modulo' => $modulo]);
    $rows = $query->rowCount();

    if ($rows > 0) {
        $sql = "UPDATE batch_firmas2seccion SET fecha_nuevo_registro = :fecha WHERE batch = :batch AND modulo = :modulo";
        $query = $conn->prepare($sql);
        $query->execute(['fecha' =>  $date, 'batch' => $batchProceso, 'modulo' => $modulo]);
    }
}

function InsertarFechaDesinfectante($conn, $batchProceso, $date, $modulo)
{
    $sql = "SELECT * FROM batch_desinfectante_seleccionado WHERE batch = :batch AND modulo = :modulo";
    $query = $conn->prepare($sql);
    $query->execute(['batch' => $batchProceso, 'modulo' => $modulo]);
    $rows = $query->rowCount();

    if ($rows > 0) {
        $sql = "UPDATE batch_desinfectante_seleccionado SET fecha_nuevo_registro = :fecha WHERE batch = :batch AND modulo = :modulo";
        $query = $conn->prepare($sql);
        $query->execute(['fecha' =>  $date, 'batch' => $batchProceso, 'modulo' => $modulo]);
    }
}

function InsertarFechaMaterialSobrante($conn, $batchProceso, $date, $modulo)
{
    $sql = "SELECT * FROM batch_material_sobrante WHERE batch = :batch AND modulo = :modulo";
    $query = $conn->prepare($sql);
    $query->execute(['batch' => $batchProceso, 'modulo' => $modulo]);
    $rows = $query->rowCount();

    if ($rows > 0) {
        $sql = "UPDATE batch_material_sobrante SET fecha_nuevo_registro = :fecha WHERE batch = :batch AND modulo = :modulo";
        $query = $conn->prepare($sql);
        $query->execute(['fecha' =>  $date, 'batch' => $batchProceso, 'modulo' => $modulo]);
    }
}

function InsertarFechaRendimiento($conn, $batchProceso, $date, $modulo)
{
    $sql = "SELECT * FROM batch_conciliacion_rendimiento WHERE batch = :batch AND modulo = :modulo";
    $query = $conn->prepare($sql);
    $query->execute(['batch' => $batchProceso, 'modulo' => $modulo]);
    $rows = $query->rowCount();

    if ($rows > 0) {
        $sql = "UPDATE batch_conciliacion_rendimiento SET fecha_nuevo_registro = :fecha WHERE batch = :batch AND modulo = :modulo";
        $query = $conn->prepare($sql);
        $query->execute(['fecha' =>  $date, 'batch' => $batchProceso, 'modulo' => $modulo]);
    }
}

function InsertarFechaMicrobiologia($conn, $batchProceso, $date, $modulo)
{
    $sql = "SELECT * FROM batch_analisis_microbiologico WHERE batch = :batch AND modulo = :modulo";
    $query = $conn->prepare($sql);
    $query->execute(['batch' => $batchProceso, 'modulo' => $modulo]);
    $rows = $query->rowCount();

    if ($rows > 0) {
        $sql = "UPDATE batch_analisis_microbiologico SET fecha_nuevo_registro = :fecha WHERE batch = :batch AND modulo = :modulo";
        $query = $conn->prepare($sql);
        $query->execute(['fecha' =>  $date, 'batch' => $batchProceso, 'modulo' => $modulo]);
    }
}

function InsertarFechaLiberacion($conn, $batchProceso, $date, $modulo)
{
    $sql = "SELECT * FROM batch_liberacion WHERE batch = :batch";
    $query = $conn->prepare($sql);
    $query->execute(['batch' => $batchProceso]);
    $rows = $query->rowCount();

    if ($rows > 0) {
        $sql = "UPDATE batch_liberacion SET fecha_nuevo_registro = :fecha WHERE batch = :batch";
        $query = $conn->prepare($sql);
        $query->execute(['fecha' =>  $date, 'batch' => $batchProceso]);
    }
}
