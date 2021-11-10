<?php
require_once('../../../conexion.php');

$sql = "SELECT batch.id_batch, ct.id_modulo,ct.temperatura, ct.humedad, ct.fecha 
        FROM batch LEFT JOIN batch_condicionesmedio ct ON batch.id_batch = ct.id_batch 
        WHERE batch.estado > 2 ORDER BY `batch`.`id_batch` ASC";
$query = $conn->prepare($sql);
$query->execute();
$condicionesMedio = $query->fetchAll(PDO::FETCH_ASSOC);
$modulos = array(2, 3, 4, 5, 6, 8, 9);
$batch = 21;
$array = [];

for ($i = 0; $i < sizeof($condicionesMedio); $i++) {
    $modulo = $condicionesMedio[$i]['id_modulo'];

    if ($batch == $condicionesMedio[$i]['id_batch']) {
        array_push($array, $modulo);
    } else {
        $moduloDif = array_diff($modulos, $array);
        if (sizeof($moduloDif) != 0)
            inserteCondiciones($conn, $i, $batch, $moduloDif);
        $batch = $condicionesMedio[$i]['id_batch'];
        $array = [];
        $moduloDif = [];
        $i--;
    }
}


function inserteCondiciones($conn, $i, $batch, $moduloDif)
{

    $modulofaltantes = array_values($moduloDif);
    for ($i = 0; $i < sizeof($moduloDif); $i++) {
        $modulo = $modulofaltantes[$i];

        $temperatura = rand(23.5, 24.8);
        $humedad = rand(61, 66);
        //$batch = $batch;
        //$modulo = $i;

        if ($modulo == 8)
            $sql = "SELECT b.id_batch, bm.fecha_registro, bm.modulo FROM batch b 
                    LEFT JOIN batch_analisis_microbiologico bm ON b.id_batch = bm.batch 
                    WHERE b.estado > 2 AND modulo = :modulo AND batch = :batch GROUP BY batch ORDER BY `b`.`id_batch` ASC";
        else
            $sql = "SELECT b.id_batch, f.fecha_registro, f.modulo FROM batch b 
            LEFT JOIN batch_firmas2seccion f ON b.id_batch = f.batch 
            WHERE b.estado > 2 AND modulo = :modulo AND batch = :batch GROUP BY batch ORDER BY `b`.`id_batch` ASC";

        $query = $conn->prepare($sql);
        $query->execute(['modulo' => $modulo, 'batch' => $batch]);
        $data = $query->fetch(PDO::FETCH_ASSOC);

        if ($data) {

            $fecha = $data['fecha_registro'];
            $sql = "SELECT * FROM batch_condicionesmedio WHERE id_batch = :batch AND id_modulo =:modulo";
            $query = $conn->prepare($sql);
            $query->execute(['batch' => $batch, 'modulo' => $modulo]);
            $rows = $query->rowCount();

            if ($rows == 0) {
                $sql = "INSERT INTO batch_condicionesmedio (fecha, temperatura, humedad, id_batch, id_modulo) 
                        VALUES(:fecha, :temperatura, :humedad, :id_batch, :id_modulo)";
                $query = $conn->prepare($sql);
                $query->execute(['fecha' => $fecha, 'temperatura' => $temperatura, 'humedad' => $humedad, 'id_batch' => $batch, 'id_modulo' => $modulo]);
            }
        }
    }
}
