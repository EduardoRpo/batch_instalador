<?php

use BatchRecord\dao\FormulasDao;
use BatchRecord\dao\FormulasInvimaDao;
use BatchRecord\dao\HealthNotificationDao;
use BatchRecord\dao\AdminMultiDao;
use BatchRecord\dao\EstadoInicialDao;
use BatchRecord\dao\BatchDao;
use BatchRecord\dao\PlanPrePlaneadosDao;
use BatchRecord\dao\ProductsDao;
use BatchRecord\dao\AuditoriaFormulasDao;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$formulasDao = new FormulasDao();
$formulasInvimasDao = new FormulasInvimaDao();
$healthNotificationDao = new HealthNotificationDao();
$adminMultiDao = new AdminMultiDao();
$estadoInicialDao = new EstadoInicialDao();
$batchDao = new BatchDao();
$productsDao = new ProductsDao();
$prePlaneadosDao = new PlanPrePlaneadosDao();
$auditoriaFormulasDao = new AuditoriaFormulasDao();

$app->get('/formula/{idProducto}', function (Request $request, Response $response, $args) use ($formulasDao) {
  $formula = $formulasDao->findFormulaByReference($args["idProducto"]);
  $response->getBody()->write(json_encode($formula, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/formulatbl', function (Request $request, Response $response, $args) use ($formulasDao) {
  $formula = $formulasDao->findAllFormulas();
  $response->getBody()->write(json_encode($formula, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/formulaInvimatbl/{idProducto}', function (Request $request, Response $response, $args) use ($formulasInvimasDao) {
  $formula = $formulasInvimasDao->findAllFormulaInvimaByReferencia($args["idProducto"]);
  $response->getBody()->write(json_encode($formula, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/newFormula', function (Request $request, Response $response, $args) use (
  $formulasDao,
  $batchDao,
  $prePlaneadosDao,
  $productsDao,
  $estadoInicialDao,
  $auditoriaFormulasDao
) {
  $dataFormula =  $request->getParsedBody();
  $resp = $formulasDao->saveFormula($dataFormula);

  $auditoriaFormulasDao->auditFormula($dataFormula, '', 'UPDATE');

  $batchs = $batchDao->findBatchByRef($dataFormula['ref_producto']);

  for ($i = 0; $i < sizeof($batchs); $i++) {
    if ($batchs[$i]['estado'] == 1) {
      $estado = $estadoInicialDao->estadoInicial($dataFormula['ref_producto'], '');
      $batchDao->updateEstadoBatch($batchs[$i]['id_batch'], $estado[0]);
    }
  }

  $estado = $prePlaneadosDao->checkFormulasAndInstructivos($dataFormula['ref_producto']);

  $referencias = $productsDao->findReferenceByGranel($dataFormula['ref_producto']);

  for ($i = 0; $i < sizeof($referencias); $i++) {
    $prePlaneadosDao->updateEstadoPreplaneado($referencias[$i]['referencia'], $estado);
  }

  $resp == null
    ? $resp = array('success' => true, 'message' => 'Formula Creada Correctamente')
    : $resp = array('error' => true, 'message' => 'Ocurrio un error mientras guardaba. Intente nuevamente');

  $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/deleteformulas', function (Request $request, Response $response, $args) use (
  $formulasDao,
  $formulasInvimasDao,
  $healthNotificationDao,
  $adminMultiDao,
  $auditoriaFormulasDao
) {
  $dataFormula =  $request->getParsedBody();

  $dataFormula['tbl'] == 'r' ? $tbl = 'formula' : $tbl = 'formula_f';
  $rows = $formulasDao->findFormulaByRefMaterial($dataFormula, $tbl);
  $auditoriaFormulasDao->auditFormula($dataFormula, $rows, 'DELETE');

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

$app->post('/SaveFormula', function (Request $request, Response $response, $args) use (
  $formulasDao,
  $formulasInvimasDao,
  $healthNotificationDao,
  $estadoInicialDao,
  $batchDao,
  $productsDao,
  $prePlaneadosDao,
  $auditoriaFormulasDao
) {
  $dataFormula = $request->getParsedBody();

  $dataFormula['tbl'] == 'r' ? $tbl = 'formula' : $tbl = 'formula_f';

  if ($tbl == 'formula') {
    $rows = $formulasDao->findFormulaByRefMaterial($dataFormula, $tbl);
    if ($rows != null) {
      $auditoriaFormulasDao->auditFormula($dataFormula, $rows, 'UPDATE');
      $formula = $formulasDao->updateFormula($dataFormula, $tbl);

      $formula == null
        ? $resp = array('success' => true, 'message' => 'Formula Actualizada Correctamente')
        : $resp = array('error' => true, 'message' => 'Ocurrio un error mientras guardaba. Intente nuevamente');
    } else {
      $data['array'][0]['0'] = $dataFormula['ref_materiaprima'];
      $data['array'][0]['2'] = $dataFormula['porcentaje'];

      $data['ref_producto'] = $dataFormula['ref_producto'];

      $result = $formulasDao->saveFormula($data, $tbl);

      if ($result == null) {
        $lastId = $formulasDao->findLastInsertedFormula();
        $dataFormula['id'] = $lastId['id'];

        $auditoriaFormulasDao->auditFormula($dataFormula, '',  'INSERT');
      }

      if ($result == null) {
        $batchs = $batchDao->findBatchByRef($dataFormula['ref_producto']);

        for ($i = 0; $i < sizeof($batchs); $i++) {
          if ($batchs[$i]['estado'] == 1) {
            $estado = $estadoInicialDao->estadoInicial($dataFormula['ref_producto'], '');
            $batchDao->updateEstadoBatch($batchs[$i]['id_batch'], $estado[0]);
          }
        }

        $estado = $prePlaneadosDao->checkFormulasAndInstructivos($dataFormula['ref_producto']);

        $referencias = $productsDao->findReferenceByGranel($dataFormula['ref_producto']);

        for ($i = 0; $i < sizeof($referencias); $i++) {
          $prePlaneadosDao->updateEstadoPreplaneado($referencias[$i]['referencia'], $estado);
        }
      }

      $result == null
        ? $resp = array('success' => true, 'message' => 'Formula Almacenada Correctamente')
        : $resp = array('error' => true, 'message' => 'Ocurrio un error mientras guardaba. Intente nuevamente');
    }
  } else {

    $notif_sanitaria = $healthNotificationDao->SearchIdNotifiSanitaria($dataFormula);
    $rows = $formulasInvimasDao->countRowFormulainvima($dataFormula['ref_producto'], $notif_sanitaria);

    if ($rows > 0) {
      $auditoriaFormulasDao->auditFormula($dataFormula, '',  'UPDATE');
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
