<?php


use BatchRecord\dao\DataSelectorDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$dataselectorDao = new DataSelectorDao();

/* $app->get('/getDataSelectorModule/{tbl}', function (Request $request, Response $data, $args) use ($dataselectorDao) {
  $dataSelector = $dataselectorDao->findSelectorModules($args["id"]);
  $data->getBody()->write(json_encode($dataSelector, JSON_NUMERIC_CHECK));
  return $data->withHeader('Content-Type', 'application/json');
}); */

$app->get('/getDataSelector/{tbl}', function (Request $request, Response $data, $args) use ($dataselectorDao) {
  $dataSelector = $dataselectorDao->findData($args["tbl"]);
  $data->getBody()->write(json_encode($dataSelector, JSON_NUMERIC_CHECK));
  return $data->withHeader('Content-Type', 'application/json');
});
