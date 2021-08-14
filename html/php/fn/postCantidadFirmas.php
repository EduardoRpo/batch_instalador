<?php
require_once('../../../conexion.php');

$sql = "SELECT * FROM batch_desinfectante_seleccionado WHERE modulo = 6";
$query = $conn->prepare($sql);
$query->execute();
$rows = $query->fetchAll(PDO::FETCH_ASSOC);

foreach ($rows as $row) {
    if ($row['realizo'] > 0)
        $firma = $firma + 1;

    if ($row['verifico'] > 0)
        $firma = $firma + 1;
    


    }




$sql = "SELECT * FROM batch_firmas2seccion  WHERE modulo = 6";
$query = $conn->prepare($sql);
$query->execute();
$rows = $query->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM batch_material_sobrante  WHERE modulo = 6";
$query = $conn->prepare($sql);
$query->execute();
$rows = $query->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM batch_conciliacion_rendimiento  WHERE modulo = 6";
$query = $conn->prepare($sql);
$query->execute();
$rows = $query->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM batch_analisis_microbiologico  WHERE modulo = 6";
$query = $conn->prepare($sql);
$query->execute();
$rows = $query->fetchAll(PDO::FETCH_ASSOC);





$sql = "UPDATE batch_control_firmas SET total_firmas = :total_firmas WHERE batch = :batch AND modulo = :modulo";
$query = $conn->prepare($sql);
$query->execute(['total_firmas' => $total_firmas, 'batch' => $batchFirma['batch'], 'modulo' => $i]);
