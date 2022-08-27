<?php

if (!empty($_POST)) {
    require_once('../../conexion.php');
    require_once('./controlFirmas.php');
    require_once('./firmas.php');

    $op = $_POST['op'];
    $batch = $_POST['idBatch'];

    switch ($op) {
        case '1': //Consulta
            $modulo = $_POST['modulo'];

            /* $sql = "SELECT equipos.id, equipos.descripcion FROM equipos INNER JOIN batch_equipos ON batch_equipos.equipo = equipos.id
                    WHERE batch_equipos.batch = :batch AND modulo = :modulo";
            $query = $conn->prepare($sql);
            $query->execute(['batch' => $batch, 'modulo' => $modulo]);
            $equipos = $query->fetchAll(PDO::FETCH_ASSOC);

            if ($equipos) {

                $sql = "SELECT * FROM `batch_desinfectante_seleccionado` WHERE batch = :batch AND modulo = :modulo";
                $query = $conn->prepare($sql);
                $query->execute(['batch' => $batch, 'modulo' => $modulo]);
                $desinfectante = $query->fetchAll(PDO::FETCH_ASSOC);

                $sql = "SELECT * FROM `batch_analisis_microbiologico` WHERE batch = :batch";
                $query = $conn->prepare($sql);
                $query->execute(['batch' => $batch]);
                $analisis = $query->fetchAll(PDO::FETCH_ASSOC);


                $sql = "SELECT * FROM `usuario` WHERE id = :id";
                $query = $conn->prepare($sql);
                $query->execute(['id' => $analisis[0]['realizo']]);
                $result = $query->rowCount();
                $usuarioRealizo = $query->fetchAll(PDO::FETCH_ASSOC);

                if ($analisis[0]['verifico'] == 0)
                    $usuarioVerifico[] = 'false';
                else {
                    $sql = "SELECT * FROM `usuario` WHERE id = :id";
                    $query = $conn->prepare($sql);
                    $query->execute(['id' => $analisis[0]['verifico']]);
                    $usuarioVerifico = $query->fetchAll(PDO::FETCH_ASSOC);
                }


                $result = array_merge($desinfectante, $equipos, $analisis, $usuarioRealizo, $usuarioVerifico);
                echo json_encode($result, JSON_UNESCAPED_UNICODE);
            } */

            break;

        case 2: // Guardar
            $modulo = $_POST['modulo'];
            $dataMicrobiologia = json_decode($_POST['dataMicro'], true);

            /* Almacenar equipos */
            $sql = "SELECT * FROM `batch_equipos` WHERE batch = :batch AND modulo = :modulo";
            $query = $conn->prepare($sql);
            $query->execute(['batch' => $batch, 'modulo' => $modulo]);
            $rows = $query->rowCount();

            if ($rows == 0) {
                $sql = "INSERT INTO `batch_equipos`(equipo, batch, modulo) VALUES(:equipo, :batch, :modulo)";
                $query = $conn->prepare($sql);

                for ($i = 1; $i < 4; $i++) {
                    $query->execute([
                        'equipo' => $dataMicrobiologia[1]["equipo$i"],
                        'batch' => $batch, 'modulo' => $modulo
                    ]);
                }
                desinfectanteRealizo($conn);
            }
            analisisMicrobiologiaRealizo($conn);
            actualizarEstado($batch, $modulo, $conn);

            break;

        case '3': // Guardar firma calidad
            $modulo = $_POST['modulo'];
            /* validar que se haya cerrado fisicoquimico */

            $sql = "SELECT * FROM `batch_firmas2seccion` WHERE batch = :batch AND modulo = :modulo";
            $query = $conn->prepare($sql);
            $query->execute(['batch' => $batch, 'modulo' => 9]);
            $rows = $query->rowCount();

            if ($rows > 0) {
                $batch_fisicoquimco = $query->fetchAll(PDO::FETCH_ASSOC);
                if ($batch_fisicoquimco[0]['realizo'] > 0 && $batch_fisicoquimco[0]['verifico'] > 0) {
                    AnalisisMicrobiologiaVerifico($conn);
                    desinfectanteVerifico($conn);
                    cerrarEstado($batch, $modulo, $conn);
                } else
                    echo 'false';
            } else
                echo 'false';

            break;
    }
} else
    echo 'false';
