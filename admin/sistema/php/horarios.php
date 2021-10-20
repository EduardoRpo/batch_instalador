<?php
if (!empty($_POST)) {
    require_once('../../../conexion.php');
    require_once('./crud.php');

    $op = $_POST['operacion'];

    switch ($op) {
        case 1: //listar horario
            $query = "SELECT * FROM horarios_batch ORDER BY id";
            $query = $conn->prepare($query);
            $query->execute();
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);

            break;

        case 2: //Eliminar horario
            $id = $_POST['id'];
            $sql = "DELETE FROM tanques WHERE id = :id";
            ejecutarEliminar($conn, $sql, $id);
            break;

        case 3: // Guardar y Actualizar
            $tiempos = $_POST['tiempos'];

            /* Buscar */
            $sql = "DELETE FROM horarios_batch";
            $query = $conn->prepare($sql);
            $query->execute();

            $sql = "ALTER TABLE horarios_batch AUTO_INCREMENT = 1";
            $query = $conn->prepare($sql);
            $query->execute();

            foreach ($tiempos as $tiempo) {
                $sql = "INSERT INTO horarios_batch SET tiempo = :hora ";
                $query = $conn->prepare($sql);
                $result = $query->execute(['hora' => $tiempo]);
            }

            if ($result)
                echo '1';
            break;
    }
}
