<?php

require_once('../../conexion.php');
require_once('./controlFirmas.php');

if (!empty($_POST)) {
    $batch = $_POST['idBatch'];
    $op = $_POST['op'];

    switch ($op) {
        case '1':
            $btn = $_POST['id'];

            if ($btn == 'tecnica_realizado') {
                $sql = "SELECT * FROM batch_control_firmas WHERE batch = :batch AND modulo = :modulo";
                $query = $conn->prepare($sql);
                $query->execute(['batch' => $batch, 'modulo' => 7]);
                $data = $query->fetch(PDO::FETCH_ASSOC);

                if ($data['cantidad_firmas'] != $data['total_firmas']) {
                    echo 1;
                    exit;
                }
            }

            $sql = "SELECT * FROM batch_liberacion WHERE batch = :batch";
            $query = $conn->prepare($sql);
            $query->execute(['batch' => $batch]);
            $result = $query->rowCount();

            if ($result > 0) {
                $user = $_POST['info'];
                $btn = $_POST['id'];

                if ($btn == 'produccion_realizado')
                    $sql = "UPDATE batch_liberacion SET dir_produccion = :realizo WHERE batch = :batch";

                if ($btn == 'calidad_verificado')
                    $sql = "UPDATE batch_liberacion SET dir_calidad = :realizo WHERE batch = :batch";

                if ($btn == 'tecnica_realizado')
                    $sql = "UPDATE batch_liberacion SET dir_tecnica = :realizo WHERE batch = :batch";

                $query = $conn->prepare($sql);
                $query->execute(['batch' => $batch, 'realizo' => $user['id']]);
            } else {
                $user = $_POST['info'];
                $btn = $_POST['id'];
                $aprobacion = $_POST['radio'];
                $observaciones = $_POST['obs'];

                if ($btn == 'produccion_realizado') {
                    $produccion = $user['id'];
                    $calidad = 0;
                    $tecnica = 0;
                }

                if ($btn == 'calidad_verificado') {
                    $produccion = 0;
                    $calidad = $user['id'];
                    $tecnica = 0;
                }

                if ($btn == 'tecnica_realizado') {
                    $produccion = 0;
                    $calidad = 0;
                    $tecnica = $user['id'];
                }

                $sql = "INSERT INTO batch_liberacion (aprobacion, observaciones, dir_produccion, dir_calidad, dir_tecnica, batch) 
                        VALUES(:aprobacion, :observaciones, :produccion, :calidad, :tecnica, :batch)";

                $query = $conn->prepare($sql);
                $query->execute([
                    'aprobacion' => $aprobacion,
                    'observaciones' => $observaciones,
                    'produccion' => $produccion,
                    'calidad' => $calidad,
                    'tecnica' => $tecnica,
                    'batch' => $batch,
                ]);
            }
            registrarFirmas($conn, $batch, 10);

            break;

        case '2':
            $sql = "SELECT bl.aprobacion, bl.observaciones, u.urlfirma AS produccion, us.urlfirma AS calidad, usu.urlfirma AS tecnica 
            FROM batch_liberacion bl LEFT JOIN usuario u ON u.id = bl.dir_produccion LEFT JOIN usuario us ON us.id = bl.dir_calidad 
            LEFT JOIN usuario usu ON usu.id = bl.dir_tecnica WHERE batch = :batch";
            $query = $conn->prepare($sql);
            $query->execute(['batch' => $batch]);
            $data = $query->fetch(PDO::FETCH_ASSOC);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);

            break;
    }
}
