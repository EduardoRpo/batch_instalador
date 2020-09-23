<?php
if (!empty($_POST)) {
    require_once('../../conexion.php');
   require_once('../../admin/sistema/php/crud.php');

    $referencia = $_POST['referencia'];
    
    $sql = "SELECT * FROM instructivo_preparacion WHERE id_producto = $referencia";
    $result = $conn->query($sql);

    while ($data = $result->fetch(PDO::FETCH_ASSOC)) {
        $arreglo[] = $data;
    }

    echo json_encode(utf8ize($arreglo), JSON_UNESCAPED_UNICODE);

}

