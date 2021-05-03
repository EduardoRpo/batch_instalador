<?php

// Actualizar y Guardar data 1ra seccion

if (!empty($_POST)) {

    require_once('../../conexion.php');
    require_once('../../admin/sistema/php/crud.php');


    $op = $_POST['operacion'];

    switch ($op) {
        case 1: //validar si el batch tiene informacion y cargarla

            $batch = $_POST['idBatch'];
            $modulo = $_POST['modulo'];

            $sql = "SELECT * FROM batch_solucion_pregunta WHERE id_batch= :batch AND id_modulo= :modulo";
            $query = $conn->prepare($sql);
            $query->execute(['batch' => $batch, 'modulo' => $modulo]);
            $rows = $query->rowCount();

            if ($rows > 0) {
                ejecutarSelect($conn, $query);
            }

            break;

        case 2: // cargar 1ra firma despeje
            $batch = $_POST['idBatch'];
            $modulo = $_POST['modulo'];

            $sql = "SELECT d.desinfectante, d.observaciones, u.urlfirma FROM batch_desinfectante_seleccionado d 
                    INNER JOIN usuario u ON u.id = d.realizo WHERE modulo = :modulo AND batch = :batch";

            $query = $conn->prepare($sql);
            $query->execute(['batch' => $batch, 'modulo' => $modulo]);
            $rows = $query->rowCount();

            if ($rows > 0)
                ejecutarSelect1($query);

            break;

        case 3: // cargar 2da firma despeje
            $batch = $_POST['idBatch'];
            $modulo = $_POST['modulo'];

            $sql = "SELECT u.urlfirma 
                    FROM batch_desinfectante_seleccionado d 
                    INNER JOIN usuario u ON u.id = d.verifico
                    WHERE modulo = :modulo AND batch = :batch";

            $query = $conn->prepare($sql);
            $query->execute(['batch' => $batch, 'modulo' => $modulo]);
            $rows = $query->rowCount();

            if ($rows > 0) {
                ejecutarSelect1($query);
            }
            break;
        case 4: //Almacenar datos y firma 1ra seccion

            $respuestas = $_POST['respuestas'];
            $desinfectante = $_POST['desinfectante'];
            $observaciones = $_POST['observaciones'];
            $realizo = $_POST['realizo'];
            $modulo = $_POST['modulo'];
            $batch = $_POST['idBatch'];

            $sql = "SELECT * FROM batch_solucion_pregunta WHERE id_batch= :batch AND id_modulo= :modulo";
            $query = $conn->prepare($sql);
            $query->execute([
                'batch' => $batch,
                'modulo' => $modulo
            ]);

            $rows = $query->rowCount();

            if ($rows > 0) {
                echo '2';
            } else {
                foreach ($respuestas as $valor) {
                    foreach ($valor as $item) {
                        $sql = "INSERT INTO batch_solucion_pregunta (solucion, id_pregunta, id_modulo, id_batch) 
                        VALUES(:solucion, :id_pregunta, :id_modulo, :id_batch)";
                        $query = $conn->prepare($sql);
                        $result = $query->execute([
                            'solucion' => $item["solucion"],
                            'id_pregunta' => $item["pregunta"],
                            'id_modulo' => $item["modulo"],
                            'id_batch' => $item["batch"],
                        ]);
                        ejecutarQuery($result, $conn);
                    }
                }
                $sql = "INSERT INTO batch_desinfectante_seleccionado (desinfectante, observaciones, modulo, batch, realizo) 
                VALUES(:desinfectante, :observaciones, :modulo, :batch, :realizo)";
                $query = $conn->prepare($sql);
                $result = $query->execute([
                    'desinfectante' => $desinfectante,
                    'observaciones' => $observaciones,
                    'modulo' => $modulo,
                    'batch' => $batch,
                    'realizo' => $realizo,
                ]);
                ejecutarQuery($result, $conn);
            }
            break;
        case 5: // almacenar firma calidad 1ra seccion

            $modulo = $_POST['modulo'];
            $batch = $_POST['idBatch'];
            $verifico = $_POST['verifico'];

            $sql = "UPDATE batch_desinfectante_seleccionado SET verifico = :verifico
                    WHERE modulo= :modulo AND batch= :batch";
            $query = $conn->prepare($sql);
            $result = $query->execute([
                'modulo' => $modulo,
                'batch' => $batch,
                'verifico' => $verifico,
            ]);

            if ($result) {
                echo '1';
            }

            break;
    }
}
