<?php

use BatchRecord\dao\AdminMultiDao;
use BatchRecord\dao\ProductosDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$multiPDao = new AdminMultiDao();

$app->get('/adminMulti', function (Request $request, Response $response, $args) use ($multiPDao) {
  $MultiP = $multiPDao->findAllMulti();
  $response->getBody()->write(json_encode($MultiP, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/deleteMulti', function (Request $request, Response $response, $args) use ($multiPDao) {
  $dataMulti = $request->getParsedBody();
  foreach($dataMulti as $valor){
  $Multi = $multiPDao->deleteMulti($valor);
  }
  
  if ($Multi)
  $response = array('success' => true, 'message' => 'Multipresentacion eliminada correctamente');
  return $response->withHeader('Content-Type', 'application/json');
});

/*
$app->get('/deleteMulti', function (Request $request, Response $response, $args) use ($multiPDao) {
  $Multi = $multiPDao->deleteMulti($args['multi']);

  if ($Multi == null)
    $resp = array('success' => true, 'message' => 'Multipresentacion eliminada correctamente');

  $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

*/

$app->get('/adminProducts', function (Request $request, Response $response, $args) use ($multiPDao){
  $adminProduc = $multiPDao -> adminFindAllProducts();
  $response->getBody()->write(json_encode($adminProduc, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/adminSearch', function (Request $request, Response $response, $args) use ($multiPDao){
  $dataMulti = $request->getParsedBody();
  $multi = $multiPDao->findMultiByReference($dataMulti);
  $response->getBody()->write(json_encode($multi, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type','ap');
});


/*$app->post('/saveMulti', function (Request $request, Response $response, $args) use ($multiPDao) {

  $dataMulti = $request->getParsedBody();

  if ($dataMulti['id']) {
    $Multi = $multiPDao->updateMulti($dataMulti);

    if ($Multi == null)
      $resp = array('success' => true, 'message' => 'Modulo almacenado correctamente');
  } else {
    $Multi = $multiPDao->saveMulti($dataMulti);

    if ($Multi == null)
      $resp = array('success' => true, 'message' => 'Modulo actualizado correctamente');
  }

  $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});
*/

$app->post('/saveMulti', function (Request $request, Response $response, $args) use ($multiPDao){

  $dataMulti = $request->getParsedBody();

  $AN = explode("-", $dataMulti['1']);
});