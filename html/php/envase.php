<?php

if (!empty($_POST)) {

    require_once('../../conexion.php');

    $referencia = $_POST['referencia'];

    $sql = "SELECT envase.id as id_envase , envase.nombre as envase, tapa.id as id_tapa, tapa.nombre as tapa, etiqueta.id as id_etiqueta, etiqueta.nombre as etiqueta, empaque.id as id_empaque, empaque.nombre as empaque, otros.id as id_otros ,otros.nombre as otros, p.unidad_empaque FROM producto p 
            INNER JOIN envase INNER JOIN TAPA INNER JOIN etiqueta INNER JOIN empaque INNER JOIN otros
            ON p.id_envase = envase.id AND tapa.id = p.id_tapa AND etiqueta.id=p.id_etiqueta AND empaque.id=p.id_empaque AND otros.id = p.id_otros 
            WHERE p.referencia = :referencia";

    $query = $conn->prepare($sql);
    $result = $query->execute(['referencia' => $referencia,]);

    //Almacena la data en array
    $data = $query->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    /* while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
        $arreglo["data"][] = $data;
    } */
    if (empty($data)) {
        echo '3';
        exit();
    }

    //echo json_encode($arreglo, JSON_UNESCAPED_UNICODE);
}
