<?php
//include('/Desarrollo/BatchRecord/htdocs/conexion.php');
require_once('../../conexion2.php');

function utf8ize($d)
{
  if (is_array($d))
    foreach ($d as $k => $v)
      $d[$k] = utf8ize($v);

  else if (is_object($d))
    foreach ($d as $k => $v)
      $d->$k = utf8ize($v);

  else
    return utf8_encode($d);

  return $d;
}

$op = $_POST['operacion'];

if ($op == 1) {
  $fecha_busqueda = $_POST['busqueda'];
  $fecha_inicio = $_POST['inicio'];
  $fecha_final = $_POST['final'];
}

switch ($op) {
  case 1: //listar Batch

    $proceso = $_POST['proceso'];

    if ($proceso == 2) {
      $query_batch = mysqli_query($conn, "SELECT batch.id_batch, batch.numero_orden, producto.referencia, producto.nombre_referencia, pc.nombre, batch.numero_lote, batch.tamano_lote, propietario.nombre,batch.fecha_creacion, batch.fecha_programacion, batch.estado, batch.multi
                                            FROM batch INNER JOIN producto INNER JOIN presentacion_comercial pc INNER JOIN propietario
                                            ON batch.id_producto = producto.referencia AND producto.id_presentacion_comercial = pc.id AND producto.id_propietario = propietario.id
                                            WHERE estado = 1 AND fecha_programacion < DATE_SUB(CURDATE(), INTERVAL -1 DAY)
                                            ORDER BY batch.id_batch desc; ");
    } else {

      $query = "SELECT batch.id_batch, batch.numero_orden, producto.referencia, producto.nombre_referencia, pc.nombre as presentacion_comercial, batch.numero_lote, batch.tamano_lote, propietario.nombre, batch.fecha_creacion, batch.fecha_programacion, batch.estado, batch.multi
                FROM batch INNER JOIN producto INNER JOIN propietario INNER JOIN presentacion_comercial pc
                ON batch.id_producto = producto.referencia AND producto.id_propietario = propietario.id AND producto.presentacion_comercial = pc.id
                WHERE estado > 0 AND batch.id_batch 
                NOT IN (SELECT batch FROM `batch_liberacion` WHERE dir_produccion > 0 AND dir_calidad > 0 and dir_tecnica > 0)";

      if ($fecha_busqueda) {
        $query .= " WHERE $fecha_busqueda BETWEEN '$fecha_inicio' AND '$fecha_final' ";
      }

      $query .= " ORDER BY batch.id_batch desc";

      $query_batch = mysqli_query($conn, $query);
    }

    $result = mysqli_num_rows($query_batch);

    if ($result > 0) {
      while ($data = mysqli_fetch_assoc($query_batch)) {
        $arreglo["data"][] = $data;
      }

      echo json_encode($arreglo, JSON_UNESCAPED_UNICODE);
    } else {
      echo ('0');
    }
    //mysqli_free_result($query_batch);
    mysqli_close($conn);

    break;

  case 2: //Eliminar
    $id_batch = $_POST['id'];
    $motivo = $_POST['value'];

    $query_batch_Eliminar = "UPDATE batch SET estado = 0, fecha_eliminacion = CURDATE() WHERE id_batch = $id_batch";
    $result_eliminar = mysqli_query($conn, $query_batch_Eliminar);

    $query_motivo = "INSERT INTO batch_eliminados (batch, motivo) VALUES('$id_batch', '$motivo')";
    $result_motivo = mysqli_query($conn, $query_motivo);
    mysqli_close($conn);

    break;

  case 3: //cargar selector de referencias

    $query_referencia = mysqli_query($conn, "SELECT @curRow := @curRow + 1 AS id, referencia FROM producto JOIN (SELECT @curRow := 0) r ORDER BY `producto`.`referencia` ASC");
    $result = mysqli_num_rows($query_referencia);
    if ($result > 0) {
      while ($data = mysqli_fetch_assoc($query_referencia))
        $arreglo[] = $data;
      echo json_encode($arreglo, JSON_UNESCAPED_UNICODE);
    } else
      echo json_encode('');
    mysqli_free_result($query_referencia);
    mysqli_close($conn);
    break;

  case 4: //recargar datos de acuerdo con seleccion de referencia
    $id_referencia = $_POST['id'];
    $query_producto = mysqli_query(
      $conn,
      "SELECT p.referencia, p.nombre_referencia as nombre, m.nombre as marca, ns.nombre as notificacion_sanitaria, pp.nombre as propietario, np.nombre as producto, pc.nombre as presentacion_comercial, l.nombre as linea, l.densidad 
        FROM producto p 
        INNER JOIN marca m INNER JOIN notificacion_sanitaria ns INNER JOIN propietario pp INNER JOIN nombre_producto np INNER JOIN linea l INNER JOIN presentacion_comercial pc 
        ON p.id_marca = m.id AND p.id_notificacion_sanitaria = ns.id AND p.id_propietario=pp.id AND p.id_nombre_producto= np.id AND p.id_linea=l.id AND pc.id = p.presentacion_comercial 
        WHERE p.referencia = '$id_referencia'"
    );

    $result = mysqli_num_rows($query_producto);
    mysqli_close($conn);

    if ($result > 0) {
      while ($data = mysqli_fetch_assoc($query_producto)) {
        $arreglo[] = $data;
      }
      echo json_encode($arreglo, JSON_UNESCAPED_UNICODE);
    } else {
      echo json_encode('');
    }
    break;

  case 5: // Guardar

    $id_batch               = $_POST['id_batch'];
    $referencia             = $_POST['ref'];
    $unidadesxlote          = $_POST['unidades'];
    $tamanototallote        = $_POST['lote'];
    $fechaprogramacion      = $_POST['programacion'];
    $tamanolotepresentacion = $_POST['presentacion'];
    $tanque                 = $_POST['tanque'];
    $cantidades             = $_POST['cantidades'];
    $fechahoy               = date("Y-m-d");

    $result = estadoInicial($conn, $referencia, $fechaprogramacion);
    $estado = $result['0'];
    $fechaprogramacion = $result['1'];

    /* $i = 1; */
    $query = "INSERT INTO batch (fecha_creacion, fecha_programacion, fecha_actual, numero_orden, numero_lote, tamano_lote, lote_presentacion, unidad_lote, estado, id_producto) 
			VALUES ('$fechahoy',";
    $query .= $fechaprogramacion != null ? "'$fechaprogramacion'" : "NULL";
    $query .= ",'$fechahoy', 'OP012020',' X0010320', '$tamanototallote', '$tamanolotepresentacion', '$unidadesxlote', '$estado', '$id_batch')";
    $result = mysqli_query($conn, $query); //or die ("Problemas al insertar" . mysqli_error($conn));    

    /* Inserte tanque y cantidades */
    if ($result) {
      $id = mysqli_insert_id($conn);
      $query_tanque = "INSERT INTO batch_tanques (tanque, cantidad, id_batch) VALUES('$tanque' , '$cantidades', '$id')";
      $result = mysqli_query($conn, $query_tanque);
    }

    mysqli_close($conn);

    if (!$result)
      echo 'false' . mysqli_error($conn);
    else
      echo 'true';

    break;

  case 6: //Cargar datos al modal para Actualizar
    $id_batch = $_POST['id'];

    $query_buscar = mysqli_query($conn, "SELECT bt.id_batch, p.referencia, p.nombre_referencia, m.nombre as marca, pp.nombre as propietario, np.nombre, pc.nombre as presentacion_comercial, linea.nombre as linea, linea.densidad, ns.nombre as notificacion_sanitaria, bt.unidad_lote, bt.tamano_lote, bt.fecha_programacion 
                                          FROM producto p INNER JOIN marca m INNER JOIN propietario pp INNER JOIN nombre_producto np INNER JOIN linea INNER JOIN notificacion_sanitaria ns INNER JOIN batch bt INNER JOIN presentacion_comercial pc
                                          ON p.id_marca=m.id AND p.id_propietario=pp.id AND p.id_nombre_producto=np.id AND p.id_linea=linea.id AND p.id_notificacion_sanitaria=ns.id AND bt.id_producto=p.referencia AND p.presentacion_comercial = pc.id
                                          WHERE bt.id_batch = $id_batch");

    $data[] = mysqli_fetch_assoc($query_buscar);
    $query_buscarTanque =  mysqli_query($conn, "SELECT tanque, cantidad FROM batch_tanques btnq WHERE btnq.id_batch = '$id_batch'");
    $result = mysqli_num_rows($query_buscarTanque);

    if ($result > 0) {
      while ($tnq = mysqli_fetch_assoc($query_buscarTanque)) {
        $tanques[] = $tnq;
      }

      $tnq = mysqli_fetch_assoc($query_buscarTanque);
    }

    if ($result > 0) {
      $resultado = array_merge($data, $tanques);
    } else {
      $resultado = $data;
    }

    echo json_encode($resultado, JSON_UNESCAPED_UNICODE);
    mysqli_close($conn);
    break;

  case 7: //Actualiza datos
    $id_batch     = $_POST['id_batch'];
    $referencia   = $_POST['ref'];
    $unidades     = $_POST['unidades'];
    $lote         = $_POST['lote'];
    $fechaprogramacion = $_POST['programacion'];
    $tanque    = $_POST['tanque'];
    $cantidades  = $_POST['cantidades'];

    /* asigna el estado */
    $result = estadoInicial($conn, $referencia, $fechaprogramacion);
    $estado = $result['0'];
    $fechaprogramacion = $result['1'];

    /* Actualiza el batch */
    $query_actualizar = "UPDATE batch SET unidad_lote = '$unidades', tamano_lote = '$lote', estado = '$estado', fecha_programacion = ";
    $query_actualizar .= $fechaprogramacion != null ? "'$fechaprogramacion'" : "NULL ";
    $query_actualizar .= "WHERE id_batch ='$id_batch'";
    $result = mysqli_query($conn, $query_actualizar);

    /* Actualizar los tanques */
    if ($result) {
      $query_tanque = "SELECT * FROM batch_tanques WHERE id_batch = '$id_batch'";
      $result = mysqli_query($conn, $query_tanque);
      if ($result) {
        $query_tanque = "UPDATE batch_tanques SET tanque = '$tanque', cantidad = '$cantidades' WHERE id_batch = '$id_batch'";
        $result = mysqli_query($conn, $query_tanque);
      } /* else {
        $query_tanque = "INSERT INTO batch_tanques (tanque, cantidad, id_batch) VALUES('$tanque' , '$cantidades', '$id_batch')";
        $result = mysqli_query($conn, $query_tanque);
      } */
    }

    if ($result)
      echo "true";
    else
      echo 'false ' . mysqli_error($conn);

    mysqli_close($conn);

    break;

  case 8: //carga modal Multipresentacion
    $id_batch = $_POST['id'];

    $query_nref = mysqli_query($conn, "SELECT @curRow := @curRow + 1 AS id, nombre_referencia FROM producto JOIN (SELECT @curRow := 0) r WHERE multi = 
                                        (SELECT multi FROM producto WHERE producto.referencia = 
                                        (SELECT batch.id_producto FROM batch WHERE batch.id_batch = $id_batch)) AND multi>0");

    $result = mysqli_num_rows($query_nref);

    if ($result > 0) {
      while ($data = mysqli_fetch_assoc($query_nref))
        $arreglo[] = $data;
      echo json_encode($arreglo, JSON_UNESCAPED_UNICODE);
    } else
      echo json_encode('');


    break;

  case 9: // cargar selector de Tanques
    $query_tanque = mysqli_query($conn, "SELECT capacidad FROM tanques ORDER BY 'capacidad' ASC");

    $result = mysqli_num_rows($query_tanque);

    if ($result > 0) {
      while ($data = mysqli_fetch_assoc($query_tanque))
        $arreglo[] = $data;
      echo json_encode($arreglo, JSON_UNESCAPED_UNICODE);
    } else
      echo json_encode('');
    mysqli_free_result($query_tanque);
    mysqli_close($conn);

    break;

  case 10: // Clonar Batch
    $id_batch = $_POST['id'];
    $referencia = $_POST['referencia'];
    $clonarCantidad = $_POST['clonarCantidad'];
    $fechaprogramacion = "";

    /* asigna el estado */
    $result = estadoInicial($conn, $referencia, $fechaprogramacion);
    $estado = $result['0'];
    $fechaprogramacion = $result['1'];

    /* Clonar batch */
    for ($i = 0; $i < $clonarCantidad; $i++) {

      /* Insertar el batch */
      $query_clonar = mysqli_query($conn, "INSERT INTO batch (fecha_creacion, fecha_actual, tamano_lote, lote_presentacion, unidad_lote, id_producto, estado, multi)
                                           SELECT CURRENT_DATE, CURRENT_DATE, tamano_lote, lote_presentacion, unidad_lote, id_producto, '$estado', multi 
                                           FROM batch WHERE id_batch = $id_batch");

      /* Buscar los tanques del batch clonado */
      $query_select_tanques = mysqli_query($conn, "SELECT * FROM batch_tanques WHERE id_batch = $id_batch");
      while ($data = mysqli_fetch_assoc($query_select_tanques))
        $arreglo[] = $data;

      $tanque = $arreglo[0]['tanque'];
      $cantidad = $arreglo[0]['cantidad'];

      /* Buscar el id del batch registrado */
      $query = mysqli_query($conn, "SELECT MAX(id_batch) AS id FROM batch");
      $max_batch = mysqli_fetch_assoc($query);
      $id_batch = $max_batch['id'];

      /* Inserta los tanques clonados */
      $query_clonar_tanques = mysqli_query($conn, "INSERT INTO batch_tanques(tanque, cantidad, id_batch) 
                                                   VALUES('$tanque', '$cantidad', '$id_batch')");
    }

    if ($query_clonar)
      echo '1';

    break;

  case 11: //seleccionar ID para Cargar datos de acuerdo con la selección de multipresentación
    $nombre_referencia = $_POST['nombre_referencia'];
    $query_producto = mysqli_query($conn, "SELECT referencia FROM `producto` WHERE nombre_referencia='$nombre_referencia'");
    $result = mysqli_num_rows($query_producto);

    if ($result > 0) {
      while ($data = mysqli_fetch_assoc($query_producto)) {
        $arreglo[] = $data;
      }
      echo json_encode($arreglo, JSON_UNESCAPED_UNICODE);
    } else {
      echo json_encode('');
    }


    break;

  case 12: // Guardar Multipresentacion
    $nom_referencia = $_POST['ref'];
    $cantidad       = $_POST['cant'];
    $id_batch       = $_POST['id'];

    for ($i = 0; $i < sizeof($nom_referencia); ++$i) {
      echo $nom_referencia[$i];
    }

    for ($i = 0; $i < sizeof($nom_referencia); ++$i) {
      echo $cantidad[$i];
    }

    echo $id_batch;

    for ($i = 0; $i < sizeof($nom_referencia); ++$i) {
      //$query_tanque = "INSERT INTO batch_tanques (tanque, cantidad, id_batch) VALUES('$tanque[$i]' , '$tamanotqn[$i]', '$id')";

      $query_id_referencia = "INSERT INTO multipresentacion (id_batch, referencia, cantidad) 
                              SELECT '$id_batch', referencia, '$cantidad[$i]' FROM producto 
                              WHERE nombre_referencia = '$nom_referencia[$i]'";
      $query_batch_multi = " UPDATE batch SET multi = '1' WHERE id_batch='$id_batch'";
      $result = mysqli_query($conn, $query_id_referencia);
      $result1 = mysqli_query($conn, $query_batch_multi);
    }

    if (!$result) {
      die('Error');
      echo 'No guardado. Error: ' . mysqli_error($conn);
    } else {
      echo 'Almacenado';
    }

    break;
}

function estadoInicial($conn, $referencia, $fechaprogramacion)
{
  /* validar que exista la formula*/
  $query_buscarFormula =  mysqli_query($conn, "SELECT * FROM formula WHERE id_producto = '$referencia'");
  $resultFormula = mysqli_num_rows($query_buscarFormula);

  /* validar que exista el instructivo */
  $query_buscarInstructivo =  mysqli_query($conn, "SELECT * FROM instructivo_preparacion WHERE id_producto = '$referencia'");
  $resultPreparacionInstructivos = mysqli_num_rows($query_buscarInstructivo);

  /* si el instructivo no existe valida que exista el instructivo en Bases*/
  if ($resultPreparacionInstructivos == 0) {
    $query_buscarInstructivo =  mysqli_query($conn, "SELECT instructivo FROM producto WHERE referencia = '$referencia'");
    $resultPreparacion = mysqli_fetch_assoc($query_buscarInstructivo);
    $resultPreparacionInstructivos = $resultPreparacion['instructivo'];
  }

  /* consolida resultados */
  $result = $resultFormula * $resultPreparacionInstructivos;

  /* Asigna el estado de acuerdo con el resultado */
  if ($result === 0) {
    $estado = '1';  //Sin formula
    $fechaprogramacion = '';
  }

  if ($result > 0 && $fechaprogramacion == '') {
    $estado = '2'; // Inactivo  
  }

  if ($result > 0 && $fechaprogramacion != '') {
    $estado = '3';  //Pesaje
  }
  return array($estado, $fechaprogramacion);
}
