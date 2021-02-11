<?php
require_once('../../conexion.php');
require_once('../../admin/sistema/php/crud.php');

$op = $_POST['operacion'];

switch ($op) {
    case 1:
        $query = "SELECT * FROM batch";
        ejecutarQuerySelect($conn, $query);
        break;

    case 2:
        $id = $_POST['id'];
        $sql = "SELECT p.referencia, p.nombre_referencia, m.nombre as marca, pp.nombre as propietario, p.presentacion_comercial as presentacion, ns.nombre as notificacion, b.numero_orden, b.numero_lote, b.fecha_creacion, b.tamano_lote, b.unidad_lote, b.lote_presentacion 
                FROM batch b 
                INNER JOIN producto p ON p.referencia= b.id_producto 
                INNER JOIN marca m ON m.id = p.id_marca 
                INNER JOIN propietario pp ON pp.id = p.id_propietario 
                INNER JOIN notificacion_sanitaria ns ON ns.id = p.id_notificacion_sanitaria 
                WHERE id_batch = :id";
        $query = $conn->prepare($sql);
        $query->execute(['id' => $id,]);

        $data = $query->fetch(PDO::FETCH_ASSOC);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);

        break;

    case 3:

        $id = $_POST['id'];
        $modulo = $_POST['modulo'];

        $sql = "SELECT p.pregunta, bsp.solucion 
                FROM batch_solucion_pregunta bsp
                INNER JOIN preguntas p ON p.id = bsp.id_pregunta
                WHERE id_batch = :id AND id_modulo= :modulo";

        $query = $conn->prepare($sql);
        $query->execute(['id' => $id, 'modulo' => $modulo]);

        while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
            $arreglo[] = $data;
        }

        echo json_encode($arreglo, JSON_UNESCAPED_UNICODE);

        break;

    case 4:

        $modulo = $_POST['modulo'];

        $sql = "SELECT descripcion
                FROM area_desinfeccion
                WHERE modulo= :modulo";

        $query = $conn->prepare($sql);
        $query->execute(['modulo' => $modulo]);

        while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
            $arreglo[] = $data;
        }
        echo json_encode($arreglo, JSON_UNESCAPED_UNICODE);

        break;

    case 5:

        $modulo = $_POST['modulo'];
        $batch = $_POST['id'];

        $sql = "SELECT d.nombre as desinfectante, d.concentracion FROM desinfectante d 
                INNER JOIN batch_desinfectante_seleccionado bds ON bds.desinfectante = d.id 
                WHERE modulo = :modulo AND bds.batch = :batch";

        $query = $conn->prepare($sql);
        $query->execute(['modulo' => $modulo, 'batch' => $batch]);

        $data = $query->fetch(PDO::FETCH_ASSOC);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        
        break;

    case 6:

        $id = $_POST['id'];
        $modulo = $_POST['modulo'];

        $sql = "SELECT fecha, temperatura, humedad 
                    FROM batch_condicionesmedio
                    WHERE id_batch = :id AND id_modulo= :modulo";

        $query = $conn->prepare($sql);
        $query->execute(['id' => $id, 'modulo' => $modulo]);
        $data = $query->fetch(PDO::FETCH_ASSOC);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);

        break;

    default:

        break;
}
