<?php

use BatchRecord\dao\batchEnvasadoDao;
use BatchRecord\dao\EnvasadoDao;
use BatchRecord\dao\exportarExcelDao;

$batchEnvasadoDao = new batchEnvasadoDao();
$envasadoDao = new EnvasadoDao();
$exportExcelDao = new exportarExcelDao();

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->post('/gestionEnvasado', function (Request $request, Response $response, $args) use ($batchEnvasadoDao, $exportExcelDao, $envasadoDao, $contadorDao) {
    $dates = $request->getParsedBody();

    $date1 = $dates['fechaInicial'] . ' 00:00:00';
    $date2 = $dates['fechaFinal'] . ' 23:59:00';

    $dataBatch = $batchEnvasadoDao->findBatchEnvasadoxDate($date1, $date2);

    if ($dataBatch) {
        for ($i = 0; $i < sizeof($dataBatch); $i++) {
            $dataEnvasado = $envasadoDao->findAllEnvase($dataBatch[$i]['referencia_comercial']);
            $arrayBD[$i] = array_merge($dataBatch[$i], $dataEnvasado[0]);
        }

        $dataExcel = $exportExcelDao->readExcel();
        if (!isset($dataExcel['message']))
            $resp = $exportExcelDao->exportExcel($dataExcel, $arrayBD);
    } else
        $resp = 1;

    if ($resp == 1)
        $resp = array('info' => true, 'message' => 'La consulta no tiene datos');
    else if ($resp > 1)
        $resp = array('success' => true, 'message' => 'El archivo de Excel se ejecutó correctamente');
    else if (isset($dataExcel['message']))
        $resp = array('info' => true, 'message' => $dataExcel['message']);
    else
        $resp = array('error' => true, 'message' => 'Ocurrio un error mientras ejecutaba el archivo de Excel. Intentelo nuevamente');

    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});
