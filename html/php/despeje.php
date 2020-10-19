<?php
// Actualizar y Guardar data

if (!empty($_POST)) {

    require_once('../../conexion.php');
    require_once('../../admin/sistema/php/crud.php');


    $op = $_POST['operacion'];

    switch ($op) {
        case 1: //validar si el batch tiene informacion y cargarla

            $batch = $_POST['idbatch'];
            $modulo = $_POST['module'];

            $sql = "SELECT * FROM batch_solucion_pregunta WHERE id_batch= :batch AND id_modulo= :modulo";
            $query = $conn->prepare($sql);
            $query->execute(['batch' => $batch, 'modulo' => $modulo]);
            $rows = $query->rowCount();

            if ($rows > 0) {
                ejecutarSelect($conn, $query);
            }

            break;

        case 2:
            $batch = $_POST['idbatch'];
            $modulo = $_POST['module'];

            $sql = "SELECT d.desinfectante, d.observaciones, u.urlfirma 
                    FROM batch_desinfectante_seleccionado d 
                    INNER JOIN usuario u ON u.id = d.realizo
                    WHERE modulo = :modulo AND batch = :batch";
                    
            $query = $conn->prepare($sql);
            $query->execute(['batch' => $batch, 'modulo' => $modulo]);
            $rows = $query->rowCount();

            if ($rows > 0) {
                ejecutarSelect1($query);
            }

            break;

        case 3: //Almacenar datos de despeje de lineas de proceso

            $respuestas = $_POST['respuestas'];
            $modulo = $_POST['modulo'];
            $batch = $_POST['batch'];
            $desinfectante = $_POST['desinfectante'];
            $observaciones = $_POST['observaciones'];
            $realizo = $_POST['realizo'];


            $sql = "SELECT * FROM batch_solucion_pregunta WHERE id_batch= :batch AND id_modulo= :modulo";
            $query = $conn->prepare($sql);
            $query->execute(['batch' => $batch, 'modulo' => $modulo]);
            $rows = $query->rowCount();

            if ($rows > 0) {
                echo '2';
                /* foreach ($respuestas as $valor) {
                    foreach ($valor as $item) {
                        $sql = "UPDATE batch_solucion_pregunta SET solucion = :solucion 
                WHERE id_pregunta= :pregunta AND id_modulo= :modulo AND id_batch= :batch";
                        $query = $conn->prepare($sql);
                        $result = $query->execute([
                            'solucion' => $item["solucion"],
                            'pregunta' => $item["pregunta"],
                            'modulo' => $item["modulo"],
                            'batch' => $item["batch"],
                        ]);

                        if ($result) {
                            echo '3';
                            exit();
                        }
                    }
                }

                $sql = "UPDATE batch_desinfectante_seleccionado SET desinfectante = :desinfectante,  observaciones = :observaciones, modulo = :modulo, batch = :batch
                        WHERE id_pregunta= :pregunta AND id_modulo= :modulo AND id_batch= :batch";
                $query = $conn->prepare($sql);
                $result = $query->execute([
                    'desinfectante' => $desinfectante,
                    'observaciones' => $observaciones,
                    'modulo' => $modulo,
                    'batch' => $batch,
                ]);

                if ($result) {
                    echo '3';
                    exit();
                } */
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
    }
}
