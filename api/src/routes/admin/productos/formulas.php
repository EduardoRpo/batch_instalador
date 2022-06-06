<?php


use BatchRecord\dao\FormulasDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$formulasDao = new FormulasDao();

$app->get('/formula/{idProducto}', function (Request $request, Response $response, $args) use ($formulasDao) {
  $formula = $formulasDao->findFormulaByReference($args["idProducto"]);
  $response->getBody()->write(json_encode($formula, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/saveformulas', function (Request $request, Response $response, $args) use ($formulasDao) {
  /* $formula = $formulasDao->findFormulaByReference($args["idProducto"]);
  $response->getBody()->write(json_encode($formula, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json'); */
});

$app->get('/updateformulas', function (Request $request, Response $response, $args) use ($formulasDao) {
  /* $formula = $formulasDao->findFormulaByReference($args["idProducto"]);
  $response->getBody()->write(json_encode($formula, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json'); */
});

$app->get('/deleteformulas', function (Request $request, Response $response, $args) use ($formulasDao) {
  /* $formula = $formulasDao->findFormulaByReference($args["idProducto"]);
  $response->getBody()->write(json_encode($formula, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json'); */
});