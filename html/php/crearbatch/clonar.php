<?php

require_once('../../../conexion.php');
require_once('../estadoInicial.php');

$id_batch = $_POST['id'];
$referencia = $_POST['referencia'];
$clonarCantidad = $_POST['clonarCantidad'];
$fechaprogramacion = "";

/* asigna el estado */
$result = estadoInicial1($conn, $referencia, $fechaprogramacion);
$estado = $result['estado'];
$fechaprogramacion = $result['fechaprogramacion'];

/* Clonar batch */
for ($i = 0; $i < $clonarCantidad; $i++) {

    /* Insertar el batch */

    $sql = "INSERT INTO batch (fecha_creacion, fecha_actual, tamano_lote, lote_presentacion, unidad_lote, id_producto, estado, multi)
            SELECT CURRENT_DATE, CURRENT_DATE, tamano_lote, lote_presentacion, unidad_lote, id_producto, :estado, multi 
            FROM batch WHERE id_batch = :id_batch";
    $query = $conn->prepare($sql);
    $result = $query->execute(['estado' => $estado, 'id_batch' => $id_batch]);

    /* Buscar los tanques del batch clonado */
    $sql = "SELECT * FROM batch_tanques WHERE id_batch = :id_batch";
    $query = $conn->prepare($sql);
    $result = $query->execute(['id_batch' => $id_batch]);
    $data = $query->fetchAll(PDO::FETCH_ASSOC);

    $tanque = $data[0]['tanque'];
    $cantidad = $data[0]['cantidad'];

    /* Buscar el id del batch registrado */
    $sql = "SELECT MAX(id_batch) AS id FROM batch";
    $query = $conn->prepare($sql);
    $result = $query->execute();
    $data = $query->fetch(PDO::FETCH_ASSOC);

    /* Inserta los tanques clonados */
    $sql = "INSERT INTO batch_tanques(tanque, cantidad, id_batch) VALUES(:tanque, :cantidad, :id_batch)";
    $query = $conn->prepare($sql);
    $result = $query->execute(['tanque' => $tanque, 'cantidad' => $cantidad, 'id_batch' => $data['id']]);

    /* ingrese datos para el control de firmas */

    $query_firmas = "INSERT INTO batch_control_firmas (modulo, batch, cantidad_firmas, total_firmas) VALUES('2' , :id_batch, '0', '4')";
    $query = $conn->prepare($query_firmas);
    $result = $query->execute(['id_batch' => $data['id']]);

    $query_firmas = "INSERT INTO batch_control_firmas (modulo, batch, cantidad_firmas, total_firmas) VALUES('3' , :id_batch, '0', '4')";
    $query = $conn->prepare($query_firmas);
    $result = $query->execute(['id_batch' => $data['id']]);

    $query_firmas = "INSERT INTO batch_control_firmas (modulo, batch, cantidad_firmas, total_firmas) VALUES('4' , :id_batch, '0', '2')";
    $query = $conn->prepare($query_firmas);
    $result = $query->execute(['id_batch' => $data['id']]);

    $query_firmas = "INSERT INTO batch_control_firmas (modulo, batch, cantidad_firmas, total_firmas) VALUES('5' , :id_batch, '0', '6')";
    $query = $conn->prepare($query_firmas);
    $result = $query->execute(['id_batch' => $data['id']]);

    $query_firmas = "INSERT INTO batch_control_firmas (modulo, batch, cantidad_firmas, total_firmas) VALUES('6' , :id_batch, '0', '7')";
    $query = $conn->prepare($query_firmas);
    $result = $query->execute(['id_batch' => $data['id']]);

    $query_firmas = "INSERT INTO batch_control_firmas (modulo, batch, cantidad_firmas, total_firmas) VALUES('7' , :id_batch, '0', '1')";
    $query = $conn->prepare($query_firmas);
    $result = $query->execute(['id_batch' => $data['id']]);

    $query_firmas = "INSERT INTO batch_control_firmas (modulo, batch, cantidad_firmas, total_firmas) VALUES('8' , :id_batch, '0', '2')";
    $query = $conn->prepare($query_firmas);
    $result = $query->execute(['id_batch' => $data['id']]);

    $query_firmas = "INSERT INTO batch_control_firmas (modulo, batch, cantidad_firmas, total_firmas) VALUES('9' , :id_batch, '0', '2')";
    $query = $conn->prepare($query_firmas);
    $result = $query->execute(['id_batch' => $data['id']]);

    $query_firmas = "INSERT INTO batch_control_firmas (modulo, batch, cantidad_firmas, total_firmas) VALUES('10' , :id_batch, '0', '3')";
    $query = $conn->prepare($query_firmas);
    $result = $query->execute(['id_batch' => $data['id']]);


    echo '1';
}
