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


/*
  foreach($dataMulti as $valor){
  $Multi = $multiPDao->deleteMulti($valor);
  }
  
  if ($Multi)
  $response = array('success' => true, 'message' => 'Multipresentacion eliminada correctamente');
  return $response->withHeader('Content-Type', 'application/json');

);
*/
/*
$app->get('/deleteMulti', function (Request $request, Response $response, $args) use ($multiPDao) {
  $Multi = $multiPDao->deleteMulti($args['multi']);

  if ($Multi == null)
    $resp = array('success' => true, 'message' => 'Multipresentacion eliminada correctamente');

  $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

*/

$app->get('/adminProducts', function (Request $request, Response $response, $args) use ($multiPDao) {
  $adminProduc = $multiPDao->adminFindAllProducts();
  $response->getBody()->write(json_encode($adminProduc, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/adminSearch', function (Request $request, Response $response, $args) use ($multiPDao) {
  $dataMulti = $request->getParsedBody();
  $multi = $multiPDao->findMultiByReference($dataMulti);
  $response->getBody()->write(json_encode($multi, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'ap');
});


$app->post('/saveMulti', function (Request $request, Response $response, $args) use ($multiPDao) {

  $dataMulti = $request->getParsedBody();
  $nameGranel = '';

  $multi = $dataMulti['multi'];

  for ($i = 0; $i < sizeof($multi); $i++) {
    $granel = str_split($multi[$i], 7);

    if ($granel[0] == 'Granel-') {
      $nameGranel = 'A-' . $granel[1];
      break;
    }
  }

  $Multi = $multiPDao->saveMulti($multi, $nameGranel);

  if ($Multi == null)
    $resp = array('success' => true, 'message' => 'Multipresentacion creada correctamente');

  $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});


$app->get('/deleteMulti/{Shref}', function (Request $request, Response $response, $args) use ($multiPDao) {
$Multi = $multiPDao->deleteMulti($args['Shref']);

  if ($Multi == null)
    $resp = array('success' => true, 'message' => 'Multipresentacion eliminada correctamente');

  $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
  });

