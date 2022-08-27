<?php

require_once dirname(dirname(dirname(dirname(dirname(__DIR__))))) . "/vendor/autoload.php";

use BatchRecord\dao\ExportBatchDao;
use BatchRecord\dao\ProductDao;
use BatchRecord\dao\EquipoDao;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$batchDao = new ExportBatchDao();
$equiposDao = new EquipoDao();
$productDao = new ProductDao();
$documento = new Spreadsheet();

include_once 'batch.php';
include_once 'desinfectant.php';
include_once 'conditions.php';
include_once 'specificationProduct.php';
include_once 'specificationControl.php';
include_once 'equipment.php';
include_once 'multi.php';
include_once 'envase.php';
include_once 'envaseSobrante.php';
include_once 'muestrasEnvasado.php';
include_once 'muestrasAcondicionamiento.php';

$app->get('/exportDataBatch/{idBatch}/{ref}', function (Request $request, Response $response, $args) use ($batchDao, $equiposDao, $productDao, $documento) {

    $documento
        ->getProperties()
        ->setCreator("Teenus SAS")
        ->setLastModifiedBy('Samara Cosmetics')
        ->setTitle('Archivo exportado')
        ->setDescription('Data Batch');

    # Obtenemos la hoja por defecto
    $hojaDatosBatch = $documento->getActiveSheet();
    $hojaDatosBatch->setTitle("Batch");

    $hojaDatosBatch = batch($hojaDatosBatch, $batchDao, $args['idBatch']);
    $hojaDatosBatch = desifectant($documento, $batchDao, $args['idBatch']);
    $hojaDatosBatch = conditions($documento, $batchDao, $args['idBatch']);
    $hojaDatosBatch = specificationProduct($documento, $productDao, $args['ref']);
    $hojaDatosBatch = specificationControl($documento, $batchDao, $args['idBatch']);
    $hojaDatosBatch = equipment($documento, $equiposDao, $args['idBatch']);
    $hojaDatosBatch = multi($documento, $batchDao, $args['idBatch']);
    $hojaDatosBatch = envase($documento, $batchDao, $args['ref']);
    $hojaDatosBatch = muestrasEnvasado($documento, $batchDao, $args['idBatch']);
    $hojaDatosBatch = envaseSobrante($documento, $batchDao, $args['idBatch']);
    $hojaDatosBatch = muestrasAcondicionamiento($documento, $batchDao, $args['idBatch']);

    # Crear documento
    $writer = new Xlsx($documento);

    $fileLabels = 'C:/label';
    if (!file_exists($fileLabels))
        mkdir($fileLabels, 0777, true);

    # Le pasamos la ruta de guardado
    $writer->save('C:\label\dataBatch.xlsx');
});
