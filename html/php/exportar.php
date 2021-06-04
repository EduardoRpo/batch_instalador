<?php
require_once("../../vendor/autoload.php");

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (!empty($_POST)) {
    $op = $_POST['operacion'];
    switch ($op) {
        case '1': //Impresion pesaje
            $etiquetas = $_POST['array'];
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A1', 'Orden');
            $sheet->setCellValue('B1', 'Referencia');
            $sheet->setCellValue('C1', 'Peso');
            $sheet->setCellValue('D1', 'Producto');
            $sheet->setCellValue('E1', 'Usuario');
            $sheet->fromArray($etiquetas, NULL, 'A2');
            $writer = new Xlsx($spreadsheet);

            $fileLabels = 'C:/label';
            if (!file_exists($fileLabels))
                mkdir($fileLabels, 0777, true);

            $writer->save('C:\label\etiquetasDispensacion.xls');
            break;

        case '2': //Impresion preparacion
            $preparacion = $_POST['array'];

            $etiquetas[] = $preparacion['referencia'];
            $etiquetas[] = $preparacion['nombre_referencia'];
            $etiquetas[] = $preparacion['tanque'];
            $etiquetas[] = $preparacion['tamano_lote'];
            $etiquetas[] = $preparacion['numero_lote'];
            $etiquetas[] = $preparacion['usuario'];
            $etiquetas[] = $preparacion['numero_orden'];

            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A1', 'Referencia');
            $sheet->setCellValue('B1', 'Producto');
            $sheet->setCellValue('C1', 'Tanque');
            $sheet->setCellValue('D1', 'Capacidad_Tanque');
            $sheet->setCellValue('E1', 'Lote');
            $sheet->setCellValue('F1', 'Usuario');
            $sheet->setCellValue('G1', 'Orden_Produccion');
            $sheet->fromArray($etiquetas, NULL, 'A2');
            $writer = new Xlsx($spreadsheet);

            $fileLabels = 'C:/label';
            if (!file_exists($fileLabels))
                mkdir($fileLabels, 0777, true);

            $writer->save('C:\label\etiquetasPreparacion.xls');
            break;
    }
}
