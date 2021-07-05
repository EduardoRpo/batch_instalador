<?php

//require_once('../../batchRecord/htdocs/conexion.php');
//define('__ROOT__', dirname(dirname(__FILE__)));
define('__ROOT__', dirname(__FILE__, 5));
require_once(__ROOT__ . '\conexion.php');

$op = $_POST['operacion'];

switch ($op) {
    case '1': // Listar productos sin formula
        $sql = "SELECT TRIM(referencia) FROM producto";
        $query = $conn->prepare($sql);
        $query->execute();
        $productos = $query->fetchAll(PDO::FETCH_COLUMN);

        $sql = "SELECT DISTINCT id_producto FROM formula ORDER BY `formula`.`id_producto` ASC";
        $query = $conn->prepare($sql);
        $query->execute();
        $formulas = $query->fetchAll(PDO::FETCH_COLUMN);
        $array = array_diff($productos, $formulas);
        echo json_encode($array, JSON_UNESCAPED_UNICODE);

        break;

    case '2': // Listar productos sin formula
        $sql = "SELECT * FROM materia_prima";
        $query = $conn->prepare($sql);
        $query->execute();
        $materia_prima = $query->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($materia_prima, JSON_UNESCAPED_UNICODE);

        break;

    case '3': //guardar formula
        $datos = $_POST['array'];
        $referencia = $_POST['ref_producto'];

        foreach ($datos as $dato) {
            $sql = "INSERT INTO formula (id_producto, id_materiaprima, porcentaje) VALUES(:referencia, :materiaprima, AES_ENCRYPT(:porcentaje,'Wf[Ht^}2YL=D^DPD'))";
            $query = $conn->prepare($sql);
            $query->execute(['referencia' => $referencia, 'materiaprima' => $dato[0], 'porcentaje' => $dato[2]]);
        }
        echo 1;

        break;
}
