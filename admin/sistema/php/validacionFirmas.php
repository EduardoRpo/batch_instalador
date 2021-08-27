<?php

use PhpOffice\PhpSpreadsheet\Calculation\Logical\Boolean;

if (!empty($_POST)) {
    require_once('../../../conexion.php');
    $batch = $_POST['batch'];

    if ($batch == 1) {
        $sql = "SELECT * FROM batch_control_firmas";
        $query = $conn->prepare($sql);
        $query->execute();
    } else {
        $sql = "SELECT * FROM batch_control_firmas WHERE batch = :batch ORDER BY modulo";
        $query = $conn->prepare($sql);
        $query->execute(['batch' => $batch]);
    }

    $firmas = $query->fetchAll(PDO::FETCH_ASSOC);
    $array = [];

    if (sizeof($firmas) != 9) {
        for ($i = 2; $i < 11; $i++) {
            $key = array_search($i, array_column($firmas, 'modulo'));
            $type = gettype($key);
            if ($type == 'boolean')
                if (!$key) {
                    $array['modulo'] = $i;
                    $array['cantidad_firmas'] = 0;
                    $array['total_firmas'] = 0;
                    array_push($firmas, $array);
                }
        }
        array_multisort(array_column($firmas, 'modulo'), SORT_ASC, $firmas);
    }
    echo json_encode($firmas, JSON_UNESCAPED_UNICODE);
}
