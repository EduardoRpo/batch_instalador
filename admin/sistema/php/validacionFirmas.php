<?php

use PhpOffice\PhpSpreadsheet\Calculation\Logical\Boolean;

if (!empty($_POST)) {
    require_once('../../../conexion.php');
    $batch = $_POST['batch'];

    if ($batch == 1) {

        $sql = "SELECT * FROM batch_control_firmas GROUP BY batch, modulo;";
        $query = $conn->prepare($sql);
        $query->execute();
    } else {

        /* Busca el batch requerido */

        $sql = "SELECT estado FROM batch WHERE id_batch = :batch";
        $query = $conn->prepare($sql);
        $query->execute(['batch' => $batch]);
        $batch_estado = $query->fetch(PDO::FETCH_ASSOC);

        /* Valida que el batch no haya sido eliminado */

        if ($batch_estado['estado'] != 0) {
            $sql = "SELECT * FROM batch_control_firmas WHERE batch = :batch AND id != 0 ORDER BY modulo";
            $query = $conn->prepare($sql);
            $query->execute(['batch' => $batch]);
        } else
            exit();
    }

    $firmas = $query->fetchAll(PDO::FETCH_ASSOC);
    $array = [];

    /* valida si el batch tiene multipresentacion y cuantas son */
    $sql = "SELECT * FROM multipresentacion WHERE id_batch = :batch";
    $query = $conn->prepare($sql);
    $query->execute(['batch' => $batch]);
    $rows = $query->rowCount();

    $rows > 0 ? $rows : $rows = 1;

    /* Calcula el total de firmas por cada batch */

    if (sizeof($firmas) != 9) {
        for ($i = 2; $i < 11; $i++) {
            $key = array_search($i, array_column($firmas, 'modulo'));
            $type = gettype($key);
            if ($type == 'boolean')
                if (!$key) {
                    $array['modulo'] = $i;
                    if ($i == 5)
                        $total_firmas = (4 * $rows) + 2;
                    if ($i == 6)
                        $total_firmas = (5 * $rows) + 2;
                    if ($i == 7)
                        $total_firmas = 1 * $rows;
                    if ($i == 8)
                        $total_firmas = 2;
                    if ($i == 9)
                        $total_firmas = 2;
                    if ($i == 10)
                        $total_firmas = 3;

                    $array['cantidad_firmas'] = 0;
                    $array['total_firmas'] = $total_firmas;
                    array_push($firmas, $array);
                }
        }
        array_multisort(array_column($firmas, 'modulo'), SORT_ASC, $firmas);
    }
    echo json_encode($firmas, JSON_UNESCAPED_UNICODE);
}
