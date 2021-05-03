<?php
require_once("../../vendor/autoload.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (!empty($_POST)) {

    $etiquetas = $_POST['array'];
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setCellValue('A1', 'Orden');
    $sheet->setCellValue('B1', 'Referencia');
    $sheet->setCellValue('C1', 'Peso');
    $sheet->setCellValue('D1', 'Producto');
    $sheet->fromArray($etiquetas, NULL, 'A2');
    $writer = new Xlsx($spreadsheet);

    $fileLabels = 'C:/Label';
    echo substr(sprintf('%o', fileperms('/Label')), -4);
    if (!file_exists($fileLabels)) {
        mkdir($fileLabels, 0777, true);
        echo 'file created';
    } else
        echo 'file has not been created';

    $writer->save('C:\label\etiquetasDispensacion.xlsx');
}
