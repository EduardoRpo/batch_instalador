<?php

if (!empty($_POST)) {
    require_once('../../conexion.php');
    require_once('../../admin/sistema/php/crud.php');
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
                    $batch =  $incidencia['batch'];
                    $modulo =  $incidencia['modulo'];

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

            $sql = "INSERT INTO batch_incidencias_observaciones (observacion, batch, modulo) 
                            VALUES (:observacion, :batch, :modulo)";
            $query = $conn->prepare($sql);
            $result = $query->execute([
                'observacion' => $observaciones,
                'batch' => $batch,
                'modulo' => $modulo,
            ]);

            if (!$result)
                exit();

            //Almacenado de firmas con incidencias
            segundaSeccionRealizo($conn);
            break;

        case 3: //Almacenar firma 2da seccion sin incidencias
            $modulo = $_POST['modulo'];
            $batch = $_POST['idBatch'];
            segundaSeccionRealizo($conn);

            break;

        case 4: //Almacenar firma 2da seccion calidad 

            $modulo = $_POST['modulo'];
            $batch = $_POST['idBatch'];
            if ($modulo == 4 || $modulo == 9) desinfectanteVerifico($conn);
            segundaSeccionVerifico($conn);

            break;
    }
}
