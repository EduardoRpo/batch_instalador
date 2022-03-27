<?php


use BatchRecord\dao\TextosPDFDao;
use BatchRecord\dao\BatchDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$textospdfDao = new TextosPDFDao();
$batchDao = new BatchDao();

$app->get('/pdftextos', function (Request $request, Response $response, $args) use ($textospdfDao) {
    $textos = $textospdfDao->findAll();
    $response->getBody()->write(json_encode($textos, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
  });

  $app->get('/searchpdf/{id_batch}', function (Request $request, Response $response, $args) use ($batchDao) {
    $batch = $batchDao->findById($args['id_batch']);
    $response->getBody()->write(json_encode($batch, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
  });
