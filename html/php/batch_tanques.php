
<?php
if (!empty($_POST)) {
    require_once('../../conexion.php');
    require_once('../../admin/sistema/php/crud.php');
    require_once('actualizarEstado.php');
    require_once('./controlFirmas.php');
    require_once('./firmas.php');

    /* Almacena los checks creados para tanques y su valor */
    $op = $_POST['operacion'];

    switch ($op) {
        case 1: //Insertar o actualizar tanques y linea
            $batch = $_POST['idBatch'];
            $modulo = $_POST['modulo'];

            if ($modulo != 9) {
                $tanques = $_POST['tanques'];
                $tanquesOk = $_POST['tanquesOk'];

                /* revisar si existen un registro del modulo y batch para actualizar o insertar */

                $sql = "SELECT * FROM batch_tanques_chks WHERE modulo = :modulo AND batch = :batch";
                $query = $conn->prepare($sql);
                $result = $query->execute(['modulo' => $modulo, 'batch' => $batch,]);
                $rows = $query->rowCount();

                /* Si existe un registro actualiza de lo contrario lo inserta */

                if ($rows > 0) {
                    $sql = "UPDATE batch_tanques_chks SET tanquesOk =:tanquesOk WHERE modulo = :modulo AND batch = :batch";
                    $query = $conn->prepare($sql);
                    $result = $query->execute(['tanquesOk' => $tanquesOk, 'modulo' => $modulo, 'batch' => $batch]);
                    if ($modulo == 2 || $modulo == 3 || $modulo == 4) actualizarEstado($batch, $modulo, $conn);
                    if ($result) echo '1';
                    else echo '0';
                } else {
                    $sql = "INSERT INTO batch_tanques_chks (tanques, tanquesOk, modulo, batch) VALUES(:tanques, :tanquesOk, :modulo, :batch)";
                    $query = $conn->prepare($sql);
                    $result = $query->execute(['tanques' => $tanques, 'tanquesOk' => $tanquesOk, 'modulo' => $modulo, 'batch' => $batch]);

                    /* Actualiza el estado de los modulo pesaje, preparacion y aprobacion */
                    if ($modulo == 2 || $modulo == 3 || $modulo == 4) actualizarEstado($batch, $modulo, $conn);
                    if ($result) echo '1';
                    else echo '0';
                }
            }

            if ($modulo == 3) {
                $equipos = $_POST['equipos'];

                foreach ($equipos as $equipo) {
                    $sql = "INSERT INTO batch_equipos (equipo, batch, modulo) VALUES(:equipo, :batch, :modulo)";
                    $query = $conn->prepare($sql);
                    $result = $query->execute(['equipo' => $equipo, 'batch' => $batch, 'modulo' => $modulo]);
                }

                if ($result) echo '1';
                else echo '0';
            }


            /* Almacena el desinfectante del modulo de aprobacion y fisicoquimico */

            if ($modulo == 4 || $modulo == 9) {
                desinfectanteRealizo($conn);
                segundaSeccionRealizo($conn);
            }

            /* Almacena el formulario de control del módulo de preparación */

            if ($modulo == 3 || $modulo == 4 || $modulo == 9) {
                $controlProducto = $_POST['controlProducto'];

                $sql = "INSERT INTO batch_control_especificaciones (color, olor, apariencia, ph, viscosidad, densidad, untuosidad, espumoso, alcohol, modulo, batch) 
                        VALUES(:color, :olor, :apariencia, :ph, :viscosidad, :densidad, :untuosidad, :espumoso, :alcohol, :modulo, :batch)";
                $query = $conn->prepare($sql);
                $result = $query->execute([
                    'color' => $controlProducto[0],
                    'olor' => $controlProducto[1],
                    'apariencia' => $controlProducto[2],
                    'ph' => $controlProducto[3],
                    'viscosidad' => $controlProducto[4],
                    'densidad' => $controlProducto[5],
                    'untuosidad' => $controlProducto[6],
                    'espumoso' => $controlProducto[7],
                    'alcohol' => $controlProducto[8],
                    'modulo' => $modulo,
                    'batch' => $batch,
                ]);
                if ($result) echo '1';
                else echo '0';
            }
            /* Actualiza estado  modulo fisicoquimico */
            if ($modulo == 9)
                actualizarEstado($batch, $modulo, $conn);

            break;

        case 2: //Seleccionar toda la informacion de los tanques
            $batch = $_POST['idBatch'];
            $modulo = $_POST['modulo'];

            if ($modulo != 9) {
                $sql = "SELECT * FROM batch_tanques_chks WHERE modulo = :modulo AND batch = :batch";
                $query = $conn->prepare($sql);
                $result = $query->execute(['modulo' => $modulo, 'batch' => $batch]);
                if ($result > 0) {
                    $data = $query->fetch(PDO::FETCH_ASSOC);
                    $arreglo[] = $data;
                    echo json_encode($arreglo, JSON_UNESCAPED_UNICODE);
                }
            } else {
                echo '1';
            }
            break;

        case 3: //Seleccionar 2da firma

            $batch = $_POST['idBatch'];
            $modulo = $_POST['modulo'];

            $sql = "SELECT * FROM batch_firmas2seccion WHERE modulo = :modulo AND batch = :batch";
            $query = $conn->prepare($sql);
            $result = $query->execute(['modulo' => $modulo, 'batch' => $batch]);
            if ($result > 0) {
                $data = $query->fetch(PDO::FETCH_ASSOC);
                $arreglo[] = $data;
                echo json_encode($arreglo, JSON_UNESCAPED_UNICODE);
            }

            break;

        case 4: // cargar 2da firma despeje
            $batch = $_POST['idBatch'];
            $modulo = $_POST['modulo'];

            $sql = "SELECT u.urlfirma as realizo, us.urlfirma as verifico FROM batch_firmas2seccion d 
                    INNER JOIN usuario u ON u.id = d.realizo INNER JOIN usuario us ON us.id = d.verifico
                    WHERE modulo = :modulo AND batch = :batch";

            $query = $conn->prepare($sql);
            $query->execute(['batch' => $batch, 'modulo' => $modulo]);
            $rows = $query->rowCount();

            if ($rows > 0) {
                ejecutarSelect1($query);
            } else {

                $sql = "SELECT u.urlfirma as realizo
                FROM batch_firmas2seccion d 
                INNER JOIN usuario u ON u.id = d.realizo
                WHERE modulo = :modulo AND batch = :batch";

                $query = $conn->prepare($sql);
                $query->execute(['batch' => $batch, 'modulo' => $modulo]);
                $rows = $query->rowCount();

                if ($rows > 0) ejecutarSelect1($query);
                else echo 0;
            }

            break;
    }
}
