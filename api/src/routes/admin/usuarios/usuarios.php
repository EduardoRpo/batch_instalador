<?php


use BatchRecord\dao\UsersDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$userDao = new UsersDao();

$app->get('/Users', function (Request $request, Response $response, $args) use ($userDao) {
    $Users = $userDao->findAllUsers();
    $response->getBody()->write(json_encode($Users, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/deleteUsers/{id}', function (Request $request, Response $response, $args) use ($userDao) {
    $Users = $userDao->deleteUsers($args['id']);

    if ($Users == null)
        $resp = array('success' => true, 'message' => 'Ususario eliminado correctamente');

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/saveUsers', function (Request $request, Response $response, $args) use ($userDao) {

    $dataUsers =($request->getParsedBody());
    $ruta = $userDao->UpLoadSing();

    if ($dataUsers['id']) {
        $Users = $userDao->updateUser($dataUsers);

        if ($Users == null)
            $resp = array('success' => true, 'message' => 'Usuario actualizado correctamente');
    } else {
        $Users = $userDao->saveUsers($dataUsers, $ruta);

        if ($Users == null)
            $resp = array('success' => true, 'message' => 'Usuario almacenado correctamente');
    }    


    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/deleteUsers', function (Request $request, Response $response, $args)use($userDao){
    $user = $userDao->deleteUsers($args['id']);

if ($user == null)
    $resp = array('success' => true, 'message' => 'Usuario eliminado correctamente');

$response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
return $response->withHeader('Content-Type', 'application/json');
});
