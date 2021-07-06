<?php
if (!empty($_POST)) {
    require_once('../../../conexion.php');

    $op = $_POST['operacion'];

    switch ($op) {
        case 1:
            $sql = "SELECT * FROM batch ORDER BY id_batch DESC";
            $query = $conn->prepare($sql);
            $query->execute();
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            break;

        case 2:
            $id = $_POST['idBatch'];
            $sql = "SELECT p.referencia, UPPER(p.nombre_referencia) AS nombre_referencia, m.nombre as marca, pp.nombre as propietario, pc.nombre as presentacion, ns.nombre as notificacion, b.numero_orden, b.numero_lote, b.fecha_creacion, b.tamano_lote, b.unidad_lote, b.lote_presentacion, linea.densidad 
                    FROM batch b INNER JOIN producto p ON p.referencia= b.id_producto INNER JOIN presentacion_comercial pc ON p.presentacion_comercial = pc.id INNER JOIN marca m ON m.id = p.id_marca INNER JOIN propietario pp ON pp.id = p.id_propietario INNER JOIN notificacion_sanitaria ns ON ns.id = p.id_notificacion_sanitaria 
                    INNER JOIN linea ON linea.id = p.id_linea WHERE id_batch = :id";
            $query = $conn->prepare($sql);
            $query->execute(['id' => $id,]);
            $data = $query->fetch(PDO::FETCH_ASSOC);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            break;

        case 3:

            $id = $_POST['idBatch'];
            $sql = "SELECT p.pregunta, bsp.solucion, bsp.id_modulo 
                FROM batch_solucion_pregunta bsp
                INNER JOIN preguntas p ON p.id = bsp.id_pregunta
                WHERE id_batch = :id
                ORDER BY bsp.id_modulo";
            $query = $conn->prepare($sql);
            $query->execute(['id' => $id]);
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            break;

        case 4:

            $sql = "SELECT descripcion, modulo FROM area_desinfeccion ORDER BY modulo";
            $query = $conn->prepare($sql);
            $query->execute();
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);

            break;

        case 5:

            $batch = $_POST['idBatch'];

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
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);

            break;

        case 6:

            $id = $_POST['idBatch'];
            $sql = "SELECT fecha, temperatura, humedad, id_modulo as modulo FROM batch_condicionesmedio WHERE id_batch = :id";
            $query = $conn->prepare($sql);
            $query->execute(['id' => $id]);
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);

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

            $id = $_POST['idBatch'];

            $sql = "SELECT * FROM batch_control_especificaciones WHERE batch = :id";
            $query = $conn->prepare($sql);
            $query->execute(['id' => $id]);

            while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
                $arreglo[] = $data;
            }
            echo json_encode($arreglo, JSON_UNESCAPED_UNICODE);

            break;

        case 11:

            $id = $_POST['idBatch'];

            $sql = "SELECT * FROM batch_control_especificaciones WHERE batch = :id";
            $query = $conn->prepare($sql);
            $query->execute(['id' => $id]);

            while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
                $arreglo[] = $data;
            }
            echo json_encode($arreglo, JSON_UNESCAPED_UNICODE);

            break;

        case 12: // Observaciones aprobacion
            $batch = $_POST['idBatch'];
            $sql = "SELECT * FROM observaciones WHERE id_batch = :batch";
            $query = $conn->prepare($sql);
            $result = $query->execute(['batch' => $batch]);
            if ($result) $data = $query->fetchAll(PDO::FETCH_ASSOC);
            else echo 'false';
            echo json_encode($data, JSON_UNESCAPED_UNICODE);

            break;
        case 13: // Firma conciliacion acondicionamiento y despachos
            $batch = $_POST['idBatch'];
            $sql = "SELECT * FROM batch_conciliacion_rendimiento bcr INNER JOIN usuario ON bcr.entrego = usuario.id WHERE batch = :batch";
            $query = $conn->prepare($sql);
            $query->execute(['batch' => $batch]);
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);

            break;
        case 14: // datos microbiologia
            $batch = $_POST['idBatch'];

            $sql = "SELECT bam.mesofilos, bam.pseudomona, bam.escherichia, bam.staphylococcus, bam.fecha_siembra, bam.fecha_resultados, bam.fecha_resultados, bam.observaciones, CONCAT(ur.nombre, ' ' ,ur.apellido) as nombre_realizo, ur.urlfirma AS realizo, CONCAT(uv.nombre, ' ' ,uv.apellido) as nombre_verifico, uv.urlfirma AS verifico 
                    FROM batch_analisis_microbiologico bam 
                    INNER JOIN usuario ur ON bam.realizo = ur.id INNER JOIN usuario uv ON bam.verifico = uv.id 
                    WHERE batch = :batch";
            $query = $conn->prepare($sql);
            $query->execute(['batch' => $batch]);
            $rows = $query->rowCount();

            if ($rows == 0) {
                $sql = "SELECT bam.mesofilos, bam.pseudomona, bam.escherichia, bam.staphylococcus, bam.fecha_siembra, bam.fecha_resultados, bam.fecha_resultados, bam.observaciones, CONCAT(ur.nombre, ' ' ,ur.apellido) as nombre_realizo, ur.urlfirma AS realizo 
                        FROM batch_analisis_microbiologico bam 
                        INNER JOIN usuario ur ON bam.realizo = ur.id
                        WHERE batch = :batch";
                $query = $conn->prepare($sql);
                $query->execute(['batch' => $batch]);
            }

            $data = $query->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);

            break;

        case 15: // datos fisicoquimico
            $batch = $_POST['idBatch'];

            $sql = "SELECT CONCAT(ur.nombre, ' ' ,ur.apellido) as nombre_realizo, ur.urlfirma AS realizo, CONCAT(uv.nombre, ' ' ,uv.apellido) as nombre_verifico, uv.urlfirma AS verifico 
                        FROM batch_analisis_microbiologico bam 
                        INNER JOIN usuario ur ON bam.realizo = ur.id INNER JOIN usuario uv ON bam.verifico = uv.id 
                        WHERE batch = :batch";
            $query = $conn->prepare($sql);
            $query->execute(['batch' => $batch]);
            $rows = $query->rowCount();

            if ($rows == 0) {
                $sql = "SELECT bam.mesofilos, bam.pseudomona, bam.escherichia, bam.staphylococcus, bam.fecha_siembra, bam.fecha_resultados, bam.fecha_resultados, bam.observaciones, CONCAT(ur.nombre, ' ' ,ur.apellido) as nombre_realizo, ur.urlfirma AS realizo 
                            FROM batch_analisis_microbiologico bam 
                            INNER JOIN usuario ur ON bam.realizo = ur.id
                            WHERE batch = :batch";
                $query = $conn->prepare($sql);
                $query->execute(['batch' => $batch]);
            }

            $data = $query->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);

            break;

        case 16: // liberacion Lote
            $batch = $_POST['idBatch'];

            $sql = "SELECT b.aprobacion, b.observaciones, CONCAT(u.nombre, ' ', u.apellido) as dirProd, u.urlfirma as produccion, 
                    CONCAT(us.nombre, ' ', us.apellido) as dirCa, us.urlfirma as calidad, CONCAT(usu.nombre, ' ', usu.apellido) as dirTec, usu.urlfirma as tecnica,  fecha_registro 
                    FROM batch_liberacion b 
                    LEFT JOIN usuario u ON b.dir_produccion=u.id 
                    LEFT JOIN usuario us ON b.dir_calidad = us.id 
                    LEFT JOIN usuario usu ON b.dir_tecnica = usu.id 
                    WHERE batch = :batch";
            $query = $conn->prepare($sql);
            $query->execute(['batch' => $batch]);
            $data = $query->fetch(PDO::FETCH_ASSOC);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            break;

        case 17: //busqueda_firmas
            $batch = $_POST['idBatch'];

            $sql = "SELECT bf.modulo, bf.batch, bf.ref_multi, u.urlfirma as realizo, CONCAt(u.nombre, ' ', u.apellido) as nombre_realizo, us.urlfirma as verifico, CONCAt(us.nombre , ' ' , us.apellido) as nombre_verifico 
                    FROM batch_firmas2seccion bf 
                    INNER JOIN usuario u ON u.id = bf.realizo INNER JOIN usuario us ON us.id = bf.verifico 
                    WHERE bf.batch = :batch";
            $query = $conn->prepare($sql);
            $query->execute(['batch' => $batch]);
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
            sizeof($data) == 0 ? $data = 0 : $data;
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            break;

        case 18: //busqueda_multipresentacion
            $batch = $_POST['idBatch'];

            $sql = "SELECT * FROM multipresentacion WHERE id_batch = :batch";
            $query = $conn->prepare($sql);
            $query->execute(['batch' => $batch]);
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
            sizeof($data) == 0 ? $data = 0 : $data;
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            break;
    }
}
