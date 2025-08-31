<?php

if (!empty($_POST)) {
    require_once('../../conexion.php');
    require_once('../../admin/sistema/php/crud.php');
    require_once('./controlFirmas.php');
    require_once('./firmas.php');
    require_once('./aprobadoOk.php');

    $op = $_POST['operacion'];

    switch ($op) {
        case 1: // listar incidencias
            $query = "SELECT * FROM incidencias_motivo";
            ejecutarQuerySelect($conn, $query);
            break;

        case 2: //almacenar incidencias
            $batch =  $_POST['idBatch'];
            $modulo =  $_POST['modulo'];

            $incidencias = $_POST['incidencias'];
            //$realizo = $_POST['firma'];
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

            $sql = "INSERT INTO batch_incidencias_observaciones (observaciones, batch, modulo) 
                    VALUES (:observaciones, :batch, :modulo)";
            $query = $conn->prepare($sql);
            $result = $query->execute([
                'observaciones' => trim(ucfirst(strtolower($observaciones))),
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
            $result = 1;

            if ($modulo == 2 || $modulo == 3) {
                //desinfectanteVerifico($conn);
                segundaSeccionVerifico($conn);
            }

            if ($modulo == 4 || $modulo == 9) {
                $result = 0;
                /* Validacion que todas las firmas de pesaje este completas*/
                $sql = "SELECT * FROM batch_control_firmas WHERE batch = :batch";
                $query = $conn->prepare($sql);
                $query->execute(['batch' => $batch]);
                $data = $query->fetchAll(PDO::FETCH_ASSOC);

                if ($modulo == 4) {
                    $modulo1 = 2;
                    $modulo2 = 3;
                }

                if ($modulo == 9) {
                    $modulo1 = 5;
                    $modulo2 = 6;
                }

                for ($i = 0; $i < sizeof($data); $i++) {
                    if ($data[$i]['modulo'] == $modulo1 && $data[$i]['cantidad_firmas'] == $data[$i]['total_firmas'])
                        if ($data[$i + 1]['modulo'] == $modulo2 && $data[$i + 1]['cantidad_firmas'] == $data[$i + 1]['total_firmas']) {
                            /* actualizar estado si todos las firmas esten completas */
                            if ($modulo != 9)
                                actualizarEstado($batch, $modulo, $conn);
                            desinfectanteVerifico($conn);
                            segundaSeccionVerifico($conn);
                            updateBatchAprobado($batch, $conn);
                            $result = 1;
                        }
                }
            }

            // Siempre devolver JSON válido
            echo json_encode(['success' => true, 'result' => $result]);
            break;
    }
}
