<?php
require_once("../../vendor/autoload.php");

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (!empty($_POST)) {
    $etiquetas = $_POST['array'];
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setCellValue('A1', 'Orden');
    $sheet->setCellValue('B1', 'Referencia');
    $sheet->setCellValue('C1', 'Peso');
    $sheet->fromArray($etiquetas, NULL, 'A2');
    $writer = new Xlsx($spreadsheet);
    $writer->save('C:\desarrollo\batchRecord\htdocs\html\etiquetas\etiquetasDispensacion.xlsx');
}
