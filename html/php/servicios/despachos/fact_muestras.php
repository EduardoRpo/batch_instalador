<?php
if (!empty($_POST)) {
    require_once('../../../../conexion.php');

    $ref = $_POST['referencia'];

    $sql = "SELECT p.id_propietario, pp.nombre, pp.facturar 
            FROM producto p INNER JOIN propietario pp ON pp.id = p.id_propietario 
            WHERE referencia = :referencia";

    $query = $conn->prepare($sql);
    $query->execute(['referencia' => $ref]);
    $data = $query->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
}
