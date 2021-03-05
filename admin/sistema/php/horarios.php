<?php
if (!empty($_POST)) {
    require_once('../../../conexion.php');
    require_once('./crud.php');

    $op = $_POST['operacion'];

    switch ($op) {
        case 1: //listar horario
            $query = "SELECT * FROM horarios_batch ORDER BY id";
            $result = $conn->query($query);

            //Almacena la data en array
            while ($data = $result->fetch(PDO::FETCH_ASSOC)) {
                $arreglo[] = $data;
            }
            if (empty($arreglo)) {
                echo '0';
                exit();
            }

            echo json_encode($arreglo, JSON_UNESCAPED_UNICODE);
            break;

        case 2: //Eliminar horario
            $id = $_POST['id'];
            $sql = "DELETE FROM tanques WHERE id = :id";
            ejecutarEliminar($conn, $sql, $id);
            break;

        case 3: // Guardar y Actualizar
            $tiempos = $_POST['tiempos'];

            /* Buscar */
            $sql = "SELECT * FROM horarios_batch";
            $query = $conn->prepare($sql);
            $query->execute();
            $rows = $query->fetchColumn();


            if ($rows > 0) {
                /* Actualizar */
                $id = 1;
                foreach ($tiempos as $tiempo) {
                    $sql = "UPDATE horarios_batch SET hora = :hora WHERE id = :id";
                    $query = $conn->prepare($sql);
                    $result = $query->execute(['hora' => $tiempo, 'id' => $id]);
                    $id++;
                }
            } else {
                foreach ($tiempos as $tiempo) {
                    $sql = "INSERT INTO horarios_batch SET hora = :hora ";
                    $query = $conn->prepare($sql);
                    $result = $query->execute(['hora' => $tiempo]);
                }
            }

            if ($result)
                echo '1';
            break;
    }
}
