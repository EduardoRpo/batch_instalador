<?php

if (!empty($_POST)) {
    require_once('../../conexion.php');
    require_once('../../admin/sistema/php/crud.php');

    // obtener el modulo

    $modulo = strtoupper($_POST['proceso']);
    $modulo = str_replace('Ó', 'O', $modulo);
    
    $sql = "SELECT id FROM modulo WHERE modulo = :modulo";
    $query = $conn->prepare($sql);
    $query->execute(['modulo' => $modulo]);
    $rows = $query->rowCount();

    if ($rows > 0) {
        $data = $query->fetch(PDO::FETCH_ASSOC);
        $arreglo[] = $data;

        echo json_encode($arreglo, JSON_UNESCAPED_UNICODE);
    }
}
