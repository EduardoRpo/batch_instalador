<?php
/*

use BatchRecord\dao\UserDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$userDao = new UserDao();

$app->post('/user', function (Request $request, Response $response, $args) use ($userDao) {
    $parsedBody = json_decode($request->getBody(), true);
    $email = $parsedBody["email"];
    $password = $parsedBody["password"];
    $user = $userDao->findByEmail($email);
  
    $resp = array();
    if ($user != null) {
      if ($password === $user["password"]) {
        $user["firma"] = base64_encode($user["firma"]);
        $user["huella"] = base64_encode($user["huella"]);
        $response->getBody()->write(json_encode($user));
        return $response->withStatus(200)->withHeader('Content-Type', 'application/json');
      } else {
        $resp = array('error' => true, 'message' => 'Contraseña Invalida');
        $response->getBody()->write(json_encode($resp));
        return $response->withStatus(401)->withHeader('Content-Type', 'application/json');
      }
    } else {
      $resp = array('error' => true, 'message' => 'Usuario no Existe');
      $response->getBody()->write(json_encode($resp));
      return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
    }
  });
  
  $app->get('/user/{modulo}/{batch}', function (Request $request, Response $response, $args) use ($userDao) {
    $user = $userDao->findByBatch($args["modulo"], $args["batch"]);
    $response->getBody()->write(json_encode($user, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
  });
  
  $app->get('/user/{idUser}', function (Request $request, Response $response, $args) use ($userDao) {
    $user = $userDao->inactive($args["idUser"]);
    $response->getBody()->write(json_encode($user, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
  });
  */