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

$diasFeriados = [
    '2021-05-01',
    '2021-05-02',
    '2021-05-08',
    '2021-05-09',
    '2021-05-15',
    '2021-05-16',
    '2021-05-17',
    '2021-05-22',
    '2021-05-23',
    '2021-05-29',
    '2021-05-30',
    '2021-06-06',
    '2021-06-07',
    '2021-06-13',
    '2021-06-14',
    '2021-06-20',
    '2021-06-26',
    '2021-06-27',
    '2021-07-03',
    '2021-07-04',
    '2021-07-05',
    '2021-07-11',
    '2021-07-18',
    '2021-07-20',
    '2021-07-25',
    '2021-07-31',
    '2021-08-01',
    '2021-08-07',
    '2021-08-08',
    '2021-08-15',
    '2021-08-16',
    '2021-08-22',
    '2021-08-28',
    '2021-08-29',
    '2021-09-05',
    '2021-09-12',
    '2021-09-19',
    '2021-09-26',
    '2021-10-03',
    '2021-10-10',
    '2021-10-17',
    '2021-10-18',
    '2021-10-24',
    '2021-10-31',
    '2021-11-01',
    '2021-11-07',
    '2021-11-14',
    '2021-11-15',
    '2021-11-21',
    '2021-11-27',
    '2021-11-28',
    '2021-12-08',
    '2021-12-11',
    '2021-12-12',
    '2021-12-18',
    '2021-12-19',
    '2021-12-25',
    '2021-12-26',
    '2022-01-01',
    '2022-01-02',
    '2022-01-08',
    '2022-01-09',
    '2022-01-10',
    '2022-01-15',
    '2022-01-16',
    '2022-01-22',
    '2022-01-23',
    '2022-01-29',
    '2022-01-30',
    '2022-02-05',
    '2022-02-06',
    '2022-02-12',
    '2022-02-13',
    '2022-02-19',
    '2022-02-20',
    '2022-02-27',
    '2022-03-06',
    '2022-03-13',
    '2022-03-20',
    '2022-03-27',
    '2022-04-03',
    '2022-04-10',
    '2022-04-17',
    '2022-04-24',
    '2022-05-01',
    '2022-05-08',
    '2022-05-15',
    '2022-05-22',
    '2022-05-29',
    '2022-06-05',
    '2022-06-12',
    '2022-06-19',
    '2022-06-26',
    '2022-07-03',
    '2022-07-10',
    '2022-07-17',
    '2022-07-24',
    '2022-07-31',
    '2022-08-07',
    '2022-08-14',
    '2022-08-21',
    '2022-08-28',
    '2022-09-04',
    '2022-09-11',
    '2022-09-18',
    '2022-09-25',
    '2022-10-02',
    '2022-10-09',
    '2022-10-16',
    '2022-10-23',
    '2022-10-30',
    '2022-11-06',
    '2022-11-13',
    '2022-11-14',
    '2022-11-20',
    '2022-11-27',
    '2022-12-04',
    '2022-12-08',
    '2022-12-11',
    '2022-12-18',
    '2022-12-24',
    '2022-12-25',
    '2022-12-26',
    '2022-12-30',
    '2022-12-31',
    '2023-01-01',
    '2023-01-07',
    '2023-01-08',
    '2023-01-09',
    '2023-01-14',
    '2023-01-15',
    '2023-01-21',
    '2023-01-22',
    '2023-01-28',
    '2023-01-29',
    '2023-02-04',
    '2023-02-05',
    '2023-02-11',
    '2023-02-12',
    '2023-02-18',
    '2023-02-19',
    '2023-02-25',
    '2023-02-26',
    '2023-03-04',
    '2023-03-05',
    '2023-03-11',
    '2023-03-12',
    '2023-03-18',
    '2023-03-19',
    '2023-03-25',
    '2023-03-26',
    '2023-04-01',
    '2023-04-02',
    '2023-04-03',
    '2023-04-04',
    '2023-04-05',
    '2023-04-06',
    '2023-04-07',
    '2023-04-08',
    '2023-04-09',
];

$array_fechas = [];

foreach ($diasFeriados as $diasFeriado) {
    $date = strtotime($diasFeriado);
    //echo $date . "<br>";
    array_push($array_fechas, $date);
}

