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
        if (!file_exists($fileLabels))
            mkdir($fileLabels, 0777, true);

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
            $newArray[$j]['id_batch'] = $data_array[$i][1];
            $newArray[$j]['referencia_comercial'] = $data_array[$i][2];
            $newArray[$j]['id_envase'] = $data_array[$i][3];
            $newArray[$j]['cantidad'] = $data_array[$i][4];
            $newArray[$j]['id_tapa'] = $data_array[$i][5];
            $newArray[$j]['cantidad'] = $data_array[$i][6];
            $newArray[$j]['id_etiqueta'] = $data_array[$i][7];
            $newArray[$j]['cantidad'] = $data_array[$i][8];
            $newArray[$j]['id_otros'] = $data_array[$i][9];
            $newArray[$j]['cantidad'] = $data_array[$i][10];
            $j++;
        }

        return $newArray;
    }

    public function exportExcel($dataExcel, $arrayBD)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Fecha');
        $sheet->setCellValue('B1', 'Batch');
        $sheet->setCellValue('C1', 'Referencia Comercial');
        $sheet->setCellValue('D1', 'Envase');
        $sheet->setCellValue('E1', 'Cantidad');
        $sheet->setCellValue('F1', 'Tapa');
        $sheet->setCellValue('G1', 'Cantidad');
        $sheet->setCellValue('H1', 'Etiqueta');
        $sheet->setCellValue('I1', 'Cantidad');
        $sheet->setCellValue('J1', 'Otros');
        $sheet->setCellValue('K1', 'Cantidad');

        $fila = 2;

        for ($i = 0; $i < sizeof($dataExcel); $i++) {
            $sheet->setCellValue('A' . $fila, $dataExcel[$i]['programacion_envasado']);
            $sheet->setCellValue('B' . $fila, $dataExcel[$i]['id_batch']);
            $sheet->setCellValue('C' . $fila, $dataExcel[$i]['referencia_comercial']);
            $sheet->setCellValue('D' . $fila, $dataExcel[$i]['id_envase']);
            $sheet->setCellValue('E' . $fila, $dataExcel[$i]['cantidad']);
            $sheet->setCellValue('F' . $fila, $dataExcel[$i]['id_tapa']);
            $sheet->setCellValue('G' . $fila, $dataExcel[$i]['cantidad']);
            $sheet->setCellValue('H' . $fila, $dataExcel[$i]['id_etiqueta']);
            $sheet->setCellValue('I' . $fila, $dataExcel[$i]['cantidad']);
            $sheet->setCellValue('J' . $fila, $dataExcel[$i]['id_otros']);
            $sheet->setCellValue('K' . $fila, $dataExcel[$i]['cantidad']);
            $fila++;
        }

        for ($i = 0; $i < sizeof($arrayBD); $i++) {
            $sheet->setCellValue('A' . $fila, $arrayBD[$i]['programacion_envasado']);
            $sheet->setCellValue('B' . $fila, $arrayBD[$i]['id_batch']);
            $sheet->setCellValue('C' . $fila, $arrayBD[$i]['referencia_comercial']);
            $sheet->setCellValue('D' . $fila, $arrayBD[$i]['id_envase']);
            $sheet->setCellValue('E' . $fila, $arrayBD[$i]['cantidad']);
            $sheet->setCellValue('F' . $fila, $arrayBD[$i]['id_tapa']);
            $sheet->setCellValue('G' . $fila, $arrayBD[$i]['cantidad']);
            $sheet->setCellValue('H' . $fila, $arrayBD[$i]['id_etiqueta']);
            $sheet->setCellValue('I' . $fila, $arrayBD[$i]['cantidad']);
            $sheet->setCellValue('J' . $fila, $arrayBD[$i]['id_otros']);
            $sheet->setCellValue('K' . $fila, $arrayBD[$i]['cantidad']);
            $fila++;
        }

        $writer = new Xlsx($spreadsheet);
        $writer->save('C:\label\gestionEnvase.xlsx');
        return $fila;
    }
}
