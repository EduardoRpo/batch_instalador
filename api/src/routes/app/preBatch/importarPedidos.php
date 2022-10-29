<?php

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

  if (isset($dataPedidos)) {

    $nonProducts = 0;
    $insert = 0;
    $update = 0;

    $dataGlobal = $dataPedidos['data'];

    // Convertir campos
    for ($i = 0; $i < sizeof($dataGlobal); $i++) {
      $dataConvertPedidos = $preBatchDao->convertData($dataGlobal[$i]);

      $dataGlobal[$i]['cliente'] = $dataConvertPedidos['cliente'];
      $dataGlobal[$i]['documento'] = $dataConvertPedidos['documento'];
      $dataGlobal[$i]['producto'] = $dataConvertPedidos['producto'];
      $dataGlobal[$i]['cant_original'] = $dataConvertPedidos['cant_original'];
      $dataGlobal[$i]['cantidad'] = $dataConvertPedidos['cantidad'];
      $dataGlobal[$i]['valor_pedido'] = $dataConvertPedidos['valor_pedido'];
    }
    $data = $dataGlobal;

    for ($i = 0; $i < sizeof($dataGlobal); $i++) {

      //Consultar si existe producto en la base de datos
      $product = $productDao->findProduct(trim($dataGlobal[$i]['producto']));

      if (!$product) {
        $nonExistentProducts[$i] = $dataGlobal[$i];
        unset($data[$i]);
        $nonProducts = $nonProducts + 1;
      } else {
        // Consultar si el producto esta ingresado en la tabla `plan_pedidos_sin_referencia`
        $pedidosSinReferencia = $pedidosSinReferenciaDao->findPedidoSinReferencia($dataGlobal[$i]);

        // Eliminar registro de la tabla `plan_pedidos_sin_referencia`
        if ($pedidosSinReferencia)
          $pedidosSinReferenciaDao->deletePedidosSinReferencia($dataGlobal[$i]);

        $result = $preBatchDao->findOrders($dataGlobal[$i]['documento']);
        $result ? $update = $update + 1 : $insert = $insert + 1;
      }
    }

    //if (!isset($dataImportOrders)) {
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

    $dataImportOrders = array('success' => true, 'update' => $update, 'insert' => $insert, 'nonProducts' => $nonProducts, 'pedidos' => sizeof($dataPedidos['data']), 'referencias' => sizeof($temp_array));

    // Guardar pedidos existentes
    session_start();
    $data = array_values($data);
    $_SESSION['dataImportPedidos'] = $data;

    //Guardar campos con productos no existentes
    if ($nonExistentProducts) {
      $nonExistentProducts = array_values($nonExistentProducts);
      $_SESSION['nonExistentProducts'] = $nonExistentProducts;
    }
    //}
  } else $dataImportOrders = array('error' => true, 'message' => 'El archivo se encuentra vacio. Intente nuevamente');

  $response->getBody()->write(json_encode($dataImportOrders, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/sendNonExistentProducts', function (Request $request, Response $response, $args) {
  session_start();
  $data = $_SESSION['nonExistentProducts'];

  if ($data) {
    $resp = $data;
    unset($_SESSION['nonExistentProducts']);
  } else $resp = array('error' => true, 'message' => 'Importe un nuevo archivo');

  $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/addPedidos', function (Request $request, Response $response, $args) use ($preBatchDao, $pedidosSinReferenciaDao) {
  session_start();
  $dataPedidos = $_SESSION['dataImportPedidos'];


  // Almacenar pedidos sin referencia
  $dataPedidosSinRef = $_SESSION['nonExistentProducts'];

  !isset($dataPedidosSinRef) ? $count = 0 : $count = sizeof($dataPedidosSinRef);

  for ($i = 0; $i < $count; $i++) {
    $pedidosSinReferenciaDao->savePedidosSinReferencia($dataPedidosSinRef[$i]);
  }


  // $data = array();
  for ($i = 0; $i < sizeof($dataPedidos); $i++) {
    $preBatchDao->savePedidos($dataPedidos[$i]);

    //Obtener todos los pedidos
    $data[$i] = $dataPedidos[$i]['documento'] . 'M-' . $dataPedidos[$i]['producto'];
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

    $resp = array('success' => true, 'message' => 'Pedidos Importados correctamente', 'fecha_hora_importe' => $importOrders);
  } else
    $resp = array('error' => true, 'message' => 'Ocurrio un error mientras importaba la información. Intente nuevamente');

  $response->getBody()->write(json_encode($resp));
  return $response->withStatus(200)->withHeader('Content-Type', 'application/json');
});

$app->get('/deletePedidosSession', function (Request $request, Response $response, $args) {
  //Eliminar variable session
  session_start();
  unset($_SESSION['dataImportPedidos']);
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
}
