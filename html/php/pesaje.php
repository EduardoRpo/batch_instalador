<?php
// Actualizar y Guardar data

if (!empty($_POST)) {

    require_once('../../conexion.php');
    require_once('../../admin/sistema/php/crud.php');


    $op = $_POST['operacion'];

    switch ($op) {
        case 1: //validar si el batch tiene informacion y cargarla
            
            $modulo = $_POST['modulo'];
            $batch = $_POST['batch'];
            
            $sql = "SELECT * FROM solucion_pregunta WHERE id_batch= :batch AND id_modulo= :modulo";
            $query = $conn->prepare($sql);
            $query->execute(['batch' => $batch, 'modulo' => $modulo]);
            $rows = $query->rowCount();
            

            break;
        case 2: //Almacenar datos de despeje de lineas de proceso

            $respuestas = $_POST['respuestas'];
            $modulo = $_POST['modulo'];
            $batch = $_POST['batch'];
            $desinfectante = $_POST['desinfectante'];
            $observaciones = $_POST['observaciones'];


            $sql = "SELECT * FROM solucion_pregunta WHERE id_batch= :batch AND id_modulo= :modulo";
            $query = $conn->prepare($sql);
            $query->execute(['batch' => $batch, 'modulo' => $modulo]);
            $rows = $query->rowCount();

            if ($rows > 0) {
                foreach ($respuestas as $valor) {
                    foreach ($valor as $item) {
                        $sql = "UPDATE solucion_pregunta SET solucion = :solucion 
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

                $sql = "UPDATE desinfectante_sel SET desinfectante = :desinfectante,  observaciones = :observaciones, modulo = :modulo, batch = :batch
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
                }
            } else {
                foreach ($respuestas as $valor) {
                    foreach ($valor as $item) {
                        $sql = "INSERT INTO solucion_pregunta (solucion, id_pregunta, id_modulo, id_batch) 
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
                $sql = "INSERT INTO desinfectante_sel (desinfectante, observaciones, modulo, batch) 
                VALUES(:desinfectante, :observaciones, :modulo, :batch)";
                $query = $conn->prepare($sql);
                $result = $query->execute([
                    'desinfectante' => $desinfectante,
                    'observaciones' => $observaciones,
                    'modulo' => $modulo,
                    'batch' => $batch,
                ]);
                ejecutarQuery($result, $conn);
            }
            break;
    }
}
