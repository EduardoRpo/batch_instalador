<?php

if (!empty($_POST)) {
    require_once('../../conexion.php');
    require_once('../../admin/sistema/php/crud.php');

    $op = $_POST['operacion'];

    switch ($op) {
        case 1: // listar incidencias

            $query = "SELECT * FROM incidencias_motivo";
            ejecutarQuerySelect($conn, $query);

            break;
        case 2: //almacenar incidencias
            $incidencias = $_POST['incidencias'];

            print_r($incidencias);

        break;
    }
}
