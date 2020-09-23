<?php
if (!empty($_POST)) {
    require_once('../../conexion.php');
    require_once('../../admin/sistema/php/crud.php');

    $referencia = $_POST['referencia'];

    $sql = "SELECT * FROM instructivo_preparacion WHERE id_producto = :referencia";
    $query = $conn->prepare($sql);
    $result = $query->execute(['referencia' => $referencia]);

    if ($result) {
        while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
            $arreglo["data"][] = $data;
        }

        echo json_encode(utf8ize($arreglo), JSON_UNESCAPED_UNICODE);
    }
}
