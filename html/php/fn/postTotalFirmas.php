<?php
require_once('../../../conexion.php');

$sql = "SELECT DISTINCT batch FROM batch_control_firmas";
$query = $conn->prepare($sql);
$query->execute();
$batchFirmas = $query->fetchAll(PDO::FETCH_ASSOC);

foreach ($batchFirmas as $batchFirma) {

    $sql = "SELECT * FROM multipresentacion WHERE id_batch = :batch";
    $query = $conn->prepare($sql);
    $query->execute(['batch' => $batchFirma['batch']]);
    $batchMulti = $query->fetchAll(PDO::FETCH_ASSOC);
    $rows = $query->rowCount();

    for ($i = 2; $i < 11; $i++) {

        switch ($i) {
            case '2':
                $total_firmas = 4;
                break;
            case '3':
                $total_firmas = 4;
                break;
            case '4':
                $total_firmas = 2;
                break;
            case '5':
                $rows == 0 ? $total_firmas = 6 : $total_firmas = ($rows * 4) + 2;
                break;
            case '6':
                $rows == 0 ? $total_firmas = 7 : $total_firmas = ($rows * 5) + 2;
                break;
            case '7':
                $rows == 0 ? $total_firmas = 1 : $total_firmas = $rows;
                break;
            case '8':
                $total_firmas = 2;
                break;
            case '9':
                $total_firmas = 2;
                break;
            case '10':
                $total_firmas = 3;
                break;
        }

        $sql = "UPDATE batch_control_firmas SET total_firmas = :total_firmas WHERE batch = :batch AND modulo = :modulo";
        $query = $conn->prepare($sql);
        $query->execute(['total_firmas' => $total_firmas, 'batch' => $batchFirma['batch'], 'modulo' => $i]);
    }
}
