<?php


use BatchRecord\dao\ProductsDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$productsDao = new ProductsDao();

$app->get('/productsGranel', function (Request $request, Response $response, $args) use ($productsDao) {
  $batch = $productsDao->findAllProductsGranel();
  $response->getBody()->write(json_encode($batch, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

/* Buscar Un solo granel
$app->post('/productGranel', function (Request $request, Response $response, $args) use ($productsDao) {
  $dataGranel = $request->getParsedBody();

  $granel = $dataGranel['data'];

  $resp = array();
  for ($i = 0; $i < sizeof($granel); $i++) {
    $presentacion = $productsDao->findProductGranel($granel[$i]);
    $resp += array("presentacion-{$granel[$i]['granel']}" => $presentacion);
  }

  $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
}); */
