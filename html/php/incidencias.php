<?php
/* namespace BatchRecord\dao;
use BatchRecord\dao\BatchDao; */

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
            $firma = $_POST['firma'];
            $modulo = $_POST['modulo'];
            $batch = $_POST['idBatch'];
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

            $sql = "INSERT INTO batch_firmas2seccion (observaciones, modulo, batch, realizo) 
            VALUES (:observaciones, :modulo, :batch, :realizo)";
            $query = $conn->prepare($sql);
            $result = $query->execute([
                'realizo' => $firma,
                'modulo' => $modulo,
                'batch' => $batch,
                'observaciones' => $observaciones,
            ]);

            switch ($modulo) {
                case '2':
                    $estado = 4;
                    break;
                case '3':
                    $estado = 6;
                    break;
                case '4':
                    $estado = 8;
                    break;
                case '5':
                    $estado = 10;
                    break;
                case '6':
                    $estado = 12;
                    break;
                default:
                    $estado = 14;
                    break;
            }


            //Modifica el estado de acuerdo con el modulo
            $sql = "UPDATE batch SET estado = :estado WHERE id_batch = :batch";
            $query = $conn->prepare($sql);
            $query->execute(['batch' => $batch, 'estado' => $estado]);

            if ($result) {
                echo '1';
            } else
                echo '0';

            break;

        case 3: //Almacenar firma 2da seccion sin incidencias
            $firma = $_POST['firma'];
            $modulo = $_POST['modulo'];
            $batch = $_POST['idBatch'];


            $sql = "INSERT INTO batch_firmas2seccion (modulo, batch, realizo) 
                    VALUES (:modulo, :batch, :realizo)";

            $query = $conn->prepare($sql);
            $result = $query->execute([
                'realizo' => $firma,
                'modulo' => $modulo,
                'batch' => $batch,
            ]);

            switch ($modulo) {
                case '2':
                    $estado = 4;
                    break;
                case '3':
                    $estado = 6;
                    break;
                case '4':
                    $estado = 8;
                    break;
                case '5':
                    $estado = 10;
                    break;
                case '6':
                    $estado = 12;
                    break;
                default:
                    $estado = 14;
                    break;
            }


            //Modifica el estado de acuerdo con el modulo
            $sql = "UPDATE batch SET estado = :estado WHERE id_batch = :batch";
            $query = $conn->prepare($sql);
            $query->execute(['batch' => $batch, 'estado' => $estado]);

            if ($result) {
                echo '1';
            } else
                echo '0';
            break;

        case 4: //Almacenar firma 2da seccion calidad 
            $firma = $_POST['firma'];
            $modulo = $_POST['modulo'];
            $batch = $_POST['batch'];

            $sql = "UPDATE batch_firmas2seccion SET verifico =:firma WHERE modulo =:modulo AND batch =:batch";
            $query = $conn->prepare($sql);
            $result = $query->execute([
                'firma' => $firma,
                'modulo' => $modulo,
                'batch' => $batch,
            ]);

            if ($result) {
                echo '1';
            } else
                echo '0';

            break;
    }
}
