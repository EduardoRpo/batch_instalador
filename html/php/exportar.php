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
            $tanques  = $preparacion[0]['numero_tanques'];

            $etiquetas[] = $preparacion[0]['referencia'];
            $etiquetas[] = $preparacion[0]['producto'];
            $etiquetas[] = $preparacion[0]['tanque'];
            $etiquetas[] = $preparacion[0]['capacidad'];
            $etiquetas[] = $preparacion[0]['numero_lote'];
            $etiquetas[] = $preparacion[0]['usuario'];
            $etiquetas[] = $preparacion[0]['numero_orden'];

            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A1', 'Referencia');
            $sheet->setCellValue('B1', 'Producto');
            $sheet->setCellValue('C1', 'Tanque');
            $sheet->setCellValue('D1', 'Capacidad_Tanque');
            $sheet->setCellValue('E1', 'Lote');
            $sheet->setCellValue('F1', 'Usuario');
            $sheet->setCellValue('G1', 'Orden_Produccion');

            for ($i = 2; $i <= $tanques + 1; $i++) {
                $sheet->fromArray($etiquetas, NULL, "A$i");
                $writer = new Xlsx($spreadsheet);
            }

            $fileLabels = 'C:/label';
            if (!file_exists($fileLabels))
                mkdir($fileLabels, 0777, true);

            $writer->save('C:\label\etiquetasPreparacion.xls');
            break;

        case '3': //Impresion aprobacion
            $aprobacion = $_POST['array'];
            $tanques  = $aprobacion[0]['numero_tanques'];

            $etiquetas[] = $aprobacion[0]['orden'];
            $etiquetas[] = $aprobacion[0]['referencia'];
            $etiquetas[] = $aprobacion[0]['producto'];
            $etiquetas[] = $aprobacion[0]['tamanio_lote'];
            $etiquetas[] = $aprobacion[0]['numero_lote'];
            $etiquetas[] = $aprobacion[0]['numero_tanques'];
            $etiquetas[] = $aprobacion[0]['user'];

            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A1', 'Orden_Produccion');
            $sheet->setCellValue('B1', 'Referencia');
            $sheet->setCellValue('C1', 'Nombre Referencia');
            $sheet->setCellValue('D1', 'Tamaño del Lote');
            $sheet->setCellValue('E1', 'Numero Lote');
            $sheet->setCellValue('F1', 'Numero de Tanque');
            $sheet->setCellValue('G1', 'Usuario');


            for ($i = 2; $i <= $tanques + 1; $i++) {
                $sheet->fromArray($etiquetas, NULL, "A$i");
                $writer = new Xlsx($spreadsheet);

                $fileLabels = 'C:/label';
                if (!file_exists($fileLabels))
                    mkdir($fileLabels, 0777, true);

                $writer->save('C:\label\etiquetasAprobacion.xls');
            }
            break;

        case '4': //Impresion acondicionamiento
            $acondicionamiento = $_POST['array'];
            $acondicionamiento = $acondicionamiento[0];
            $etiquetas[] = $acondicionamiento['referencia'];
            $etiquetas[] = $acondicionamiento['nombre_referencia'];
            $etiquetas[] = $acondicionamiento['presentacion'];
            $etiquetas[] = $acondicionamiento['unidad_empaque'];
            $etiquetas[] = $acondicionamiento['propietario'];
            $etiquetas[] = $acondicionamiento['user'];
            $etiquetas[] = $acondicionamiento['numero_lote'];
            $etiquetas[] = $acondicionamiento['numero_orden'];

            if ($acondicionamiento['unidad_empaque'])
                $cajas = ceil($acondicionamiento['cantidad'] / $acondicionamiento['unidad_empaque']);
            else
                $cajas = 1;

            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A1', 'Referencia');
            $sheet->setCellValue('B1', 'Producto');
            $sheet->setCellValue('C1', 'Presentacion');
            $sheet->setCellValue('D1', 'Und x Caja');
            $sheet->setCellValue('E1', 'Propietario');
            $sheet->setCellValue('F1', 'Usuario');
            $sheet->setCellValue('G1', 'Lote');
            $sheet->setCellValue('H1', 'Orden_Produccion');

            for ($i = 2; $i <= $cajas + 1; $i++) {
                $sheet->fromArray($etiquetas, NULL, "A$i");
                $writer = new Xlsx($spreadsheet);

                $fileLabels = 'C:/label';
                if (!file_exists($fileLabels))
                    mkdir($fileLabels, 0777, true);

                $writer->save('C:\label\etiquetasAcondicionamiento.xls');
            }
            break;

        case '5': //Impresion Etiquetas Retencion
            $retencion = $_POST['array'];

            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A1', 'Referencia');
            $sheet->setCellValue('B1', 'Producto');
            $sheet->setCellValue('C1', 'Presentacion');
            $sheet->setCellValue('D1', 'Lote');
            $sheet->setCellValue('E1', 'Orden_Produccion');
            $sheet->setCellValue('F1', 'consecutivo');
            $sheet->setCellValue('G1', 'codigo');
            $sheet->fromArray($retencion, NULL, "A2");
            $writer = new Xlsx($spreadsheet);

            $fileLabels = 'C:/label';
            if (!file_exists($fileLabels))
                mkdir($fileLabels, 0777, true);

            $writer->save('C:\label\etiquetasRetencion.xls');

            break;
    }
}
