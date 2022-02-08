<?php


use BatchRecord\dao\MateriaPrimaDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$materiaPrimaDao = new MateriaPrimaDao();

$app->get('/etiquetasvirtuales/{idProduct}/{batch}', function (Request $request, Response $response, $args) use ($materiaPrimaDao) {
    $materiasprimas = $materiaPrimaDao->findByProduct($args["idProduct"]);
    $batch = $materiaPrimaDao->findVirtualByBatch($args["batch"]);
    $tanques = $materiaPrimaDao->findTanksByBatch($args["batch"]);
    $result = array_merge($materiasprimas, $batch, $tanques);
  
    $response->getBody()->write(json_encode($result, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
  });
  
  $app->get('/etiquetasvirtualesinv/{idProduct}/{batch}', function (Request $request, Response $response, $args) use ($materiaPrimaDao) {
    $materiasprimas = $materiaPrimaDao->findByProductInv($args["idProduct"]);
    $batch = $materiaPrimaDao->findVirtualByBatch($args["batch"]);
    $tanques = $materiaPrimaDao->findTanksByBatch($args["batch"]);
    $result = array_merge($materiasprimas, $batch, $tanques);
  
    $response->getBody()->write(json_encode($result, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
  });