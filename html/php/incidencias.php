<?php

if (!empty($_POST)) {
    require_once('../../conexion.php');
    require_once('../../admin/sistema/php/crud.php');
    require_once('./actualizarEstado.php');
    require_once('./controlFirmas.php');
    $op = $_POST['operacion'];

    switch ($op) {
        case 1: // listar incidencias
            $query = "SELECT * FROM incidencias_motivo";
            ejecutarQuerySelect($conn, $query);
            break;

        case 2: //almacenar incidencias
            $incidencias = $_POST['incidencias'];
            $realizo = $_POST['firma'];
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
            //segundaSeccion($conn, $observaciones, $realizo, $batch, $modulo);
            $sql = "INSERT INTO batch_firmas2seccion (observaciones, modulo, batch, realizo) 
            VALUES (:observaciones, :modulo, :batch, :realizo)";
            $query = $conn->prepare($sql);
            $result = $query->execute(['realizo' => $realizo, 'modulo' => $modulo, 'batch' => $batch, 'observaciones' => $observaciones]);
            registrarFirmas($conn, $batch, $modulo);
            break;

        case 3: //Almacenar firma 2da seccion sin incidencias  REVISAR PUNTUALMENTE NO DEBERIA ESTAR GUARDANDO ESTE ITEM
            $realizo = $_POST['firma'];
            $modulo = $_POST['modulo'];
            $batch = $_POST['batch'];

            $sql = "INSERT INTO batch_firmas2seccion (modulo, batch, realizo) VALUES (:modulo, :batch, :realizo)";
            $query = $conn->prepare($sql);
            $result = $query->execute(['realizo' => $realizo, 'modulo' => $modulo, 'batch' => $batch,]);
            actualizarEstado($batch, $modulo, $conn);
            registrarFirmas($conn, $batch, $modulo);
            break;

        case 4: //Almacenar firma 2da seccion calidad 
            $verifico = $_POST['firma'];
            $modulo = $_POST['modulo'];
            $batch = $_POST['batch'];

            $sql = "UPDATE batch_firmas2seccion SET verifico =:verifico WHERE modulo =:modulo AND batch =:batch";
            $query = $conn->prepare($sql);
            $result = $query->execute(['verifico' => $verifico, 'modulo' => $modulo, 'batch' => $batch,]);
            cerrarEstado($batch, $modulo, $conn);
            registrarFirmas($conn, $batch, $modulo);
            if ($result) echo '1';
            else echo '0';
            break;
    }
}
