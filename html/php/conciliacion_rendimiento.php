<?php
if (!empty($_POST)) {
    require_once('../../conexion.php');
    require_once('./controlFirmas.php');
    require_once('./firmas.php');
    require_once('../php/actualizarEstado.php');

    $op = $_POST['operacion'];
    $batch =  $_POST['idBatch'];

    if (!empty($_POST['ref_multi']))
        $referencia = $_POST['ref_multi'];

    switch ($op) {
        case 1: //almacenar conciliacion
            $modulo = $_POST['modulo'];
            $modulo == 6 ? $retencion =  $_POST['retencion'] : $retencion = 0;
            conciliacionRendimientoRealizo($conn);

            /* Almacenar muestras retencion */

            $sql = "SELECT MAX(muestra) as consecutivo FROM  batch_muestras_retencion";
            $query = $conn->prepare($sql);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);

            if ($data['consecutivo'] == null)
                $muestra = 1;
            else
                $muestra = $data['consecutivo'] + 1;

            for ($i = 1; $i < $retencion; $i++) {
                $sql = "INSERT INTO batch_muestras_retencion SET referencia = :referencia, muestra = :muestra,  batch = :batch";
                $query = $conn->prepare($sql);
                $query->execute(['referencia' => $referencia, 'muestra' => $muestra, 'batch' => $batch]);
                $muestra = $muestra + 1;
            }
            actualizarEstado($batch, $modulo, $conn);
            break;

        case 2: // cargar batch Conciliacion
            $modulo = $_POST['modulo'];
            $sql = "SELECT c.unidades_producidas, c.muestras_retencion, c.mov_inventario, u.urlfirma 
                    FROM batch_conciliacion_rendimiento c INNER JOIN usuario u ON u.id = c.entrego
                    WHERE batch = :batch AND ref_multi = :referencia AND modulo = :modulo";
            $query = $conn->prepare($sql);
            $query->execute(['batch' => $batch, 'referencia' => $referencia, 'modulo' => $modulo]);
            $data = $query->fetch(PDO::FETCH_ASSOC);

            if (empty($data)) {
                $sql = "SELECT SUM(unidades) AS unidades_producidas, SUM(retencion) AS muestras_retencion, movimiento AS mov_inventario
                        FROM batch_conciliacion_parciales 
                        WHERE batch = :batch AND ref_multi = :referencia AND modulo = :modulo";
                $query = $conn->prepare($sql);
                $query->execute(['batch' => $batch, 'referencia' => $referencia, 'modulo' => $modulo]);
                $data = $query->fetch(PDO::FETCH_ASSOC);
            }

            echo json_encode($data, JSON_UNESCAPED_UNICODE);

            break;

        case 3: //almacenar conciliacion
            $modulo = $_POST['modulo'];
            $unidades =  $_POST['unidades'];
            $cajas =  $_POST['cajas'];
            $movimiento =  $_POST['mov'];
            $observaciones = $_POST['obs'];
            $modulo = $_POST['modulo'];
            $batch = $_POST['idBatch'];
            $referencia = $_POST['ref_multi'];
            $entrego = $_POST['idfirma'];

            $sql = "INSERT INTO batch_conciliacion_rendimiento 
                    SET unidades_producidas = :unidades, cajas = :cajas, mov_inventario = :movimiento, observaciones = :observaciones,
                    batch = :batch, modulo = :modulo, ref_multi = :referencia, entrego = :entrego";
            $query = $conn->prepare($sql);
            $query->execute([
                'unidades' => $unidades,
                'cajas' => $cajas,
                'movimiento' => $movimiento,
                'observaciones' => $observaciones,
                'batch' => $batch,
                'modulo' => $modulo,
                'referencia' => $referencia,
                'entrego' => $entrego,
            ]);

            registrarFirmas($conn, $batch, $modulo);
            break;

        case 4:
            $modulo = $_POST['modulo'];
            $sql = "SELECT c.unidades_producidas, c.muestras_retencion, c.mov_inventario, c.cajas, c.observaciones,u.urlfirma 
                        FROM batch_conciliacion_rendimiento c
                        INNER JOIN usuario u ON u.id = c.entrego
                        WHERE batch = :batch AND ref_multi = :referencia AND modulo = :modulo";
            $query = $conn->prepare($sql);
            $query->execute(['batch' => $batch, 'referencia' => $referencia, 'modulo' => $modulo]);
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);

            break;

        case 5:

            $sql = "SELECT c.unidades_producidas, c.muestras_retencion, c.mov_inventario, c.cajas, u.urlfirma, CONCAT(u.nombre, ' ', u.apellido) as nombre, modulo FROM batch_conciliacion_rendimiento c INNER JOIN usuario u ON u.id = c.entrego WHERE batch = :batch";
            $query = $conn->prepare($sql);
            $query->execute(['batch' => $batch]);
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);

            break;
    }
}
