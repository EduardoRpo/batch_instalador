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
        /* $modulo = $_POST['modulo']; */

        $sql = "SELECT p.pregunta, bsp.solucion, bsp.id_modulo 
                FROM batch_solucion_pregunta bsp
                INNER JOIN preguntas p ON p.id = bsp.id_pregunta
                WHERE id_batch = :id
                ORDER BY bsp.id_modulo";

        $query = $conn->prepare($sql);
        $query->execute(['id' => $id/* , 'modulo' => $modulo */]);

        while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
            $arreglo[] = $data;
        }

        echo json_encode($arreglo, JSON_UNESCAPED_UNICODE);

        break;

    case 4:

        $query = "SELECT descripcion, modulo FROM area_desinfeccion ORDER BY modulo";
        ejecutarQuerySelect($conn, $query);

        break;

    case 5:

        $batch = $_POST['id'];

        $sql = "SELECT d.nombre as desinfectante, d.concentracion, bds.modulo, bds.realizo, u.urlfirma as realizo, CONCAt(u.nombre, ' ', u.apellido) as nombre_realizo, us.urlfirma as verifico, CONCAt(us.nombre, ' ' ,us.apellido) as nombre_verifico, bds.verifico as firma ,bds.fecha_registro 
                FROM desinfectante d INNER JOIN batch_desinfectante_seleccionado bds ON bds.desinfectante = d.id 
                INNER JOIN	usuario u ON u.id = bds.realizo
                INNER JOIN	usuario us ON us.id = bds.verifico
                WHERE bds.batch = :batch 
        
                UNION

                SELECT d.nombre as desinfectante, d.concentracion, bds.modulo, bds.realizo, u.urlfirma as realizo, CONCAt(u.nombre, ' ', u.apellido) as nombre_realizo, bds.verifico, bds.verifico as nombre_verifico, bds.verifico as firma, bds.fecha_registro 
                FROM desinfectante d INNER JOIN batch_desinfectante_seleccionado bds ON bds.desinfectante = d.id 
                INNER JOIN	usuario u ON u.id = bds.realizo
                WHERE bds.batch = :batch1 AND verifico = 0
                ORDER BY modulo";

        $query = $conn->prepare($sql);
        $query->execute(['batch' => $batch, 'batch1' => $batch]);

        while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
            $arreglo[] = $data;
        }
        echo json_encode($arreglo, JSON_UNESCAPED_UNICODE);

        break;

    case 6:

        $id = $_POST['id'];

        $sql = "SELECT fecha, temperatura, humedad, id_modulo as modulo FROM batch_condicionesmedio 
                WHERE id_batch = :id";
        $query = $conn->prepare($sql);
        $query->execute(['id' => $id]);

        while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
            $arreglo[] = $data;
        }
        echo json_encode($arreglo, JSON_UNESCAPED_UNICODE);

        break;


    case 7:

        $sql = "SELECT * FROM pdf_textos";
        $query = $conn->prepare($sql);
        $query->execute();

        while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
            $arreglo[] = $data;
        }
        echo json_encode($arreglo, JSON_UNESCAPED_UNICODE);

        break;

    case 8:

        $sql = "SELECT * FROM pdf_textos";
        $query = $conn->prepare($sql);
        $query->execute();

        while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
            $arreglo[] = $data;
        }
        echo json_encode($arreglo, JSON_UNESCAPED_UNICODE);

        break;

    case 10:

        $id = $_POST['id'];

        $sql = "SELECT * FROM batch_control_especificaciones WHERE batch = :id";
        $query = $conn->prepare($sql);
        $query->execute(['id' => $id]);

        while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
            $arreglo[] = $data;
        }
        echo json_encode($arreglo, JSON_UNESCAPED_UNICODE);

        break;

    default:

        break;
}
