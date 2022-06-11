<?php


use BatchRecord\dao\PreBatchDao;
use BatchRecord\Dao\ProductDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$preBatchDao = new PreBatchDao();
$productDao = new ProductDao();


$app->post('/validacionDatosPedidos', function (Request $request, Response $response, $args) use ($preBatchDao, $productDao) {
  $dataPedidos = $request->getParsedBody();

  //Eliminar variable session
  session_start();
  unset($_SESSION['nonExistentProducts']);

  if (isset($dataPedidos)) {

    $insert = 0;
    $update = 0;

    $data = $dataPedidos['data'];

    $count = sizeof($data);
    for ($i = 0; $i < $count; $i++) {
      //Consultar si existe producto en la base de datos
      $product = $productDao->findProduct($data[$i]['producto']);
      if (!$product) {
        $nonExistentProducts['pedido'][$i] = $data[$i]['documento'];
        $nonExistentProducts['referencia'][$i] = $data[$i]['producto'];
        unset($data[$i]);
      } else {
        $result = $preBatchDao->findOrders($data[$i]['documento']);
        $result ? $update = $update + 1 : $insert = $insert + 1;
      }
    }

    $referencia = sizeof($data);
    //Obtener catidad de referencias
    for ($i = 0; $i < sizeof($data); $i++) {
      for ($j = $i; $j < sizeof($data); $j++) {
        $j == $i ? $j = $j + 1 : $j;
        if ($data[$i]['producto'] == $data[$j]['producto']) $referencia = $referencia - 1;
      }
    }
    $dataImportOrders = array('success' => true, 'update' => $update, 'insert' => $insert, 'pedidos' => sizeof($data), 'referencias' => $referencia);

    if (isset($nonExistentProducts)) {
      $nonExistentProducts['pedido'] = array_values($nonExistentProducts['pedido']);
      $nonExistentProducts['referencia'] = array_values($nonExistentProducts['referencia']);
    }
    
    //Guardar campos con productos no existentes
    if ($nonExistentProducts) {
      session_start();
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
  else $resp = array('error' => true, 'message' => 'Todos los pedidos fueron importados correctamente');

  $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/addPedidos', function (Request $request, Response $response, $args) use ($preBatchDao) {
  $dataPedidos = $request->getParsedBody();
  $dataPedidos = $dataPedidos['data'];

  for ($i = 0; $i < sizeof($dataPedidos); $i++)
    $result = $preBatchDao->savePedidos($dataPedidos[$i]);

  //Al cargar los pedidos validar la tabla vs pedidos y si no encuentra el registro marcar con un flag y no mostar en la vista Preprogramados
  //Cargar todos registros de la tabla que no tengan flag y validarlos contra el objeto de importacion

  if ($result == null)
    $resp = array('success' => true, 'message' => 'Pedidos Importados correctamente');
  else
    $resp = array('error' => true, 'message' => 'Ocurrio un error mientras importaba la información. Intente nuevamente');

  $response->getBody()->write(json_encode($resp));
  return $response->withStatus(200)->withHeader('Content-Type', 'application/json');
});
