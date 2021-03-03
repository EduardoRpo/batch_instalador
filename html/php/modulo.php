<?php

/* Obtener el id del modulo en el cual se esta trabajando */

if (!empty($_POST)) {
    require_once('../../conexion.php');


    $modulo = $_POST['proceso'];
    //$modulo = str_replace('Ó', 'O', $modulo);

    $sql = "SELECT id FROM modulo WHERE modulo = :modulo";
    $query = $conn->prepare($sql);
    $query->execute(['modulo' => $modulo]);
    /* $rows = $query->rowCount();

    if ($rows > 0) { */
        $data = $query->fetch(PDO::FETCH_ASSOC);
        /* $arreglo[] = $data; */
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
/* } */
