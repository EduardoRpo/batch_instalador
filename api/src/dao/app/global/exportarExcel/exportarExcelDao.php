<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class exportarExcelDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function readExcel()
    {
        $fileLabels = 'C:/label';
        if (!file_exists($fileLabels)) {
            mkdir($fileLabels, 0777, true);
        }

        $inputFileName = "C:/label/gestionEnvase.xlsx";

        if (!file_exists($inputFileName)) {
            // Si no existe, puedes crear un archivo vacío aquí si es necesario
            // file_put_contents($inputFileName, '');

            // O lanzar un error, dependiendo de tus requisitos
            // die("El archivo 'gestionEnvase.xlsx' no existe.");
            return array('message' => 'El archivo gestionEnvase.xlsx no existe.');
        }

        /* Lee el archivo y extrae datos */
        $inputFileName = "C:\\label\gestionEnvase.xlsx";
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($inputFileName);
        $reader->setReadDataOnly(TRUE);
        $spreadsheet = $reader->load($inputFileName);
        $spreadsheet = $spreadsheet->getActiveSheet();
        $data_array =  $spreadsheet->toArray();

        /* Elimina el primer array */
        unset($data_array[0]);

        $j = 0;
        for ($i = 1; $i <= sizeof($data_array); $i++) {
            $newArray[$j]['programacion_envasado'] = $data_array[$i][0];
            $newArray[$j]['pedido'] = $data_array[$i][1];
            $newArray[$j]['id_batch'] = $data_array[$i][2];
            $newArray[$j]['referencia_comercial'] = $data_array[$i][3];
            $newArray[$j]['id_envase'] = $data_array[$i][4];
            $newArray[$j]['cantidad'] = $data_array[$i][5];
            $newArray[$j]['id_tapa'] = $data_array[$i][6];
            $newArray[$j]['cantidad'] = $data_array[$i][7];
            $newArray[$j]['id_etiqueta'] = $data_array[$i][8];
            $newArray[$j]['cantidad'] = $data_array[$i][9];
            $newArray[$j]['id_empaque'] = $data_array[$i][10];
            $newArray[$j]['cantidad'] = $data_array[$i][11];
            $newArray[$j]['id_otros'] = $data_array[$i][12];
            $newArray[$j]['cantidad'] = $data_array[$i][13];
            $j++;
        }

        return $newArray;
    }

    public function exportExcel($dataExcel, $arrayBD)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Fecha');
        $sheet->setCellValue('B1', 'Pedido');
        $sheet->setCellValue('C1', 'Batch');
        $sheet->setCellValue('D1', 'Referencia Comercial');
        $sheet->setCellValue('E1', 'Envase');
        $sheet->setCellValue('F1', 'Cantidad');
        $sheet->setCellValue('G1', 'Tapa');
        $sheet->setCellValue('H1', 'Cantidad');
        $sheet->setCellValue('I1', 'Etiqueta');
        $sheet->setCellValue('J1', 'Cantidad');
        $sheet->setCellValue('K1', 'Empaque');
        $sheet->setCellValue('L1', 'Cantidad');
        $sheet->setCellValue('M1', 'Otros');
        $sheet->setCellValue('N1', 'Cantidad');

        $fila = 2;
        if ($dataExcel)
            for ($i = 0; $i < sizeof($dataExcel); $i++) {
                $sheet->setCellValue('A' . $fila, $dataExcel[$i]['programacion_envasado']);
                $sheet->setCellValue('B' . $fila, $dataExcel[$i]['pedido']);
                $sheet->setCellValue('C' . $fila, $dataExcel[$i]['id_batch']);
                $sheet->setCellValue('D' . $fila, $dataExcel[$i]['referencia_comercial']);
                $sheet->setCellValue('E' . $fila, $dataExcel[$i]['id_envase']);
                $sheet->setCellValue('F' . $fila, $dataExcel[$i]['cantidad']);
                $sheet->setCellValue('G' . $fila, $dataExcel[$i]['id_tapa']);
                $sheet->setCellValue('H' . $fila, $dataExcel[$i]['cantidad']);
                $sheet->setCellValue('I' . $fila, $dataExcel[$i]['id_etiqueta']);
                $sheet->setCellValue('J' . $fila, $dataExcel[$i]['cantidad']);
                $sheet->setCellValue('K' . $fila, $dataExcel[$i]['id_empaque']);
                $sheet->setCellValue('L' . $fila, $dataExcel[$i]['cantidad']);
                $sheet->setCellValue('M' . $fila, $dataExcel[$i]['id_otros']);
                $sheet->setCellValue('N' . $fila, $dataExcel[$i]['cantidad']);
                $fila++;
            }

        for ($i = 0; $i < sizeof($arrayBD); $i++) {
            $sheet->setCellValue('A' . $fila, $arrayBD[$i]['programacion_envasado']);
            $sheet->setCellValue('B' . $fila, $arrayBD[$i]['pedido']);
            $sheet->setCellValue('C' . $fila, $arrayBD[$i]['id_batch']);
            $sheet->setCellValue('D' . $fila, $arrayBD[$i]['referencia_comercial']);
            $sheet->setCellValue('E' . $fila, $arrayBD[$i]['id_envase']);
            $sheet->setCellValue('F' . $fila, $arrayBD[$i]['cantidad']);
            $sheet->setCellValue('G' . $fila, $arrayBD[$i]['id_tapa']);
            $sheet->setCellValue('H' . $fila, $arrayBD[$i]['cantidad']);
            $sheet->setCellValue('I' . $fila, $arrayBD[$i]['id_etiqueta']);
            $sheet->setCellValue('J' . $fila, $arrayBD[$i]['cantidad']);
            $sheet->setCellValue('K' . $fila, $arrayBD[$i]['id_empaque']);
            $sheet->setCellValue('L' . $fila, $arrayBD[$i]['cantidad']);
            $sheet->setCellValue('M' . $fila, $arrayBD[$i]['id_otros']);
            $sheet->setCellValue('N' . $fila, $arrayBD[$i]['cantidad']);
            $fila++;
        }

        $writer = new Xlsx($spreadsheet);
        $writer->save('C:\label\gestionEnvase.xlsx');
        return $fila;
    }
}
