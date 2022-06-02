<?php


use BatchRecord\dao\PreguntaDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$preguntaDao = new PreguntaDao();

$app->get('/questions', function (Request $request, Response $response, $args) use ($preguntaDao) {
  $batch = $preguntaDao->findAll();
  //$batch = utf8_string_array_encode($array);
  //$batch = utf8_encode($array);
  if ($batch == null) {
    $response->getBody()->write('');
  } else {
    $response->getBody()->write(json_encode($batch));
  }
  return $response->withHeader('Content-Type', 'application/json');
});

// preguntas por modulo
$app->get('/questions/{idModule}', function (Request $request, Response $response, $args) use ($preguntaDao) {
  $array = $preguntaDao->findByModule($args["idModule"]);
  $response->getBody()->write(json_encode($array));

  return $response->withHeader('Content-Type', 'application/json');
});
