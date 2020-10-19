<?php

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

                    if ($result) {
                        echo '1';
                    }else
                    echo '0';
                }
            }
            break;
    }
}
