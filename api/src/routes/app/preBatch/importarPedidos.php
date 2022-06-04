<?php


use BatchRecord\dao\PreBatchDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$preBatchDao = new PreBatchDao();


$app->post('/validacionDatosPedidos', function (Request $request, Response $response, $args) use ($preBatchDao) {
  $dataPedidos = $request->getParsedBody();

  if (isset($dataPedidos)) {

    $insert = 0;
    $update = 0;

    $data = $dataPedidos['data'];

    for ($i = 0; $i < sizeof($data); $i++) {
      $result = $preBatchDao->findOrders($data[$i]['documento']);
      $result ? $update = $update + 1 : $insert = $insert + 1;
    }
    $dataImportOrders = array('success' => true, 'update' => $update, 'insert' => $insert);
  } else
    $dataImportOrders = array('error' => true, 'message' => 'El archivo se encuentra vacio. Intente nuevamente');

  $response->getBody()->write(json_encode($dataImportOrders, JSON_NUMERIC_CHECK));
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
