<?php
require_once('../../conexion.php');

$sql = "SELECT batch.id_batch, bds.modulo
        FROM batch LEFT JOIN batch_desinfectante_seleccionado bds ON batch.id_batch = bds.batch 
        WHERE batch.estado > 2 ORDER BY `batch`.`id_batch` ASC";

$query = $conn->prepare($sql);
$query->execute();
$desinfectante = $query->fetchAll(PDO::FETCH_ASSOC);
$modulos = array(2, 3, 4, 5, 6, 8, 9);
$batch = 21;
$array = [];

for ($i = 0; $i < sizeof($desinfectante); $i++) {
    $modulo = $desinfectante[$i]['modulo'];

    if ($batch == $desinfectante[$i]['id_batch']) {
        array_push($array, $modulo);
    } else {
        $moduloDif = array_diff($modulos, $array);

        if (sizeof($moduloDif) != 0)
            inserteDesinfectante($conn, $i, $batch, $moduloDif);
        $batch = $desinfectante[$i]['id_batch'];
        $array = [];
        $moduloDif = [];
        $i--;
    }
}


function inserteDesinfectante($conn, $i, $batch, $moduloDif)
{

    $modulofaltantes = array_values($moduloDif);
    /* print_r($moduloDif);
    exit(); */

    for ($i = 0; $i < sizeof($moduloDif); $i++) {
        $modulo = $modulofaltantes[$i];

        if ($modulo == 9) {

            $sql = "SELECT * FROM `batch_firmas2seccion` WHERE modulo = :modulo AND batch = :batch";
            $query = $conn->prepare($sql);
            $query->execute(['modulo' => $modulo, 'batch' => $batch]);
            $data = $query->fetch(PDO::FETCH_ASSOC);

            if ($data) {


                if ($data['fecha_registro'] <= '2021-04-30')
                    $desinfectante = 1;
                else if ($data['fecha_registro'] >= '2021-05-01' && $data['fecha_registro'] <= '2021-05-15')
                    $desinfectante = 5;
                else if ($data['fecha_registro'] >= '2021-05-16' && $data['fecha_registro'] < '2021-06-01')
                    $desinfectante = 3;
                else if ($data['fecha_registro'] >= '2021-06-01' && $data['fecha_registro'] <= '2021-06-15')
                    $desinfectante = 4;
                else if ($data['fecha_registro'] >= '2021-06-16' && $data['fecha_registro'] <= '2021-06-30')
                    $desinfectante = 1;

                $realizo = 6;
                $verifico = 41;

                $sql = "INSERT INTO batch_desinfectante_seleccionado (desinfectante, modulo, batch, realizo, verifico, fecha_registro) 
                        VALUES(:desinfectante, :modulo, :batch, :realizo, :verifico, :fecha_registro)";
                $query = $conn->prepare($sql);
                $query->execute(['desinfectante' => $desinfectante, 'modulo' => $modulo, 'batch' => $batch, 'realizo' => $realizo, 'verifico' => $verifico, 'fecha_registro' => $data['fecha_registro']]);
            }
        }

        if ($modulo == 8) {

            $sql = "SELECT * FROM `batch_analisis_microbiologico` WHERE modulo = :modulo AND batch = :batch";
            $query = $conn->prepare($sql);
            $query->execute(['modulo' => $modulo, 'batch' => $batch]);
            $data = $query->fetch(PDO::FETCH_ASSOC);

            if ($data) {

                if ($data['fecha_siembra'] <= '2021-04-30')
                    $desinfectante = 1;
                else if ($data['fecha_siembra'] >= '2021-05-01' && $data['fecha_siembra'] <= '2021-05-15')
                    $desinfectante = 5;
                else if ($data['fecha_siembra'] >= '2021-05-16' && $data['fecha_siembra'] <= '2021-05-31')
                    $desinfectante = 3;
                else if ($data['fecha_siembra'] >= '2021-06-01' && $data['fecha_siembra'] <= '2021-06-15')
                    $desinfectante = 4;
                else if ($data['fecha_siembra'] >= '2021-06-16' && $data['fecha_siembra'] <= '2021-06-30')
                    $desinfectante = 1;

                $realizo = 6;
                $verifico = 41;
                $fecha_registro = $data['fecha_siembra'];

                $sql = "INSERT INTO batch_desinfectante_seleccionado (desinfectante, modulo, batch, realizo, verifico, fecha_registro) 
                            VALUES(:desinfectante, :modulo, :batch, :realizo, :verifico, :fecha_registro)";
                $query = $conn->prepare($sql);
                $query->execute(['desinfectante' => $desinfectante, 'modulo' => $modulo, 'batch' => $batch, 'realizo' => $realizo, 'verifico' => $verifico, 'fecha_registro' => $fecha_registro]);
            }
        }
    }
}
