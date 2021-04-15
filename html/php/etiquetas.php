<?php

if (!empty($_POST)) {
    $referencia = $_POST['ref'];
    $sql = "SELECT * FROM formula WHERE id_producto = :referencia";
    $query = $conn->prepare($sql);
    $query->execute(['referencia' => $referencia]);
    $data = $query->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
}
