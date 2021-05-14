<?php

if (!empty($_POST)) {
    require_once('../../conexion.php');
    $op = $_POST['op'];
    $batch = $_POST['idBatch'];

    switch ($op) {
        case '1': //Consulta
            $sql = "SELECT equipos.id, equipos.descripcion FROM equipos INNER JOIN batch_equipos ON batch_equipos.equipo = equipos.id
                    WHERE batch_equipos.batch = :batch";
            $query = $conn->prepare($sql);
            $query->execute(['batch' => $batch]);
            $result = $query->rowCount();

            if ($result > 0)
                $equipos = $query->fetchAll(PDO::FETCH_ASSOC);

            $sql = "SELECT * FROM `batch_analisis_microbiologico` WHERE batch = :batch";
            $query = $conn->prepare($sql);
            $query->execute(['batch' => $batch]);
            $result = $query->rowCount();

            if ($result > 0)
                $analisis = $query->fetchAll(PDO::FETCH_ASSOC);

            $sql = "SELECT * FROM `usuario` WHERE id = :id";
            $query = $conn->prepare($sql);
            $query->execute(['id' => $analisis[0]['realizo']]);
            $result = $query->rowCount();

            if ($result > 0)
                $usuarioRealizo = $query->fetchAll(PDO::FETCH_ASSOC);

            if ($analisis[0]['verifico'] == 0) {
                $usuarioVerifico[] = 'false';
            } else {
                $sql = "SELECT * FROM `usuario` WHERE id = :id";
                $query = $conn->prepare($sql);
                $query->execute(['id' => $analisis[0]['verifico']]);
                $result = $query->rowCount();

                if ($result > 0)
                    $usuarioVerifico = $query->fetchAll(PDO::FETCH_ASSOC);
            }

            $result = array_merge($equipos, $analisis, $usuarioRealizo, $usuarioVerifico);
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            break;

        case 2: // Guardar
            $modulo = $_POST['modulo'];
            $dataMicrobiologia = $_POST['dataMicro'];
            $realizo = $_POST['info'];

            /* Almacenar equipos */
            $sql = "INSERT INTO `batch_equipos`(equipo, batch, modulo) VALUES(:equipo, :batch, :modulo)";
            $query = $conn->prepare($sql);

            for ($i = 1; $i < 4; $i++) {
                $query->execute(['equipo' => $dataMicrobiologia[0]["equipo$i"], 'batch' => $batch, 'modulo' => $modulo]);
            }

            $sql = "INSERT INTO `batch_analisis_microbiologico`(mesofilos, pseudomona, escherichia, staphylococcus, fecha_siembra, fecha_resultados, realizo, batch, modulo) 
                    VALUES(:mesofilos, :pseudomona, :escherichia, :staphylococcus, :fecha_siembra, :fecha_resultados, :realizo, :batch, :modulo)";
            $query = $conn->prepare($sql);
            $result = $query->execute([
                'mesofilos' => $dataMicrobiologia[0]["mesofilos"],
                'pseudomona' => $dataMicrobiologia[0]["pseudomona"],
                'escherichia' => $dataMicrobiologia[0]["escherichia"],
                'staphylococcus' => $dataMicrobiologia[0]["staphylococcus"],
                'fecha_siembra' => $dataMicrobiologia[0]["fechaSiembra"],
                'fecha_resultados' => $dataMicrobiologia[0]["fechaResultados"],
                'realizo' => $realizo[0]["id"],
                'batch' => $batch,
                'modulo' => $modulo
            ]);

            if ($result) echo 'true';
            else echo 'false';
            break;

        case '3': // Guardar firma calidad
            $verifico = $_POST['verifico'];
            $batch = $_POST['idBatch'];

            $sql = "UPDATE `batch_analisis_microbiologico` SET verifico = :verifico WHERE batch = :batch";
            $query = $conn->prepare($sql);
            $result = $query->execute(['verifico' => $verifico, 'batch' => $batch]);
            if ($result) echo 'true';

            break;
    }
} else
    echo 'false';