for ($i = 0; $i < sizeof($batch); $i++) {
    for ($j = 0; $j < sizeof($fechas_registro); $j++) {

        if ($batch[$i]['id_batch'] >= 2388) {
            if ($batch[$i]['id_batch'] == $fechas_registro[$j]['batch']) {

                $date_pesaje = "";
                $date_preparacion = "";
                $date_aprobacion = "";
                $date_envasado = "";
                $date_microbiologia = "";
                $date_liberacion = "";

                echo $fechas_registro[$j]['batch'] . "<br><br>";
                $batchProceso = $fechas_registro[$j]['batch'];

                if ($fechas_registro[$j]['modulo'] == 2) {
                    $date = date_create();
                    $fecha_inicio = $fechas_registro[$j]['fecha_registro'];
                    $fecha_inicio = substr($fecha_inicio, 0, 10);

                    //echo 'Fecha Inicio: ' . $fecha_inicio . "<br><br>";

                    $pes_date = strtotime($fecha_inicio . "+ 0 days");

                    $new_date = validacionFeriados($pes_date, $array_fechas);

                    if ($new_date != null)
                        if ($new_date != $pes_date)
                            $pes_date = $new_date;

                    date_timestamp_set($date, $pes_date);

                    //echo 'Pesaje: ' . date_format($date, "Y-m-d") . "<br><br>";
                    $date_pesaje = date_format($date, "Y-m-d");

                    InsertarFechaDesinfectante($conn, $batchProceso, $date_pesaje, 2);
                    InsertarFecha($conn, $batchProceso, $date_pesaje, 2);

                    $day = random_int(0, 1);
                    $prep_date = strtotime($fecha_inicio . "+ $day days");

                    $new_date = validacionFeriados($prep_date, $array_fechas);

                    if ($new_date != null)
                        if ($new_date != $prep_date)
                            $prep_date = $new_date;

                    date_timestamp_set($date, $prep_date);
                    //echo 'Preparacion: ' . date_format($date, "Y-m-d") . "<br><br>";
                    $date_preparacion = date_format($date, "Y-m-d");

                    InsertarFechaDesinfectante($conn, $batchProceso, $date_preparacion, 3);
                    InsertarFecha($conn, $batchProceso, $date_preparacion, 3);

                    $day = random_int(0, 1);
                    $aprob_date = $prep_date + (86400 * $day);

                    $new_date = validacionFeriados($aprob_date, $array_fechas);

                    if ($new_date != null)
                        if ($new_date != $aprob_date)
                            $aprob_date = $new_date;

                    date_timestamp_set($date, $aprob_date);
                    //echo 'Aprobacion: ' . date_format($date, "Y-m-d") . "<br><br>";
                    $date_aprobacion = date_format($date, "Y-m-d");

                    InsertarFechaDesinfectante($conn, $batchProceso, $date_aprobacion, 4);
                    InsertarFecha($conn, $batchProceso, $date_aprobacion, 4);

                    $day = random_int(1, 2);
                    $envas_date = $aprob_date + (86400 * $day);

                    $new_date = validacionFeriados($envas_date, $array_fechas);

                    if ($new_date != null)
                        if ($new_date != $envas_date)
                            $envas_date = $new_date;


                    date_timestamp_set($date, $envas_date);
                    //echo 'Envasado: ' . date_format($date, "Y-m-d") . "<br><br>";
                    $date_envasado = date_format($date, "Y-m-d");

                    //echo 'Acondicionamiento: ' . date_format($date, "Y-m-d") . "<br><br>";
                    InsertarFechaDesinfectante($conn, $batchProceso, $date_envasado, 5);
                    InsertarFecha($conn, $batchProceso, $date_envasado, 5);
                    InsertarFechaMaterialSobrante($conn, $batchProceso, $date_envasado, 5);

                    InsertarFechaDesinfectante($conn, $batchProceso, $date_envasado, 6);
                    InsertarFecha($conn, $batchProceso, $date_envasado, 6);
                    InsertarFechaMaterialSobrante($conn, $batchProceso, $date_envasado, 6);

                    InsertarFechaRendimiento($conn, $batchProceso, $date_envasado, 6);

                    $day = random_int(2, 3);
                    $micro_date = $envas_date + (86400 * $day);

                    $new_date = validacionFeriados($micro_date, $array_fechas);

                    if ($new_date != null)
                        if ($new_date != $micro_date)
                            $micro_date = $new_date;

                    date_timestamp_set($date, $micro_date);
                    //echo 'Microbiologia: ' . date_format($date, "Y-m-d") . "<br><br>";
                    $date_microbiologia = date_format($date, "Y-m-d");
                    //echo 'Fisicoquimico: ' . date_format($date, "Y-m-d") . "<br><br>";
                    //echo 'Despachos: ' . date_format($date, "Y-m-d") . "<br><br>";

                    InsertarFechaRendimiento($conn, $batchProceso, $date_envasado, 7);

                    InsertarFechaDesinfectante($conn, $batchProceso, $date_microbiologia, 8);
                    InsertarFechaMicrobiologia($conn, $batchProceso, $date_microbiologia, 8);

                    InsertarFechaDesinfectante($conn, $batchProceso, $date_microbiologia, 9);
                    InsertarFecha($conn, $batchProceso, $date_microbiologia, 9);

                    $day = random_int(0, 1);
                    $lib_date = $micro_date + (86400 * $day);

                    $new_date = validacionFeriados($lib_date, $array_fechas);

                    if ($new_date != null)
                        if ($new_date != $lib_date)
                            $lib_date = $new_date;

                    date_timestamp_set($date, $lib_date);
                    //echo 'Liberacion: ' . date_format($date, "Y-m-d") . "<br><br>";
                    $date_liberacion = date_format($date, "Y-m-d");

                    InsertarFechaLiberacion($conn, $batchProceso, $date_liberacion, 10);
                }
                break;
            }
        }
    }
}


function validacionFeriados($date, $array_fechas)
{
    if (in_array($date, $array_fechas)) {
        $new_date = $date + (86400);
    }

    if (isset($new_date))
        if (in_array($new_date, $array_fechas)) {
            $new_date = $new_date + (86400);
        }

    if (isset($new_date))
        return $new_date;
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
