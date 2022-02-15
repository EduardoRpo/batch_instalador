<?php
require_once('../../../conexion.php');
require_once('./crud.php');
require_once('../../../html/php/estadoInicial.php');
require_once('actualizarBatch.php');

$op = $_POST['operacion'];

switch ($op) {
    case 1: //listar referencias Productos
        $sql = "SELECT p.referencia FROM producto p ORDER BY p.referencia";
        $query = $conn->prepare($sql);
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        break;

    case 2: //Obtener nombre producto
        $referencia = $_POST['referencia'];
        $sql = "SELECT p.referencia, p.nombre_referencia FROM producto p WHERE referencia = :referencia";
        $query = $conn->prepare($sql);
        $query->execute(['referencia' => $referencia]);
        $data = $query->fetch(PDO::FETCH_ASSOC);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);

        break;

    case 3: //Listar Formula
        $referencia = $_POST['referencia'];

        if ($referencia != 1) {
            $query = "SELECT f.id_producto, f.id_materiaprima as referencia, m.alias as alias, m.nombre, cast(AES_DECRYPT(porcentaje, 'Wf[Ht^}2YL=D^DPD') as char)porcentaje 
                      FROM formula f INNER JOIN materia_prima m ON f.id_materiaprima=m.referencia 
                      WHERE f.id_producto = :referencia";
            $query = $conn->prepare($query);
            $query->execute(['referencia' => $referencia]);
        } else {
            $query = "SELECT f.id_producto, f.id_materiaprima as referencia, m.alias as alias, m.nombre, cast(AES_DECRYPT(porcentaje, 'Wf[Ht^}2YL=D^DPD') as char)porcentaje 
                    FROM formula f INNER JOIN materia_prima m ON f.id_materiaprima=m.referencia";
            $query = $conn->prepare($query);
            $query->execute();
        }

        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);

        break;

    case 4: //Referencias Materias Primas
        $tb = $_POST['tb'];
        $tb == 'r' ? $tb = 'materia_prima' : $tb = 'materia_prima_f';
        $sql = "SELECT referencia FROM $tb";
        $query = $conn->prepare($sql);
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        break;

    case 5: //Obtener Materia Prima y Alias
        $referencia = $_POST['referencia'];
        $tbl = $_POST['tbl'];
        $tbl == 'r' ? $tbl = 'materia_prima' : $tbl = 'materia_prima_f';

        $sql = "SELECT * FROM $tbl WHERE referencia = :referencia";
        $query = $conn->prepare($sql);
        $query->execute(['referencia' => $referencia]);
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        break;

    case 6: // Guardar data Formula
        if (!empty($_POST)) {
            $id_producto = $_POST['ref_producto'];
            $id_materiaprima = $_POST['ref_materiaprima'];
            $porcentaje = $_POST['porcentaje'];
            $tbl = $_POST['tbl'];
            $tbl == 'r' ? $tbl = 'formula' : $tbl = 'formula_f';


            if ($tbl == 'formula') {
                $sql = "SELECT * FROM $tbl WHERE id_materiaprima = :id_materiaprima AND id_producto = :id_producto";
                $query = $conn->prepare($sql);
                $query->execute(['id_materiaprima' => $id_materiaprima, 'id_producto' => $id_producto]);
                $rows = $query->rowCount();

                if ($rows > 0) {
                    $ref_multi = findmulti($conn, $id_producto);
                    if ($ref_multi == null) {
                        $sql = "UPDATE $tbl SET porcentaje = AES_ENCRYPT(:porcentaje,'Wf[Ht^}2YL=D^DPD') WHERE id_materiaprima = :id_materiaprima AND id_producto = :id_producto";
                        $query = $conn->prepare($sql);
                        $query->execute(['id_materiaprima' => $id_materiaprima, 'id_producto' => $id_producto, 'porcentaje' => $porcentaje]);
                        echo '3';
                    } else {
                        for ($i = 0; $i < sizeof($ref_multi); $i++) {
                            $sql = "UPDATE $tbl SET porcentaje = AES_ENCRYPT(:porcentaje,'Wf[Ht^}2YL=D^DPD') WHERE id_materiaprima = :id_materiaprima AND id_producto = :id_producto";
                            $query = $conn->prepare($sql);
                            $result = $query->execute(['id_materiaprima' => $id_materiaprima, 'id_producto' => $ref_multi[$i]['referencia'], 'porcentaje' => $porcentaje]);
                        }
                        echo '3';
                    }
                } else {
                    $ref_multi = findmulti($conn, $id_producto);
                    if ($ref_multi == null) {
                        $sql = "INSERT INTO $tbl (id_producto, id_materiaprima, porcentaje) VALUES (:id_producto, :id_materiaprima, AES_ENCRYPT(:porcentaje,'Wf[Ht^}2YL=D^DPD') )";
                        $query = $conn->prepare($sql);
                        $result = $query->execute(['id_materiaprima' => $id_materiaprima, 'id_producto' => $id_producto, 'porcentaje' => $porcentaje]);
                    } else {
                        for ($i = 0; $i < sizeof($ref_multi); $i++) {
                            $sql = "INSERT INTO $tbl (id_producto, id_materiaprima, porcentaje) VALUES (:id_producto, :id_materiaprima, AES_ENCRYPT(:porcentaje,'Wf[Ht^}2YL=D^DPD') )";
                            $query = $conn->prepare($sql);
                            $result = $query->execute(['id_materiaprima' => $id_materiaprima, 'id_producto' => $ref_multi[$i]['referencia'], 'porcentaje' => $porcentaje]);
                        }
                    }
                    /* Valida si existen batch sin formula y actualiza */
                    if ($tbl == 'materia_prima') {
                        $result = estadoInicial($conn, $id_producto, $fechaprogramacion = "");
                        $result = ActualizarBatch($conn, $result, $id_producto);
                    }
                    if ($result) echo '1';
                }
            } else {

                $sql = "SELECT id_notificacion_sanitaria as id FROM producto WHERE referencia = :referencia";
                $query = $conn->prepare($sql);
                $query->execute(['referencia' => $id_producto]);
                $notif_sanitaria = $query->fetch(PDO::FETCH_ASSOC);

                $sql = "SELECT * FROM $tbl WHERE id_materiaprima = :id_materiaprima AND notif_sanitaria = :notif_sanitaria";
                $query = $conn->prepare($sql);
                $query->execute(['id_materiaprima' => $id_materiaprima, 'notif_sanitaria' => $notif_sanitaria['id']]);
                $rows = $query->rowCount();

                if ($rows > 0) {
                    $sql = "UPDATE $tbl SET porcentaje = AES_ENCRYPT(:porcentaje,'Wf[Ht^}2YL=D^DPD') WHERE id_materiaprima = :id_materiaprima AND notif_sanitaria = :notif_sanitaria";
                    $query = $conn->prepare($sql);
                    $result = $query->execute(['id_materiaprima' => $id_materiaprima, 'notif_sanitaria' => $notif_sanitaria['id'], 'porcentaje' => $porcentaje]);
                    echo '3';
                } else {
                    $sql = "INSERT INTO $tbl (notif_sanitaria, id_materiaprima, porcentaje) VALUES (:notif_sanitaria, :id_materiaprima, AES_ENCRYPT(:porcentaje,'Wf[Ht^}2YL=D^DPD') )";
                    $query = $conn->prepare($sql);
                    $result = $query->execute(['id_materiaprima' => $id_materiaprima, 'notif_sanitaria' => $notif_sanitaria['id'], 'porcentaje' => $porcentaje]);

                    /* Valida si existen batch sin formula y actualiza */
                    if ($tbl == 'materia_prima') {
                        $result = estadoInicial($conn, $id_producto, $fechaprogramacion = "");
                        $result = ActualizarBatch($conn, $result, $id_producto);
                    }
                    if ($result) echo '1';
                }
            }
        }
        break;

    case 7: // Guardar data tabla fantasma
        if (!empty($_POST)) {

            $id_producto = $_POST['ref_producto'];
            $id_materiaprima = $_POST['ref_materiaprima'];
            $porcentaje = $_POST['porcentaje'];

            $sql = "SELECT * FROM formula_f WHERE id_materiaprima = :id_materiaprima AND id_producto = :id_producto";
            $query = $conn->prepare($sql);
            $query->execute(['id_materiaprima' => $id_materiaprima, 'id_producto' => $id_producto]);
            $rows = $query->rowCount();

            if ($rows > 0) {
                $sql = "UPDATE formula_f SET porcentaje=:porcentaje WHERE id_materiaprima = :id_materiaprima AND id_producto = :id_producto";
                $query = $conn->prepare($sql);
                $result = $query->execute([
                    'porcentaje' => $porcentaje,
                    'id_materiaprima' => $id_materiaprima,
                    'id_producto' => $id_producto,
                ]);

                if ($result)
                    echo '3';
            } else {
                $sql = "INSERT INTO formula_f (id_producto, id_materiaprima, porcentaje) VALUES (:id_producto, :id_materiaprima, :porcentaje )";
                $query = $conn->prepare($sql);
                $result = $query->execute(['id_producto' => $id_producto, 'id_materiaprima' => $id_materiaprima, 'porcentaje' => $porcentaje,]);
                if ($result)
                    echo '1';
            }
        }
        break;

    case 8: //Eliminar
        $ref_materiaprima = $_POST['ref_materiaprima'];
        $ref_producto = $_POST['ref_producto'];
        //$id = $_POST['id'];

        $tbl = $_POST['tbl'];
        $tbl == 'r' ? $tbl = 'formula' : $tbl = 'formula_f';

        if ($tbl == 'formula') {
            $ref_multi = findmulti($conn, $ref_producto);

            if ($ref_multi == null) {
                $sql = "DELETE FROM $tbl WHERE id_producto = :ref_producto AND id_materiaprima = :ref_materiaprima";
                $query = $conn->prepare($sql);
                $result = $query->execute(['ref_producto' => $ref_producto, 'ref_materiaprima' => $ref_materiaprima]);
            } else {
                for ($i = 0; $i < sizeof($ref_multi); $i++) {
                    $sql = "DELETE FROM $tbl WHERE id_producto = :ref_producto AND id_materiaprima = :ref_materiaprima";
                    $query = $conn->prepare($sql);
                    $result = $query->execute(['ref_producto' => $ref_multi[$i]['referencia'], 'ref_materiaprima' => $ref_materiaprima]);
                }
            }
        } else {

            $sql = "SELECT id_notificacion_sanitaria as id FROM producto WHERE referencia = :referencia";
            $query = $conn->prepare($sql);
            $query->execute(['referencia' => $ref_producto]);
            $notif_sanitaria = $query->fetch(PDO::FETCH_ASSOC);

            $sql = "DELETE FROM $tbl WHERE notif_sanitaria = :notif_sanitaria AND id_materiaprima = :ref_materiaprima";
            $query = $conn->prepare($sql);
            $result = $query->execute(['notif_sanitaria' => $notif_sanitaria['id'], 'ref_materiaprima' => $ref_materiaprima]);
        }


        if ($result) {
            echo '1';
        } else {
            die('Error');
            print_r('Error: ');
        }

        break;
    case 9: //Listar Formula fantasma
        $referencia = $_POST['referencia'];

        $sql = "SELECT id_notificacion_sanitaria as id FROM producto WHERE referencia = :referencia";
        $query = $conn->prepare($sql);
        $query->execute(['referencia' => $referencia]);
        $notif_sanitaria = $query->fetch(PDO::FETCH_ASSOC);

        $sql = "SELECT f.id_materiaprima as referencia, m.nombre as nombre, m.alias as alias, cast(AES_DECRYPT(f.porcentaje, 'Wf[Ht^}2YL=D^DPD') as char)porcentaje 
                FROM formula_f f INNER JOIN materia_prima_f m ON f.id_materiaprima = m.referencia 
                WHERE notif_sanitaria = :notificacion";
        $query = $conn->prepare($sql);
        $query->execute(['notificacion' => $notif_sanitaria['id']]);
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);

        break;
}

function findmulti($conn, $ref_producto)
{
    $sql = "SELECT multi FROM producto WHERE referencia = :referencia";
    $query = $conn->prepare($sql);
    $query->execute(['referencia' => $ref_producto]);
    $multi = $query->fetch(PDO::FETCH_ASSOC);

    if ($multi['multi'] != 0) {
        $sql = "SELECT referencia FROM producto WHERE multi = :multi";
        $query = $conn->prepare($sql);
        $query->execute(['multi' => $multi['multi']]);
        $ref_multi = $query->fetchAll(PDO::FETCH_ASSOC);
        return $ref_multi;
    }
}
