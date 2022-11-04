<?php


use BatchRecord\dao\IntructivoPreparacionDao;
use BatchRecord\dao\BatchDao;
use BatchRecord\dao\EstadoInicialDao;
use BatchRecord\dao\PlanPrePlaneadosDao;
use BatchRecord\dao\ProductsDao;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$instructivoPreparacionDao = new IntructivoPreparacionDao();
$batchDao = new BatchDao();
$estadoInicialDao = new EstadoInicialDao();
$prePlaneadosDao = new PlanPrePlaneadosDao();
$productsDao = new ProductsDao();

$app->get('/instructivos/{idProducto}', function (Request $request, Response $response, $args) use ($instructivoPreparacionDao) {
  $batch = $instructivoPreparacionDao->findInstructiveByProduct($args["idProducto"]);
  $response->getBody()->write(json_encode($batch, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/saveInstructivos', function (Request $request, Response $response, $args) use ($instructivoPreparacionDao, $batchDao, $estadoInicialDao, $productsDao, $prePlaneadosDao) {
  $dataInstructive = $request->getParsedBody();
  if ($dataInstructive['id']) {
    $instructivo = $instructivoPreparacionDao->updateInstructive($dataInstructive);
    if ($instructivo == null)
      $resp = array('success' => true, 'message' => 'Instructivo actualizado correctamente');
  } else {

    //actualizar estado del batch si el instructivo fue ingresado por primera vez

    $instructiveBatch = $instructivoPreparacionDao->findInstructiveByProduct($dataInstructive["referencia"]);

    if (!$instructiveBatch) {
      $resp = $instructivoPreparacionDao->saveInstructive($dataInstructive);

      if ($resp == null)
        $batchs = $batchDao->findBatchByRef($dataInstructive['referencia']);

      for ($i = 0; $i < sizeof($batchs); $i++)
        if ($batchs[$i]['estado'] == 1) {
          $estado = $estadoInicialDao->estadoInicial($dataInstructive['referencia'], '');
          $batchDao->updateEstadoBatch($batchs[$i]['id_batch'], $estado[0]);
        }

      $estado = $prePlaneadosDao->checkFormulasAndInstructivos($dataInstructive['referencia']);

      $referencias = $productsDao->findReferenceByGranel($dataInstructive['referencia']);

      for ($i = 0; $i < sizeof($referencias); $i++) {
        $prePlaneadosDao->updateEstadoPreplaneado($referencias[$i]['referencia'], $estado);
      }
    } else
      $instructivo = $instructivoPreparacionDao->saveInstructive($dataInstructive);

    if ($instructivo == null)
      $resp = array('success' => true, 'message' => 'Instructivo creado correctamente');
  }
  $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});


$app->post('/deleteInstructivos', function (Request $request, Response $response, $args) use ($instructivoPreparacionDao) {
  $dataInstructive = $request->getParsedBody();
  $instructivo = $instructivoPreparacionDao->deleteInstructive($dataInstructive);
  if ($instructivo == null) {
    $resp = array('success' => true, 'message' => 'Instructivo actualizado correctamente');
  }
  $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});
