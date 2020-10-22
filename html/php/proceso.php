<?php

// Actualizar y Guardar data 1ra seccion

if (!empty($_POST)) {

    require_once('../../conexion.php');
    require_once('../../admin/sistema/php/crud.php');


    $op = $_POST['operacion'];

    switch ($op) {
        case 1:  // seleccionar firmas 2ra seccion

            $batch = $_POST['batch'];
            $modulo = $_POST['modulo'];

            $sql = "SELECT u.urlfirma 
                    FROM batch_firmas2seccion f 
                    INNER JOIN usuario u ON u.id = f.realizo 
                    WHERE batch= :batch AND modulo= :modulo";

            $query = $conn->prepare($sql);
            $query->execute(['batch' => $batch, 'modulo' => $modulo]);
            $rows = $query->rowCount();

            if ($rows > 0) {
                ejecutarSelect($conn, $query);
            }

            break;
        
    }
}
