<?php
require __DIR__ . "/vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spread = new Spreadsheet();
$spread
    ->getProperties()
    ->setCreator("Nombre del autor")
    ->setLastModifiedBy('Juan Perez')
    ->setTitle('Excel creado con PhpSpreadSheet')
    ->setSubject('Excel de prueba')
    ->setDescription('Excel generado como prueba')
    ->setKeywords('PHPSpreadsheet')
    ->setCategory('Categoría de prueba');

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Reporte Excel"');
header('Cache-Control: max-age=0');

$writer = IOFactory::createWriter($spread, 'Xlsx');
$writer->save('php://output');
exit;
