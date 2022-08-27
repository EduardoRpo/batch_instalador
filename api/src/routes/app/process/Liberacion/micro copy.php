<?php

use BatchRecord\dao\DesinfectanteDao;
use BatchRecord\dao\AnalisisMicrobiologicoDao;
use BatchRecord\dao\EquipmentsAppDao;
use BatchRecord\dao\UserAppDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$disinfectantDao = new DesinfectanteDao();
$microDao = new AnalisisMicrobiologicoDao();
$equipmentsDao = new EquipmentsAppDao();
$userDao = new UserAppDao();

$app->get('/micro/{batch}/{module}', function (Request $request, Response $response, $args) use ($microDao, $equipmentsDao, $userDao, $disinfectantDao) {
  $equipment = $equipmentsDao->findEquipmentsByBatchAndModule($args['batch'], $args['module']);

  if ($equipment) {

    $dataDesinfectante = $disinfectantDao->findDisinfectantByBatchandModule($args['batch'], $args['module']);
    $dataAnalisis = $microDao->findAllInfoMicroByBatch($args['batch']);
    $userRealizo = $userDao->findUserById($dataAnalisis[0]['realizo']);

    if ($dataAnalisis[0]['verifico'] == 0)
      $userVerifico[] = 'false';
    else
      $userVerifico = $userDao->findUserById($dataAnalisis[0]['verifico']);

    $result = array_merge($dataDesinfectante, $equipment, $dataAnalisis, $userRealizo, $userVerifico);
  }


  $response->getBody()->write(json_encode($result, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});
