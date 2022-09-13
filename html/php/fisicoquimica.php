<?php

if (!empty($_POST)) {
    require_once('../../conexion.php');

    $batch = $_POST['idBatch'];
    $modulo = $_POST['modulo'];

    $sql = "SELECT * FROM batch_desinfectante_seleccionado WHERE modulo = :modulo AND batch = :batch";
    $query = $conn->prepare($sql);
    $query->execute(['modulo' => $modulo, 'batch' => $batch]);
    $desinfectante = $query->fetch(PDO::FETCH_ASSOC);
    
    if ($desinfectante > 0) {

        $sql = "SELECT bf.observaciones as obsBatch, u.urlfirma as f_realizo, us.urlfirma as f_verifico FROM batch_firmas2seccion bf 
                INNER JOIN usuario u ON u.id = bf.realizo INNER JOIN usuario us ON us.id = bf.verifico 
                WHERE modulo = :modulo AND batch = :batch";
        $query = $conn->prepare($sql);
        $query->execute(['modulo' => $modulo, 'batch' => $batch]);
        $result = $query->rowCount();
        
        if ($result == 0) {
            $sql = "SELECT bf.observaciones as obsBatch,u.urlfirma as f_realizo FROM batch_firmas2seccion bf 
                    INNER JOIN usuario u ON u.id = bf.realizo WHERE modulo = :modulo AND batch = :batch";
            $query = $conn->prepare($sql);
            $query->execute(['modulo' => $modulo, 'batch' => $batch]);
            $segundaSeccion = $query->fetch(PDO::FETCH_ASSOC);
        } else
            $segundaSeccion = $query->fetch(PDO::FETCH_ASSOC);

        $data = array_merge($desinfectante, $segundaSeccion);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
}
