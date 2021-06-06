<?php
require_once('../../../conexion.php');
$batch = $_POST['batch'];

if ($batch == 1) {
    $sql = "SELECT realizo, verifico, batch, modulo FROM batch_desinfectante_seleccionado";
    $query = $conn->prepare($sql);
    $query->execute();
    $firmas_despeje = $query->fetchAll(PDO::FETCH_ASSOC);
    $cantidad = 0;
    for ($i = 0; $i < sizeof($firmas_despeje); $i++) {

        if ($firmas_despeje[$i]['realizo'] > 0)
            $cantidad = $cantidad + 1;
        if ($firmas_despeje[$i]['verifico'] > 0)
            $cantidad = $cantidad + 1;

        $objeto = new stdClass();
        $modulo = $firmas_despeje[$i]['modulo'];
        $objeto->batch = $firmas_despeje[$i]['batch'];
        $objeto->$modulo = $cantidad;

        if (isset($firma)) {
            for ($i = 0; $i < sizeof($firma); $i++) {
                if ($firma[$i]['batch'] = $firmas_despeje[$i]['batch'])
                    $firma[$i]['modulo'] = $$cantidad;
                else {
                    $firma[] = $objeto;
                }
            }
        } else
            $firma[] = $objeto;

        $cantidad = 0;
    }

    $sql = "SELECT realizo, verifico, batch, modulo FROM batch_firmas2seccion";
    $query = $conn->prepare($sql);
    $query->execute();
    $firmas_proceso = $query->fetchAll(PDO::FETCH_ASSOC);

    for ($i = 0; $i < sizeof($firmas_proceso); $i++) {
        if ($firmas_proceso[$i]['realizo'] > 0)
            $cantidad = $cantidad + 1;
        if ($firmas_proceso[$i]['verifico'] > 0)
            $cantidad = $cantidad + 1;

        $modulo = $firmas_proceso[$i]['modulo'];
        $indice = array_key_exists($modulo, $firmas);

        if ($indice)
            $firmas[$firmas_proceso[$i]['modulo']] = $firmas[$modulo] + $cantidad;
        else
            $firmas[$modulo] =  $cantidad;
        $cantidad = 0;
    }

    $sql = "SELECT realizo, verifico, batch, modulo FROM batch_analisis_microbiologico";
    $query = $conn->prepare($sql);
    $query->execute();
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


    $sql = "SELECT entrego, batch, modulo FROM batch_conciliacion_rendimiento";
    $query = $conn->prepare($sql);
    $query->execute();
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

    $sql = "SELECT realizo, verifico, batch, modulo FROM batch_material_sobrante";
    $query = $conn->prepare($sql);
    $query->execute();
    $firmas_material = $query->fetchAll(PDO::FETCH_ASSOC);

    for ($i = 0; $i < sizeof($firmas_material); $i++) {
        if ($firmas_material[$i]['realizo'] > 0)
            $cantidad = $cantidad + 1;
        if ($firmas_material[$i]['verifico'] > 0)
            $cantidad = $cantidad + 1;

        $modulo = $firmas_material[$i]['modulo'];
        $indice = array_key_exists($modulo, $firmas);

        if ($indice)
            $firmas[$firmas_material[$i]['modulo']] = $firmas[$modulo] + $cantidad;
        else
            $firmas[$modulo] =  $cantidad;
        $cantidad = 0;
    }

    echo json_encode($firmas, JSON_UNESCAPED_UNICODE);
} else {

    $sql = "SELECT realizo, verifico, batch, modulo FROM batch_desinfectante_seleccionado WHERE batch = :batch";
    $query = $conn->prepare($sql);
    $query->execute(['batch' => $batch]);
    $firmas_despeje = $query->fetchAll(PDO::FETCH_ASSOC);
    $cantidad = 0;
    for ($i = 0; $i < sizeof($firmas_despeje); $i++) {
        if ($firmas_despeje[$i]['realizo'] > 0)
            $cantidad = $cantidad + 1;
        if ($firmas_despeje[$i]['verifico'] > 0)
            $cantidad = $cantidad + 1;
        $firmas[$firmas_despeje[$i]['modulo']] =  $cantidad;
        $cantidad = 0;
    }

    $sql = "SELECT realizo, verifico, batch, modulo FROM batch_firmas2seccion WHERE batch = :batch";
    $query = $conn->prepare($sql);
    $query->execute(['batch' => $batch]);
    $firmas_proceso = $query->fetchAll(PDO::FETCH_ASSOC);

    for ($i = 0; $i < sizeof($firmas_proceso); $i++) {
        if ($firmas_proceso[$i]['realizo'] > 0)
            $cantidad = $cantidad + 1;
        if ($firmas_proceso[$i]['verifico'] > 0)
            $cantidad = $cantidad + 1;

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

    for ($i = 0; $i < sizeof($firmas_material); $i++) {
        if ($firmas_material[$i]['realizo'] > 0)
            $cantidad = $cantidad + 1;
        if ($firmas_material[$i]['verifico'] > 0)
            $cantidad = $cantidad + 1;

        $modulo = $firmas_material[$i]['modulo'];
        $indice = array_key_exists($modulo, $firmas);

        if ($indice)
            $firmas[$firmas_material[$i]['modulo']] = $firmas[$modulo] + $cantidad;
        else
            $firmas[$modulo] =  $cantidad;
        $cantidad = 0;
    }

    echo json_encode($firmas, JSON_UNESCAPED_UNICODE);
}
