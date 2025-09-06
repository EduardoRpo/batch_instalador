<?php
/**
 * MODIFICADO: Mejora en importación de pedidos para mostrar solo datos actualizados
 * FECHA: 2025-01-09
 * MOTIVO: Usuario requiere que los datos actualizados aparezcan en la vista después de confirmar
 * CAMBIOS:
 * - Separar datos a actualizar de datos a insertar durante validación
 * - Implementar tracking de IDs de pedidos actualizados en sesión
 * - Crear endpoint /getPedidosActualizados para filtrar vista
 * - Mantener funcionalidad existente de guardado en plan_pedidos_sin_referencia
 */

use BatchRecord\dao\PedidosSinReferenciaDao;
use BatchRecord\dao\PreBatchDao;
use BatchRecord\Dao\ProductDao;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$preBatchDao = new PreBatchDao();
$productDao = new ProductDao();
$pedidosSinReferenciaDao = new PedidosSinReferenciaDao();


$app->post('/validacionDatosPedidos', function (Request $request, Response $response, $args) use ($preBatchDao, $productDao, $pedidosSinReferenciaDao) {
  $dataPedidos = $request->getParsedBody();

  if (isset($dataPedidos) && isset($dataPedidos['data']) && is_array($dataPedidos['data'])) {

    $nonProducts = 0;
    $insert = 0;
    $update = 0;
    $nonExistentProducts = [];
    $datosActualizar = [];  // NUEVO: Array para datos a actualizar
    $datosInsertar = [];    // NUEVO: Array para datos a insertar

    $dataGlobal = $dataPedidos['data'];

    // Convertir campos
    for ($i = 0; $i < sizeof($dataGlobal); $i++) {
      try {
        $dataConvertPedidos = $preBatchDao->convertData($dataGlobal[$i]);

        $dataGlobal[$i]['cliente'] = $dataConvertPedidos['cliente'];
        $dataGlobal[$i]['documento'] = $dataConvertPedidos['documento'];
        $dataGlobal[$i]['producto'] = $dataConvertPedidos['producto'];
        $dataGlobal[$i]['cant_original'] = $dataConvertPedidos['cant_original'];
        $dataGlobal[$i]['cantidad'] = $dataConvertPedidos['cantidad'];
        $dataGlobal[$i]['valor_pedido'] = $dataConvertPedidos['valor_pedido'];
      } catch (Exception $e) {
        // Si hay error en la conversión, saltar este registro
        continue;
      }
    }
    $data = $dataGlobal;

    for ($i = 0; $i < sizeof($dataGlobal); $i++) {
      try {
        // Verificar que el producto existe
        if (empty($dataGlobal[$i]['producto'])) {
          $nonExistentProducts[$i] = $dataGlobal[$i];
          unset($data[$i]);
          $nonProducts = $nonProducts + 1;
          continue;
        }

        //Consultar si existe producto en la base de datos
        $product = $productDao->findProduct(trim($dataGlobal[$i]['producto']));

        if (!$product) {
          $nonExistentProducts[$i] = $dataGlobal[$i];
          unset($data[$i]);
          $nonProducts = $nonProducts + 1;
        } else {
          // Consultar si el producto esta ingresado en la tabla plan_pedidos_sin_referencia
          $pedidosSinReferencia = $pedidosSinReferenciaDao->findPedidoSinReferencia($dataGlobal[$i]);

          // Eliminar registro de la tabla plan_pedidos_sin_referencia
          if ($pedidosSinReferencia)
            $pedidosSinReferenciaDao->deletePedidosSinReferencia($dataGlobal[$i]);

          $result = $preBatchDao->findOrders($dataGlobal[$i]);
          if ($result) {
            $update = $update + 1;
            $datosActualizar[] = $dataGlobal[$i]; // NUEVO: Agregar a datos a actualizar
          } else {
            $insert = $insert + 1;
            $datosInsertar[] = $dataGlobal[$i];   // NUEVO: Agregar a datos a insertar
          }
        }
      } catch (Exception $e) {
        // Si hay error, contar como producto no existente
        $nonExistentProducts[$i] = $dataGlobal[$i];
        unset($data[$i]);
        $nonProducts = $nonProducts + 1;
      }
    }

    //Obtener cantidad de referencias
    $key_array = array();
    $temp_array = array();
    $i = 0;

    foreach ($data as $val) {
      if (!in_array($val['producto'], $key_array)) {
        $key_array[$i] = $val['producto'];
        $temp_array[$i] = $val;
      }
      $i++;
    }

    $dataImportOrders = array(
      'success' => true, 
      'update' => $update, 
      'insert' => $insert, 
      'nonProducts' => $nonProducts, 
      'pedidos' => sizeof($dataPedidos['data']), 
      'referencias' => sizeof($temp_array)
    );

    // Guardar pedidos existentes
    session_start();
    $data = array_values($data);
    $_SESSION['dataImportPedidos'] = $data;
    $_SESSION['datosActualizar'] = $datosActualizar;  // NUEVO: Guardar datos a actualizar en sesión
    $_SESSION['datosInsertar'] = $datosInsertar;      // NUEVO: Guardar datos a insertar en sesión

    //Guardar campos con productos no existentes
    if ($nonExistentProducts) {
      $nonExistentProducts = array_values($nonExistentProducts);
      $_SESSION['nonExistentProducts'] = $nonExistentProducts;
    }
  } else {
    $dataImportOrders = array('error' => true, 'message' => 'El archivo se encuentra vacio o en formato incorrecto. Intente nuevamente');
  }

  $response->getBody()->write(json_encode($dataImportOrders, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/addPedidos', function (Request $request, Response $response, $args) use ($preBatchDao, $pedidosSinReferenciaDao) {
  session_start();
  $dataPedidos = $_SESSION['dataImportPedidos'];

  // Almacenar pedidos sin referencia
  $dataPedidosSinRef = $_SESSION['nonExistentProducts'];

  !isset($dataPedidosSinRef) ? $count = 0 : $count = sizeof($dataPedidosSinRef);

  for ($i = 0; $i < $count; $i++) {
    if (!empty($dataPedidosSinRef[$i]['documento']) || !empty($dataPedidosSinRef[$i]['producto']))
      $pedidosSinReferenciaDao->savePedidosSinReferencia($dataPedidosSinRef[$i]);
  }

  // NUEVO: Marcar los pedidos actualizados con flag temporal para filtrarlos en la vista
  $datosActualizar = $_SESSION['datosActualizar'] ?? [];
  $idsActualizados = [];
  
  // $data = array();
  for ($i = 0; $i < sizeof($dataPedidos); $i++) {
    $preBatchDao->savePedidos($dataPedidos[$i]);

    //Obtener todos los pedidos
    $data[$i] = $dataPedidos[$i]['documento'] . 'M-' . $dataPedidos[$i]['producto'];
    
    // NUEVO: Si este pedido está en la lista de actualizados, guardamos su ID
    foreach ($datosActualizar as $actualizado) {
      if ($actualizado['documento'] == $dataPedidos[$i]['documento'] && 
          $actualizado['producto'] == $dataPedidos[$i]['producto']) {
        $idsActualizados[] = $dataPedidos[$i]['documento'] . 'M-' . $dataPedidos[$i]['producto'];
        break;
      }
    }
  }

  $result = $preBatchDao->findAllOrders();

  $arrayBD = [];
  for ($i = 0; $i < sizeof($result); $i++) {
    array_push($arrayBD, $result[$i]['concate']);
  }

  $tam_arrayBD = sizeof($arrayBD);
  $tam_result = sizeof($data);

  if ($tam_arrayBD > $tam_result)
    $array_diff = array_diff($arrayBD, $data);
  else
    $array_diff = array_diff($data, $arrayBD);

  //reindezar array
  $array_diff = array_values($array_diff);

  if ($array_diff)
    for ($i = 0; $i < sizeof($array_diff); $i++) {
      $referencia = stristr($array_diff[$i], 'M');
      $posicion =  strrpos($array_diff[$i], "M");
      $documento = substr($array_diff[$i], 0, $posicion);
      $result = $preBatchDao->changeFlagEstadoByPedido($documento, $referencia);
    }
  else if (sizeof($array_diff) == 0)
    $result = null;

  if ($result == null) {
    date_default_timezone_set('America/Bogota');

    $importOrders['fecha_importe'] = date("d/m/Y");
    $importOrders['hora_importe'] = date("h:i a");
    $_SESSION['fecha_importe'] = $importOrders['fecha_importe'];
    $_SESSION['hora_importe'] = $importOrders['hora_importe'];
    
    // NUEVO: Guardar la lista de IDs actualizados para filtrar la vista
    $_SESSION['idsActualizados'] = $idsActualizados;

    $resp = array(
      'success' => true, 
      'message' => 'Pedidos Importados correctamente', 
      'fecha_hora_importe' => $importOrders,
      'idsActualizados' => $idsActualizados  // NUEVO: Enviar los IDs actualizados al frontend
    );
  } else
    $resp = array('error' => true, 'message' => 'Ocurrio un error mientras importaba la información. Intente nuevamente');

  $response->getBody()->write(json_encode($resp));
  return $response->withStatus(200)->withHeader('Content-Type', 'application/json');
});

// NUEVO: Endpoint para obtener solo los pedidos actualizados
$app->get('/getPedidosActualizados', function (Request $request, Response $response, $args) use ($preBatchDao) {
  session_start();
  $idsActualizados = $_SESSION['idsActualizados'] ?? [];
  
  if (empty($idsActualizados)) {
    $response->getBody()->write(json_encode(['data' => []]));
    return $response->withHeader('Content-Type', 'application/json');
  }
  
  // Crear placeholders para la consulta
  $placeholders = str_repeat('?,', count($idsActualizados) - 1) . '?';
  
  $connection = Connection::getInstance()->getConnection();
  $sql = "SELECT DISTINCT ROW_NUMBER() OVER (ORDER BY pp.nombre) AS num, pp.nombre AS propietario, exp.pedido, exp.fecha_pedido, exp.estado, exp.cantidad_acumulada, exp.fecha_insumo, CURRENT_DATE AS fecha_actual, (SELECT referencia FROM producto 
                  WHERE multi = (SELECT multi FROM producto WHERE referencia = exp.id_producto) LIMIT 1) AS granel, exp.id_producto, p.nombre_referencia, exp.cant_original, exp.cantidad, exp.valor_pedido, 
                  IFNULL(DATE_ADD(exp.fecha_insumo, INTERVAL 8 DAY),DATE_ADD(exp.fecha_pedido, INTERVAL 8 DAY)) AS fecha_pesaje, 
                  IFNULL(DATE_ADD(exp.fecha_insumo, INTERVAL 9 DAY),DATE_ADD(exp.fecha_pedido, INTERVAL 9 DAY)) AS fecha_preparacion,
                  IFNULL(DATE_ADD(exp.fecha_insumo, INTERVAL 13 DAY),DATE_ADD(exp.fecha_pedido, INTERVAL 13 DAY)) AS envasado, 
                  IFNULL(DATE_ADD(exp.fecha_insumo, INTERVAL 15 DAY),DATE_ADD(exp.fecha_pedido, INTERVAL 15 DAY)) AS entrega 
              FROM plan_pedidos exp 
                  INNER JOIN producto p ON p.referencia = exp.id_producto 
                  INNER JOIN propietario pp ON pp.id = p.id_propietario
                  WHERE CONCAT(exp.pedido, exp.id_producto) IN ($placeholders) AND exp.flag_estado = 1";
  
  $query = $connection->prepare($sql);
  $query->execute($idsActualizados);
  $result = $query->fetchAll($connection::FETCH_ASSOC);
  
  $response->getBody()->write(json_encode(['data' => $result]));
  return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/deletePedidosSession', function (Request $request, Response $response, $args) {
  //Eliminar variable session
  session_start();
  unset($_SESSION['dataImportPedidos']);
  unset($_SESSION['datosActualizar']);    // NUEVO: Limpiar datos a actualizar
  unset($_SESSION['datosInsertar']);      // NUEVO: Limpiar datos a insertar 
  unset($_SESSION['idsActualizados']);    // NUEVO: Limpiar IDs actualizados
  $response->getBody()->write(json_encode(JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

function multi_array_diff($arr1, $arr2)
{
  $arrDiff = array();
  foreach ($arr1 as $key => $val) {
    if (isset($arr2[$key])) {
      if (is_array($val)) {
        $arrDiff[$key] = multi_array_diff($val, $arr2[$key]);
      } else {
        if (in_array($val, $arr2) != 1) {
          $arrDiff[$key] = $val;
        }
      }
    } else {
      $arrDiff[$key] = $val;
    }
  }
  return $arrDiff;
