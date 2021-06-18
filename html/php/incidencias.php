<?php

if (!empty($_POST)) {
    require_once('../../conexion.php');
    require_once('../../admin/sistema/php/crud.php');
    require_once('./actualizarEstado.php');
    require_once('./controlFirmas.php');
    require_once('./firmas.php');

    $op = $_POST['operacion'];

    switch ($op) {
        case 1: // listar incidencias
            $query = "SELECT * FROM incidencias_motivo";
            ejecutarQuerySelect($conn, $query);
            break;

        case 2: //almacenar incidencias
            $incidencias = $_POST['incidencias'];
            $realizo = $_POST['firma'];
            $observaciones = $_POST['observaciones'];
            $datos = json_decode($incidencias, true);

            foreach ($datos as $valor) {
                foreach ($valor as $i => $incidencia) {

                    $sql = "INSERT INTO batch_incidencias (incidencia, motivo, modulo, batch) 
                            VALUES (:incidencia, :motivo, :modulo, :batch)";
                    $query = $conn->prepare($sql);
                    $result = $query->execute([
                        'incidencia' => $incidencia['incidencia'],
                        'motivo' => $incidencia['motivo'],
                        'modulo' => $incidencia['modulo'],
                        'batch' => $incidencia['batch'],
                    ]);
                }
            }

            if (!$result)
                exit();

            //Almacenado de firmas con incidencias
            segundaSeccionRealizo($conn);
            break;

        case 3: //Almacenar firma 2da seccion sin incidencias
            $modulo = $_POST['modulo'];
            $batch = $_POST['idBatch'];
            segundaSeccionRealizo($conn);
            actualizarEstado($batch, $modulo, $conn);

            break;

        case 4: //Almacenar firma 2da seccion calidad 

            $modulo = $_POST['modulo'];
            $batch = $_POST['idBatch'];
            if ($modulo == 4 || $modulo == 9) desinfectanteVerifico($conn);
            segundaSeccionVerifico($conn);
            cerrarEstado($batch, $modulo, $conn);

            break;
    }
}
