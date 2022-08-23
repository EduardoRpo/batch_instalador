<?php

use BatchRecord\dao\PreBatchDao;
use BatchRecord\Dao\ProductDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$preBatchDao = new PreBatchDao();
$productDao = new ProductDao();


$app->post('/validacionDatosPedidos', function (Request $request, Response $response, $args) use ($preBatchDao, $productDao) {
  $dataPedidos = $request->getParsedBody();

  if (isset($dataPedidos)) {

    $nonProducts = 0;
    $insert = 0;
    $update = 0;

    $dataGlobal = $dataPedidos['data'];
    $data = $dataPedidos['data'];

    for ($i = 0; $i < sizeof($dataGlobal); $i++) {
      //Consultar si existe producto en la base de datos
      $product = $productDao->findProduct(trim($dataGlobal[$i]['producto']));

      if (!$product) {
        $nonExistentProducts['pedido'][$i] = trim($dataGlobal[$i]['documento']);
        $nonExistentProducts['referencia'][$i] = trim($dataGlobal[$i]['producto']);
        unset($data[$i]);
        $nonProducts = $nonProducts + 1;
      } else {
        $result = $preBatchDao->findOrders($dataGlobal[$i]['documento']);
        $result ? $update = $update + 1 : $insert = $insert + 1;
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

    $dataImportOrders = array('success' => true, 'update' => $update, 'insert' => $insert, 'nonProducts' => $nonProducts, 'pedidos' => sizeof($dataPedidos['data']), 'referencias' => sizeof($temp_array));

    // Guardar pedidos existentes
    session_start();
    $data = array_values($data);
    $_SESSION['dataImportPedidos'] = $data;

    //Guardar campos con productos no existentes
    if ($nonExistentProducts) {
      $nonExistentProducts['pedido'] = array_values($nonExistentProducts['pedido']);
      $nonExistentProducts['referencia'] = array_values($nonExistentProducts['referencia']);
      $_SESSION['nonExistentProducts'] = $nonExistentProducts;
    }
  } else $dataImportOrders = array('error' => true, 'message' => 'El archivo se encuentra vacio. Intente nuevamente');

  $response->getBody()->write(json_encode($dataImportOrders, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/sendNonExistentProducts', function (Request $request, Response $response, $args) {
  session_start();
  $data = $_SESSION['nonExistentProducts'];

  if ($data) $resp = $data;
  else $resp = array('error' => true, 'message' => 'Importe un nuevo archivo');

  $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/addPedidos', function (Request $request, Response $response, $args) use ($preBatchDao) {
  session_start();
  $dataPedidos = $_SESSION['dataImportPedidos'];

  // $data = array();
  for ($i = 0; $i < sizeof($dataPedidos); $i++) {
    $result = $preBatchDao->savePedidos($dataPedidos[$i]);

    //Obtener todos los pedidos
    $data[$i] = $dataPedidos[$i]['documento'];
  }
  //Al cargar los pedidos validar la tabla vs pedidos y si no encuentra el registro marcar con un flag y no mostar en la vista Preprogramados
  //Cargar todos registros de la tabla que no tengan flag y validarlos contra el objeto de importacion
  $result = $preBatchDao->changeFlagEstadoByPedido($data);

  if ($result == null)
    $resp = array('success' => true, 'message' => 'Pedidos Importados correctamente');
  else
    $resp = array('error' => true, 'message' => 'Ocurrio un error mientras importaba la información. Intente nuevamente');

  $response->getBody()->write(json_encode($resp));
  return $response->withStatus(200)->withHeader('Content-Type', 'application/json');
});

$app->get('/deletePedidosSession', function (Request $request, Response $response, $args) {
  //Eliminar variable session
  session_start();
  unset($_SESSION['nonExistentProducts'], $_SESSION['dataImportPedidos']);
  $response->getBody()->write(json_encode(JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});
