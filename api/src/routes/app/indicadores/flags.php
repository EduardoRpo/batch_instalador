<?php


use BatchRecord\dao\FlagIndicadoresDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$flagIndicadoresDao = new FlagIndicadoresDao();

$app->get('/dispensacion/{idBatch}', function (Request $request, Response $response, $args) use ($flagIndicadoresDao) {
  $multi = $flagIndicadoresDao->findMultiByBatch($args['idBatch']);
  $response->getBody()->write(json_encode($multi, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/multiref/{ref}', function (Request $request, Response $response, $args) use ($flagIndicadoresDao) {
  $multi = $flagIndicadoresDao->findMultiByRef($args['ref']);
  $response->getBody()->write(json_encode($multi, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/updateMulti', function (Request $request, Response $response, $args) use ($flagIndicadoresDao) {
  $dataMulti = $request->getParsedBody();
  $multi = $flagIndicadoresDao->updateMulti($dataMulti);
  $response->getBody()->write(json_encode($multi, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});


