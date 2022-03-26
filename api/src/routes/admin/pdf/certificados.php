<?php


use BatchRecord\dao\CertificadosDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$certificadosDao = new CertificadosDao();

$app->get('/getAllCerts', function (Request $request, Response $data, $args) use ($certificadosDao) {
  $cert = $certificadosDao->findAllCert($args["id"]);
  $data->getBody()->write(json_encode($cert, JSON_NUMERIC_CHECK));
  return $data->withHeader('Content-Type', 'application/json');
});

$app->get('/getCert/{val}', function (Request $request, Response $response, $args) use ($certificadosDao) {
  $producto = $certificadosDao->findCertById($args["val"]);
  $response->getBody()->write(json_encode($producto, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});
