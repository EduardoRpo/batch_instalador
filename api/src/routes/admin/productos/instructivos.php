<?php


use BatchRecord\dao\IntructivoPreparacionDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$instructivoPreparacionDao = new IntructivoPreparacionDao();

$app->get('/instructivos/{idProducto}', function (Request $request, Response $response, $args) use ($instructivoPreparacionDao) {
  $batch = $instructivoPreparacionDao->findInstructiveByProduct($args["idProducto"]);
  $response->getBody()->write(json_encode($batch, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/saveInstructivos', function (Request $request, Response $response, $args) use ($instructivoPreparacionDao) {
  /* $batch = $instructivoPreparacionDao->findInstructiveByProduct($args["idProducto"]);
  $response->getBody()->write(json_encode($batch, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json'); */
});

$app->get('/updateInstructivos', function (Request $request, Response $response, $args) use ($instructivoPreparacionDao) {
  /* $batch = $instructivoPreparacionDao->findInstructiveByProduct($args["idProducto"]);
  $response->getBody()->write(json_encode($batch, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json'); */
});

$app->get('/deleteInstructivos', function (Request $request, Response $response, $args) use ($instructivoPreparacionDao) {
  /* $batch = $instructivoPreparacionDao->findInstructiveByProduct($args["idProducto"]);
  $response->getBody()->write(json_encode($batch, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json'); */
});