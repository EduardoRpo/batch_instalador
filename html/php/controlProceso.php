<?php

if (!empty($_POST)) {

    require_once('../../conexion.php');

    $modulo = $_POST['modulo'];
    $batch = $_POST['idBatch'];

    $sql = "SELECT * FROM batch_control_especificaciones  
            WHERE modulo = :modulo AND batch = :batch";
    $query = $conn->prepare($sql);
    $result = $query->execute([
        'modulo' => $modulo,
        'batch' => $batch,
    ]);
    /* if ($result > 0) {
        $data = $query->fetch(PDO::FETCH_ASSOC);
        $arreglo[] = $data;
        echo json_encode($arreglo, JSON_UNESCAPED_UNICODE);
    } */

    //$result = $conn->query($query);

    //Almacena la data en array
    while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
        $arreglo["data"][] = $data;
    }
    if (empty($arreglo)) {
        echo '0';
        exit();
    }

    echo json_encode($arreglo, JSON_UNESCAPED_UNICODE);
}
