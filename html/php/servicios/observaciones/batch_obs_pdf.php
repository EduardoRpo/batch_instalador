<?php
if (!empty($_POST)) {
    require_once('../../../../conexion.php');

    $batch = $_POST['batch'];

    $sql = "SELECT modulo, batch, observaciones FROM batch_analisis_microbiologico WHERE batch = :batch";
    $query = $conn->prepare($sql);
    $query->execute(['batch' => $batch]);
    $data = $query->fetchAll(PDO::FETCH_ASSOC);

    for ($i = 0; $i < sizeof($data); $i++)
        $array[] = $data[$i];

    $sql = "SELECT modulo, batch, observaciones, ref_multi FROM batch_conciliacion_rendimiento WHERE batch = :batch";
    $query = $conn->prepare($sql);
    $query->execute(['batch' => $batch]);
    $data = $query->fetchAll(PDO::FETCH_ASSOC);

    for ($i = 0; $i < sizeof($data); $i++)
        $array[] = $data[$i];

    $sql = "SELECT modulo, batch, observaciones FROM batch_desinfectante_seleccionado WHERE batch = :batch";
    $query = $conn->prepare($sql);
    $query->execute(['batch' => $batch]);
    $data = $query->fetchAll(PDO::FETCH_ASSOC);

    for ($i = 0; $i < sizeof($data); $i++)
        $array[] = $data[$i];

    $sql = "SELECT modulo, batch, observaciones, ref_multi FROM batch_firmas2seccion WHERE batch = :batch";
    $query = $conn->prepare($sql);
    $query->execute(['batch' => $batch]);
    $data = $query->fetchAll(PDO::FETCH_ASSOC);

    for ($i = 0; $i < sizeof($data); $i++)
        $array[] = $data[$i];

    $sql = "SELECT modulo, batch, observacion FROM batch_incidencias_observaciones WHERE batch = :batch";
    $query = $conn->prepare($sql);
    $query->execute(['batch' => $batch]);
    $data = $query->fetchAll(PDO::FETCH_ASSOC);

    for ($i = 0; $i < sizeof($data); $i++)
        $array[] = $data[$i];

    $sql = "SELECT batch, observaciones FROM batch_liberacion WHERE batch = :batch";
    $query = $conn->prepare($sql);
    $query->execute(['batch' => $batch]);
    $data = $query->fetchAll(PDO::FETCH_ASSOC);

    for ($i = 0; $i < sizeof($data); $i++)
        $array[] = $data[$i];

    echo json_encode($array, JSON_UNESCAPED_UNICODE);
}
