<?php


use BatchRecord\dao\TextosPDFDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$textospdfDao = new TextosPDFDao();

$app->get('/pdftextos', function (Request $request, Response $response, $args) use ($textospdfDao) {
    $textos = $textospdfDao->findAll();
    $response->getBody()->write(json_encode($textos, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
  });
