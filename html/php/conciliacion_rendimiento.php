<?php
if (!empty($_POST)) {
    require_once('../../conexion.php');
    require_once('./controlFirmas.php');
    require_once('./firmas.php');

    $op = $_POST['operacion'];
    $batch =  $_POST['idBatch'];

    if (!empty($_POST['ref_multi']))
        $referencia = $_POST['ref_multi'];

    switch ($op) {
        case 1: //almacenar conciliacion
            $retencion =  $_POST['retencion'];
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

            break;

        case 2:
            $sql = "SELECT c.unidades_producidas, c.muestras_retencion, c.mov_inventario, u.urlfirma 
                    FROM batch_conciliacion_rendimiento c INNER JOIN usuario u ON u.id = c.entrego
                    WHERE batch = :batch AND ref_multi = :referencia";
            $query = $conn->prepare($sql);
            $query->execute(['batch' => $batch, 'referencia' => $referencia,]);

            while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
                $arreglo[] = $data;
            }
            if (empty($arreglo)) {
                echo '0';
                exit();
            }

            echo json_encode($arreglo, JSON_UNESCAPED_UNICODE);

            break;

        case 3: //almacenar conciliacion

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
            $query->execute([
                'batch' => $batch,
                'referencia' => $referencia,
                'modulo' => $modulo,
            ]);

            while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
                $arreglo[] = $data;
            }
            if (empty($arreglo)) {
                echo '0';
                exit();
            }

            echo json_encode($arreglo, JSON_UNESCAPED_UNICODE);

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
