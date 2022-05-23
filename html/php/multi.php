<?php

require_once('../../conexion.php');
require_once('../php/servicios/control_firmas/control_firmas_multi.php');

$op = $_POST['operacion'];

switch ($op) {
  case 1: //Cargar Select Multipresentacion
    $referencia = $_POST['id'];

    $sql = "SELECT multi FROM producto WHERE referencia = :referencia";
    $query = $conn->prepare($sql);
    $query->execute(['referencia' => $referencia]);
    $ids = $query->fetchAll($conn::FETCH_ASSOC);
    
    foreach ($ids as $id)
      $multi = $id['multi'];

    $rows = $query->rowCount();

    if ($rows > 0 /* && $multi != 0 */) {
      //$sql = "SELECT p.referencia, p.nombre_referencia FROM producto p WHERE multi = :multi";
      $sql = "SELECT p.referencia, p.nombre_referencia as nombre, m.nombre as marca, ns.nombre as notificacion, pp.nombre as propietario, np.nombre as producto, pc.nombre as presentacion, l.nombre as linea, l.densidad 
              FROM producto p INNER JOIN marca m INNER JOIN notificacion_sanitaria ns INNER JOIN propietario pp INNER JOIN nombre_producto np INNER JOIN linea l INNER JOIN presentacion_comercial pc
              ON p.id_marca = m.id AND p.id_notificacion_sanitaria = ns.id AND p.id_propietario=pp.id AND p.id_nombre_producto= np.id AND p.id_linea=l.id AND pc.id = p.presentacion_comercial
              WHERE multi = :multi";
      $query = $conn->prepare($sql);
      $query->execute(['multi' => $multi]);
      $query->execute(['multi' => $multi]);
      $id_multi = $query->fetchAll($conn::FETCH_ASSOC);
      echo json_encode($id_multi, JSON_UNESCAPED_UNICODE);
    }

    break;

  case 2: //seleccionar ID para Cargar datos de acuerdo con la selección de multipresentación
    $nombre_referencia = $_POST['nombre_referencia'];

    $sql = "SELECT referencia FROM `producto` WHERE nombre_referencia = :nombre_referencia";
    $query = $conn->prepare($sql);
    $query->execute(['multi' => $nombre_referencia]);
    $nombres_ref = $query->fetchAll($conn::FETCH_ASSOC);
    echo json_encode($nombres_ref, JSON_UNESCAPED_UNICODE);

    break;

  case 3: //recargar datos de acuerdo con seleccion de referencia
    /* $referencia = $_POST['referencia'];

    $sql = "SELECT p.referencia, p.nombre_referencia as nombre, m.nombre as marca, ns.nombre as notificacion, pp.nombre as propietario, np.nombre as producto, pc.nombre as presentacion, l.nombre as linea, l.densidad 
            FROM producto p INNER JOIN marca m INNER JOIN notificacion_sanitaria ns INNER JOIN propietario pp INNER JOIN nombre_producto np INNER JOIN linea l INNER JOIN presentacion_comercial pc
            ON p.id_marca = m.id AND p.id_notificacion_sanitaria = ns.id AND p.id_propietario=pp.id AND p.id_nombre_producto= np.id AND p.id_linea=l.id AND pc.id = p.presentacion_comercial
            WHERE p.referencia = :referencia";
    $query = $conn->prepare($sql);
    $query->execute(['referencia' => $referencia]);
    $nombres_ref = $query->fetchAll($conn::FETCH_ASSOC);
    echo json_encode($nombres_ref, JSON_UNESCAPED_UNICODE);

    break; */

  case 4: // Guardar Multipresentacion
    $multipresentaciones = $_POST['ref'];
    $id_batch = $_POST['id'];

    foreach ($multipresentaciones as $multipresentacion) {
      $sql = "SELECT * FROM multipresentacion WHERE id_batch = :id_batch AND referencia = :referencia";
      $query = $conn->prepare($sql);
      $query->execute([
        'referencia' => $multipresentacion['referencia'],
        'id_batch' => $id_batch,
      ]);
      $rows = $query->rowCount();

      if ($rows > 0) {
        $sql = "UPDATE multipresentacion SET cantidad = :cantidad, total = :total 
                WHERE id_batch = :id_batch AND referencia = :referencia";
        $query = $conn->prepare($sql);
        $result = $query->execute([
          'referencia' => $multipresentacion['referencia'],
          'id_batch' => $id_batch,
          'cantidad' => $multipresentacion['cantidadunidades'],
          'total' => $multipresentacion['tamaniopresentacion'],
        ]);
      } else {
        $sql = "INSERT INTO multipresentacion (id_batch, referencia, cantidad, total) 
                VALUES (:id_batch, :referencia, :cantidad, :total)";
        $query = $conn->prepare($sql);
        $result = $query->execute([
          'id_batch' => $id_batch,
          'referencia' => $multipresentacion['referencia'],
          'cantidad' => $multipresentacion['cantidadunidades'],
          'total' => $multipresentacion['tamaniopresentacion'],
        ]);
      }
      if ($result) {
        $sql = "UPDATE batch SET multi = '1' WHERE id_batch= :id_batch";
        $query = $conn->prepare($sql);
        $result = $query->execute(['id_batch' => $id_batch,]);
      }
    }

    /* Actualizar tabla firmas con multipresentacion */
    control_firmas_multi($conn, $id_batch);


    if (!$result) {
      die('Error');
      echo '0';
    } else {
      echo '1';
    }

    break;

  case 5: //Delete batch multi
    $batch = $_POST['id'];
    $referencia = $_POST['ref'];

    $sql = "DELETE FROM multipresentacion WHERE id_batch = :batch AND referencia = :referencia";
    $query = $conn->prepare($sql);
    $result = $query->execute([
      'batch' => $batch,
      'referencia' => $referencia,
    ]);


    break;

  case 6: // Cargar datos para actualizar Multipresentacion
    $batch = $_POST['id'];

    $sql = "SELECT p.referencia, multi.id_batch, multi.cantidad, multi.total,linea.densidad, pc.nombre as presentacion 
            FROM producto p 
            INNER JOIN multipresentacion multi ON p.referencia = multi.referencia 
            INNER JOIN linea ON p.id_linea = linea.id 
            INNER JOIN presentacion_comercial pc ON p.presentacion_comercial = pc.id 
            WHERE id_batch = :batch";
    $query = $conn->prepare($sql);
    $query->execute(['batch' => $batch]);
    $multi = $query->fetchAll($conn::FETCH_ASSOC);
    echo json_encode($multi, JSON_UNESCAPED_UNICODE);

    break;
}
