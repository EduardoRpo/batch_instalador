
<?php
/* Almacena los checks creados para tanques y su valor */

if (!empty($_POST)) {

    require_once('../../conexion.php');
    require_once('../../admin/sistema/php/crud.php');

    $op = $_POST['operacion'];

    switch ($op) {
        case 1:
            $tanques = $_POST['tanques'];
            $tanquesOk = $_POST['tanquesOk'];
            $batch = $_POST['idBatch'];
            $modulo = $_POST['modulo'];

            /* revisar si existen un registro del modulo y batch para actualizar o insertar */

            $sql = "SELECT * FROM batch_tanques_chks  
                    WHERE modulo = :modulo AND batch = :batch";
            $query = $conn->prepare($sql);
            $result = $query->execute([
                'modulo' => $modulo,
                'batch' => $batch,
            ]);
            $rows = $query->rowCount();

            /* Si existe un registro actualiza de lo contrario lo inserta */

            if ($rows > 0) {
                $sql = "UPDATE batch_tanques_chks SET tanquesOk =:tanquesOk 
                        WHERE modulo = :modulo AND batch = :batch";
                $query = $conn->prepare($sql);
                $result = $query->execute([
                    'tanquesOk' => $tanquesOk,
                    'modulo' => $modulo,
                    'batch' => $batch,
                ]);
                if ($result)
                    echo '1';
                else
                    echo '0';
            } else {
                $sql = "INSERT INTO batch_tanques_chks (tanques, tanquesOk, modulo, batch) 
                        VALUES(:tanques, :tanquesOk, :modulo, :batch)";
                $query = $conn->prepare($sql);
                $result = $query->execute([
                    'tanques' => $tanques,
                    'tanquesOk' => $tanquesOk,
                    'modulo' => $modulo,
                    'batch' => $batch,
                ]);
                if ($result)
                    echo '1';
                else
                    echo '0';
            }

            break;

        case 2:
            $batch = $_POST['idBatch'];
            $modulo = $_POST['modulo'];

            $sql = "SELECT * FROM batch_tanques_chks  
                    WHERE modulo = :modulo AND batch = :batch";
            $query = $conn->prepare($sql);
            $result = $query->execute([
                'modulo' => $modulo,
                'batch' => $batch,
            ]);
            if ($result > 0) {
                $data = $query->fetch(PDO::FETCH_ASSOC);
                $arreglo[] = $data;
                echo json_encode(utf8ize($arreglo), JSON_UNESCAPED_UNICODE);
            }
            break;
        case 3:

            $batch = $_POST['idBatch'];
            $modulo = $_POST['modulo'];

            $sql = "SELECT * FROM batch_firmas2seccion  
                    WHERE modulo = :modulo AND batch = :batch";
            $query = $conn->prepare($sql);
            $result = $query->execute([
                'modulo' => $modulo,
                'batch' => $batch,
            ]);
            if ($result > 0) {
                $data = $query->fetch(PDO::FETCH_ASSOC);
                $arreglo[] = $data;
                echo json_encode(utf8ize($arreglo), JSON_UNESCAPED_UNICODE);
            }
            break;
        case 4: // cargar 2da firma despeje
            $batch = $_POST['idBatch'];
            $modulo = $_POST['modulo'];

            $sql = "SELECT u.urlfirma 
                    FROM batch_firmas2seccion d 
                    INNER JOIN usuario u ON u.id = d.realizo
                    WHERE modulo = :modulo AND batch = :batch";

            $query = $conn->prepare($sql);
            $query->execute(['batch' => $batch, 'modulo' => $modulo]);
            $rows = $query->rowCount();

            if ($rows > 0) {
                ejecutarSelect1($query);
            }

            break;
    }
}


?>


