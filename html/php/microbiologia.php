<?php

if (!empty($_POST)) {

    $op = $_POST['op'];

    switch ($op) {
        case '1': //Consulta

            break;
        case 2: // Guardar

            $dataMicrobiologia = $_POST['dataMicro'];
            $modulo = $_POST['modulo'];
            $batch = $_POST['batch'];

            /* Almacenar equipos */
            for ($i = 1; $i < sizeof($dataMicrobiologia[0]['equipos']); $i++) {
                $sql = "INSERT INTO `batch_equipos`(equipo, batch, modulo) VALUES(:equipo, :batch, :modulo)";
                $query = $conn->prepare($sql);
                $query->execute(['equipo' => $equipo[$i], 'batch' => $batch, 'modulo' => $modulo]);
            }




            $sql = "SELECT * FROM `instructivo_preparacion` WHERE id_producto = :referencia";
            $query = $conn->prepare($sql);
            $query->execute(['referencia' => $referencia]);
            $result = $query->rowCount();

            if ($result > 0) {
                $data = $query->fetch(PDO::FETCH_ASSOC);
                $arreglo[] = $data;
                echo json_encode($arreglo, JSON_UNESCAPED_UNICODE);
            }

            break;
    }
} else
    echo 'false';
