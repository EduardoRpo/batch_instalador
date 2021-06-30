<?php

require_once('../../../conexion.php');

$sql = "SELECT id_batch FROM batch ORDER BY `batch`.`id_batch` ASC";
$query = $conn->prepare($sql);
$query->execute();
$batchs = $query->fetchAll(PDO::FETCH_ASSOC);

if ($batchs > 0) {

    for ($j = 0; $j < sizeof($batchs); $j++) {
        $batch = $batchs[$j]['id_batch'];
        $firmas = [];

        $sql = "SELECT realizo, verifico, batch, modulo FROM batch_desinfectante_seleccionado WHERE batch = :batch";
        $query = $conn->prepare($sql);
        $query->execute(['batch' => $batch]);
        $firmas_despeje = $query->fetchAll(PDO::FETCH_ASSOC);
        $cantidad = 0;

        for ($i = 0; $i < sizeof($firmas_despeje); $i++) {
            $fmodulo = $firmas_despeje[$i]['modulo'];
            if ($fmodulo != 9 && $fmodulo != 8) {
                if ($firmas_despeje[$i]['realizo'] > 0)
                    $cantidad = $cantidad + 1;
                if ($firmas_despeje[$i]['verifico'] > 0)
                    $cantidad = $cantidad + 1;
            }
            $firmas[$firmas_despeje[$i]['modulo']] =  $cantidad;
            $cantidad = 0;
        }

        $sql = "SELECT realizo, verifico, batch, modulo FROM batch_firmas2seccion WHERE batch = :batch";
        $query = $conn->prepare($sql);
        $query->execute(['batch' => $batch]);
        $firmas_proceso = $query->fetchAll(PDO::FETCH_ASSOC);

        for ($i = 0; $i < sizeof($firmas_proceso); $i++) {
            if ($firmas_proceso[$i]['modulo'] != 4 && $firmas_proceso[$i]['modulo'] != 8) {
                if ($firmas_proceso[$i]['realizo'] > 0)
                    $cantidad = $cantidad + 1;
                if ($firmas_proceso[$i]['verifico'] > 0)
                    $cantidad = $cantidad + 1;
            }
            $modulo = $firmas_proceso[$i]['modulo'];
            $indice = array_key_exists($modulo, $firmas);

            if ($indice)
                $firmas[$firmas_proceso[$i]['modulo']] = $firmas[$modulo] + $cantidad;
            else
                $firmas[$modulo] =  $cantidad;
            $cantidad = 0;
        }

        $sql = "SELECT realizo, verifico, batch, modulo FROM batch_analisis_microbiologico WHERE batch = :batch";
        $query = $conn->prepare($sql);
        $query->execute(['batch' => $batch]);
        $firmas_microbiologico = $query->fetchAll(PDO::FETCH_ASSOC);

        for ($i = 0; $i < sizeof($firmas_microbiologico); $i++) {
            if ($firmas_microbiologico[$i]['realizo'] > 0)
                $cantidad = $cantidad + 1;
            if ($firmas_microbiologico[$i]['verifico'] > 0)
                $cantidad = $cantidad + 1;

            $modulo = $firmas_microbiologico[$i]['modulo'];
            $indice = array_key_exists($modulo, $firmas);

            if ($indice)
                $firmas[$firmas_microbiologico[$i]['modulo']] = $firmas[$modulo] + $cantidad;
            else
                $firmas[$modulo] =  $cantidad;
            $cantidad = 0;
        }


        $sql = "SELECT entrego, batch, modulo FROM batch_conciliacion_rendimiento WHERE batch = :batch";
        $query = $conn->prepare($sql);
        $query->execute(['batch' => $batch]);
        $firmas_conciliacion = $query->fetchAll(PDO::FETCH_ASSOC);

        for ($i = 0; $i < sizeof($firmas_conciliacion); $i++) {
            if ($firmas_conciliacion[$i]['entrego'] > 0)
                $cantidad = $cantidad + 1;

            $modulo = $firmas_conciliacion[$i]['modulo'];
            $indice = array_key_exists($modulo, $firmas);

            if ($indice)
                $firmas[$firmas_conciliacion[$i]['modulo']] = $firmas[$modulo] + $cantidad;
            else
                $firmas[$modulo] =  $cantidad;
            $cantidad = 0;
        }

        $sql = "SELECT realizo, verifico, batch, modulo FROM batch_material_sobrante WHERE batch = :batch";
        $query = $conn->prepare($sql);
        $query->execute(['batch' => $batch]);
        $firmas_material = $query->fetchAll(PDO::FETCH_ASSOC);

        if (sizeof($firmas_material) > 0) {

            for ($i = 0; $i < sizeof($firmas_material); $i++) {
                if ($firmas_material[$i]['modulo'] == 5) {
                    if ($firmas_material[$i]['realizo'] > 0)
                        $cantidad = $cantidad + 1;
                    if ($firmas_material[$i]['verifico'] > 0)
                        $cantidad = $cantidad + 1;
                }
            }
            $modulo = 5;
            $indice = array_key_exists($modulo, $firmas);

            if ($indice && $cantidad == 6)
                $firmas[$modulo] = $firmas[$modulo] + 2;
            else
                $firmas[$modulo] =  1;
            $cantidad = 0;


            for ($i = 0; $i < sizeof($firmas_material); $i++) {
                if ($firmas_material[$i]['modulo'] == 6) {
                    if ($firmas_material[$i]['realizo'] > 0)
                        $cantidad = $cantidad + 1;
                    if ($firmas_material[$i]['verifico'] > 0)
                        $cantidad = $cantidad + 1;
                }
            }
            $modulo = 6;
            $indice = array_key_exists($modulo, $firmas);

            if ($indice && $cantidad == 4)
                $firmas[$modulo] = $firmas[$modulo] + 2;
            else
                $firmas[$modulo] =  1;
            $cantidad = 0;
        }

        $sql = "SELECT * FROM batch_liberacion WHERE batch = :batch";
        $query = $conn->prepare($sql);
        $query->execute(['batch' => $batch]);
        $firmas_liberacion = $query->fetch(PDO::FETCH_ASSOC);

        if ($firmas_liberacion) {
            if ($firmas_liberacion['dir_produccion'] > 0)
                $cantidad = $cantidad + 1;

            if ($firmas_liberacion['dir_calidad'] > 0)
                $cantidad = $cantidad + 1;

            if ($firmas_liberacion['dir_tecnica'] > 0)
                $cantidad = $cantidad + 1;

            $modulo = 10;
            $indice = array_key_exists($modulo, $firmas);

            if ($indice)
                $firmas[$firmas_liberacion[$i]['modulo']] = $firmas[$modulo] + $cantidad;
            else
                $firmas[$modulo] =  $cantidad;
            $cantidad = 0;
        }

        foreach ($firmas as $key => $value) {

            $sql = "SELECT * FROM batch_control_firmas WHERE modulo= :modulo AND batch = :batch";
            $query = $conn->prepare($sql);
            $query->execute(['batch' => $batch, 'modulo' => $key]);
            $data = $query->fetchAll(PDO::FETCH_ASSOC);

            if (sizeof($data) == 0) {
                $sql = "INSERT INTO batch_control_firmas (modulo, batch, cantidad_firmas) VALUES(:modulo, :batch, :firmas)";
                $query = $conn->prepare($sql);
                $query->execute(['batch' => $batch, 'modulo' => $key, 'firmas' => $value]);
            } else {
                $sql = "UPDATE batch_control_firmas SET cantidad_firmas = :firmas WHERE modulo = :modulo and batch = :batch";
                $query = $conn->prepare($sql);
                $query->execute(['batch' => $batch, 'modulo' => $key, 'firmas' => $value]);
            }
        }
    }
}
