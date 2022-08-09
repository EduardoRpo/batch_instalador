<?php


use BatchRecord\dao\FormulasDao;
use BatchRecord\dao\FormulasInvimaDao;
use BatchRecord\dao\healthNotificationDao;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$formulasDao = new FormulasDao();
$formulasInvimasDao = new  FormulasInvimaDao();
$healthNotificationDao = new  healthNotificationDao();

$app->get('/formula/{idProducto}', function (Request $request, Response $response, $args) use ($formulasDao) {
  $formula = $formulasDao->findFormulaByReference($args["idProducto"]);
  $response->getBody()->write(json_encode($formula, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/formulatbl/{idProducto}', function (Request $request, Response $response, $args) use ($formulasDao) {
  $formula = $formulasDao->findFormulaByCase3($args["idProducto"]);
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

$app->post('/deleteformulas', function (Request $request, Response $response, $args) use ($formulasDao, $formulasInvimasDao) {
  $dataFormula =  $request->getParsedBody();
  if ($dataFormula['tbl'] == 'r') {
    $ref_multi =  $formulasDao->FindMultiByFormula($dataFormula);

    if ($ref_multi == null) {
      $formula = $formulasDao->deleteFormula($dataFormula);
    } else {
      $formula = $formulasDao->deleteFormulaMulti($dataFormula, $ref_multi);
    }
  } else {
    $notif_sanitaria = $formulasInvimasDao->SearchIdNotifiSanitaria($dataFormula);
    $formula = $formulasInvimasDao->deleteFormula($dataFormula, $notif_sanitaria);
  }
  $resp = array('success' => true, 'message' => 'Formula eliminada Correctamente');
  $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/SaveFormula', function (Request $request, Response $response, $args) use ($formulasDao, $formulasInvimasDao) {
  $dataFormula = $request->getParsedBody();
  //$dataFormula['tbl'] == 'r' ? $dataFormula['tbl'] = 'formula' : $dataFormula['tbl'] = 'formula_f';

  $dataFormula['tbl'] == 'r' ? $tbl = 'formula' : $tbl = 'formula_f';
  $rows = $formulasDao->findFormulaByRefMaterial($dataFormula, $tbl);

  if ($tbl == 'formula') {
    if ($rows > 0) {
      $formula = $formulasDao->updateFormula($dataFormula, $tbl);
      $formula == null
        ? $resp = array('success' => true, 'message' => 'Formula Actualizada Correctamente')
        : $resp = array('error' => true, 'message' => 'Ocurrio un error mientras guardaba. Intente nuevamente');
    } else {
      $formula = $formulasDao->saveFormula($dataFormula, $tbl);
      $formula == null
        ? $resp = array('success' => true, 'message' => 'Formula Almacenada Correctamente')
        : $resp = array('error' => true, 'message' => 'Ocurrio un error mientras guardaba. Intente nuevamente');
    }
  } else {

    $notif_sanitaria = $formulasInvimasDao->SearchIdNotifiSanitaria($dataFormula);
    //$rows = $formulasInvimasDao->countRowFormulainvima($dataFormula, $notif_sanitaria);

    if ($rows > 0) {
      $formula = $formulasInvimasDao->updateFormula($dataFormula, $notif_sanitaria);

      $formula == null
        ? $resp = array('success' => true, 'message' => 'Formula Actualizada Correctamente')
        : $resp = array('error' => true, 'message' => 'Formula Actualizada Correctamente');
    } else {
      $formula = $formulasInvimasDao->saveFormula($dataFormula, $notif_sanitaria);
      if ($formula = null)
        $resp = array('success' => true, 'message' => 'Formula Almacenada Correctamente');
    }
  }

  $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});
