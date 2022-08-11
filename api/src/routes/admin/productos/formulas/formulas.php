<?php


use BatchRecord\dao\FormulasDao;
use BatchRecord\dao\FormulasInvimaDao;
use BatchRecord\dao\HealthNotificationDao;
use BatchRecord\dao\AdminMultiDao;
use BatchRecord\dao\EstadoInicialDao;
use BatchRecord\dao\BatchDao;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$formulasDao = new FormulasDao();
$formulasInvimasDao = new FormulasInvimaDao();
$healthNotificationDao = new HealthNotificationDao();
$adminMultiDao = new AdminMultiDao();
$estadoInicialDao = new EstadoInicialDao();
$batchDao = new BatchDao();

$app->get('/formula/{idProducto}', function (Request $request, Response $response, $args) use ($formulasDao) {
  $formula = $formulasDao->findFormulaByReference($args["idProducto"]);
  $response->getBody()->write(json_encode($formula, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/formulatbl/{idProducto}', function (Request $request, Response $response, $args) use ($formulasDao) {
  $formula = $formulasDao->findFormulaByReference($args["idProducto"]);
  $response->getBody()->write(json_encode($formula, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/formulaInvimatbl/{idProducto}', function (Request $request, Response $response, $args) use ($formulasInvimasDao) {
  $formula = $formulasInvimasDao->findAllFormulaInvima($args["idProducto"]);
  $response->getBody()->write(json_encode($formula, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

// $app->post('/SearchFormulaAll', function (Request $request, Response $response, $args) use ($formulasDao) {

//   $dataFormula = $request->getParsedBody();
//   $formula = $formulasDao->findFormulaByCase3($dataFormula);
//   $response->getbody()->write(json_encode($formula, JSON_NUMERIC_CHECK));
//   return $response->withHeader('Content-Type', 'application/json');

// });

// $app->get('/saveformulas', function (Request $request, Response $response, $args) use ($formulasDao) {
//   $formula = $formulasDao->findFormulaByReference($args["idProducto"]);
//   $response->getBody()->write(json_encode($formula, JSON_NUMERIC_CHECK));
//   return $response->withHeader('Content-Type', 'application/json');
// });

/* $app->get('/updateformulas', function (Request $request, Response $response, $args) use ($formulasDao) {
  $formula = $formulasDao->findFormulaByReference($args["idProducto"]);
  $response->getBody()->write(json_encode($formula, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
}); */

$app->post('/deleteformulas', function (Request $request, Response $response, $args) use ($formulasDao, $formulasInvimasDao, $healthNotificationDao, $adminMultiDao) {
  $dataFormula =  $request->getParsedBody();
  if ($dataFormula['tbl'] == 'r') {
    $ref_multi =  $adminMultiDao->findMultiByReference($dataFormula);

    if ($ref_multi == null) {
      $formula = $formulasDao->deleteFormula($dataFormula);
      $formula == null

        ? $resp = array('success' => true, 'message' => 'Formula Eliminada Correctamente')
        : $resp = array('error' => true, 'message' => 'Ocurrio un error mientras guardaba. Intente nuevamente');
    } else {
      $formula = $formulasDao->deleteFormula($dataFormula, $ref_multi);
      $formula == null

        ? $resp = array('success' => true, 'message' => 'Formula Eliminada Correctamente')
        : $resp = array('error' => true, 'message' => 'Ocurrio un error mientras guardaba. Intente nuevamente');
    }
  } else {
    $notif_sanitaria = $healthNotificationDao->SearchIdNotifiSanitaria($dataFormula);
    $formula = $formulasInvimasDao->deleteFormula($dataFormula, $notif_sanitaria);
  }
  $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/SaveFormula', function (Request $request, Response $response, $args) use ($formulasDao, $formulasInvimasDao, $healthNotificationDao, $estadoInicialDao, $batchDao) {
  $dataFormula = $request->getParsedBody();
  //$dataFormula['tbl'] == 'r' ? $dataFormula['tbl'] = 'formula' : $dataFormula['tbl'] = 'formula_f';

  $dataFormula['tbl'] == 'r' ? $tbl = 'formula' : $tbl = 'formula_f';
  

  if ($tbl == 'formula') {
    $rows = $formulasDao->findFormulaByRefMaterial($dataFormula, $tbl);
    if ($rows != null) {
      $formula = $formulasDao->updateFormula($dataFormula, $tbl);

      $formula == null
        ? $resp = array('success' => true, 'message' => 'Formula Actualizada Correctamente')
        : $resp = array('error' => true, 'message' => 'Ocurrio un error mientras guardaba. Intente nuevamente');
    } else {
      $result = $formulasDao->saveFormula($dataFormula, $tbl);
      if ($result == null) {
        $estadoBatch = $estadoInicialDao->estadoInicial($dataFormula['ref_producto'], $fechaprogramacion = "");
        $dataBatchEstado = $batchDao->findEstadoBatch($dataFormula['ref_producto']);

        for ($i = 0; $i < sizeof($dataBatchEstado); $i++)
          if ($dataBatchEstado['estado'] > 0 && $$dataBatchEstado['estado'] < 3)
            $result = $batchDao->updateEstadoBatch($estadoBatch);
      }

      $result == null
        ? $resp = array('success' => true, 'message' => 'Formula Almacenada Correctamente')
        : $resp = array('error' => true, 'message' => 'Ocurrio un error mientras guardaba. Intente nuevamente');
    }
  } else {

    $notif_sanitaria = $healthNotificationDao->SearchIdNotifiSanitaria($dataFormula);
    $rows = $formulasInvimasDao->countRowFormulainvima($dataFormula['ref_producto'], $notif_sanitaria);

    if ($rows > 0) {
      $formula = $formulasInvimasDao->updateFormula($dataFormula, $notif_sanitaria);

      $formula == null
        ? $resp = array('success' => true, 'message' => 'Formula Actualizada Correctamente')
        : $resp = array('error' => true, 'message' => 'Formula Actualizada Correctamente');
    } else {
      $formula = $formulasInvimasDao->saveFormula($dataFormula, $notif_sanitaria);

      $formula == null
        ? $resp = array('success' => true, 'message' => 'Formula Almacenada Correctamente')
        : $resp = array('error' => true, 'message' => 'Ocurrio un error mientras guardaba. Intente nuevamente');
    }
  }

  $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});
