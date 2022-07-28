<?php

if (!empty($_POST)) {

        require_once('../../conexion.php');
        $referencia = $_POST['referencia'];

        $sql = "SELECT env.id as id_envase, env.nombre as envase, tap.id as id_tapa, tap.nombre as tapa, eti.id as id_etiqueta, 
                        eti.nombre as etiqueta, emp.id as id_empaque, emp.nombre as empaque, otr.id as id_otros, 
                        otr.nombre as otros, p.unidad_empaque FROM producto p LEFT JOIN envase env ON p.id_envase = env.id 
                LEFT JOIN tapa tap ON p.id_tapa = tap.id 
                LEFT JOIN etiqueta eti ON p.id_etiqueta = eti.id 
                LEFT JOIN empaque emp ON p.id_empaque = emp.id 
                LEFT JOIN otros otr ON p.id_otros = otr.id 
                WHERE p.referencia = :referencia;";

        $query = $conn->prepare($sql);
        $result = $query->execute(['referencia' => $referencia,]);
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
}
