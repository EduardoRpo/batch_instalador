<?php


use BatchRecord\dao\QuestionsDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$questionsDao = new QuestionsDao();

$app->post('/questions', function (Request $request, Response $response, $args) use ($questionsDao) {
  $Questions = $questionsDao->findAllQuestions();
  $response->getBody()->write(json_encode($Questions, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
}); 

$app->get('/deleteQuestions/{id}', function (Request $request, Response $response, $args) use ($questionsDao) {
  $Questions = $questionsDao->deleteQuestions($args['id']);

  if ($Questions == null)
    $resp = array('success' => true, 'message' => 'Pregunta eliminada correctamente');

  $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/saveQuestions', function (Request $request, Response $response, $args) use ($questionsDao) {

  $dataQuestions = $request->getParsedBody();

  if ($dataQuestions['id']) {
    $questions = $questionsDao->updateQuestions($dataQuestions);

    if ($questions == null)
      $resp = array('success' => true, 'message' => 'pregunta actualizada correctamente');
  } else {
    $questions = $questionsDao->saveQuestions($dataQuestions);

    if ($questions == null)
      $resp = array('success' => true, 'message' => 'pregunta almacenada correctamente');
  }

  $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
}); 
