<?php

if (!empty($_POST)) {

    require_once('../../../conexion.php');
    require_once('../actualizarEstado.php');

    $op = $_POST['operacion'];

    switch ($op) {
        case '1': // Almacenar parciales
            $unidades = $_POST['unidades'];
            $retencion = $_POST['retencion'];
            $cajas = $_POST['cajas'];
            $mov = $_POST['mov'];
            $modulo = $_POST['modulo'];
            $batch = $_POST['idBatch'];
            $ref_multi = $_POST['ref_multi'];
            $realizo = $_POST['realizo'];

            $sql = "SELECT * FROM batch_conciliacion_parciales WHERE modulo = :modulo AND batch = :batch AND ref_multi = :ref_multi";
            $query = $conn->prepare($sql);
            $query->execute(['modulo' => $modulo, 'batch' => $batch, 'ref_multi' => $ref_multi]);
            $data = $query->fetchAll(PDO::FETCH_ASSOC);

            if ($modulo == 6) {
                if ($data) $retencion = 0;

                $sql = "INSERT INTO batch_conciliacion_parciales (unidades, retencion, cajas, movimiento, modulo, batch, ref_multi, realizo) 
                        VALUES(:unidades, :retencion, :cajas, :movimiento, :modulo, :batch, :ref_multi, :realizo)";
                $query = $conn->prepare($sql);
                $query->execute([
                    'unidades' => $unidades,
                    'retencion' => $retencion,
                    'cajas' => $cajas,
                    'movimiento' => $mov,
                    'modulo' => $modulo,
                    'batch' => $batch,
                    'ref_multi' => $ref_multi,
                    'realizo' => $realizo
                ]);
                actualizarEstado($batch, $modulo, $conn);
            } else {
                $sql = "INSERT INTO batch_conciliacion_parciales (unidades, cajas, movimiento, modulo, batch, ref_multi, realizo) 
                        VALUES(:unidades, :cajas, :movimiento, :modulo, :batch, :ref_multi, :realizo)";
                $query = $conn->prepare($sql);
                $query->execute([
                    'unidades' => $unidades,
                    'cajas' => $cajas,
                    'movimiento' => $mov,
                    'modulo' => $modulo,
                    'batch' => $batch,
                    'ref_multi' => $ref_multi,
                    'realizo' => $realizo
                ]);
            }

            $sql = "SELECT * FROM batch_conciliacion_parciales WHERE batch = :batch AND ref_multi = :ref_multi AND modulo = :modulo";
            $query = $conn->prepare($sql);
            $query->execute(['batch' => $batch, 'ref_multi' => $ref_multi, 'modulo' => $modulo]);
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            break;

        case '2':
            $sql = "SELECT * FROM batch_conciliacion_parciales WHERE batch = :batch AND ref_multi = :ref_multi";
            $query = $conn->prepare($sql);
            $query->execute(['batch' => $batch, 'ref_multi' => $ref_multi]);
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            break;
    }
}
