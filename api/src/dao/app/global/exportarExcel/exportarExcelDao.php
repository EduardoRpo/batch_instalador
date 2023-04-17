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
        $inputFileType = 'Xlsx';
        $inputFileName = '/assets/gestionEnvase.xlsx';

        /**  Create a new Reader of the type defined in $inputFileType  **/
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);

        /**  Advise the Reader that we only want to load cell data  **/
        $reader->setReadDataOnly(TRUE);
        $spreadsheet = $reader->load($inputFileName);
        echo $spreadsheet;
    }

    public function exportExcel($data)
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
        for ($i = 0; $i < sizeof($data); $i++) {
            $sheet->setCellValue('A' . $fila, $data[$i]['programacion_envasado']);
            $sheet->setCellValue('B' . $fila, $data[$i]['id_batch']);
            $sheet->setCellValue('C' . $fila, $data[$i]['referencia_comercial']);
            $sheet->setCellValue('D' . $fila, $data[$i]['id_envase']);
            $sheet->setCellValue('E' . $fila, $data[$i]['cantidad']);
            $sheet->setCellValue('F' . $fila, $data[$i]['id_tapa']);
            $sheet->setCellValue('G' . $fila, $data[$i]['cantidad']);
            $sheet->setCellValue('H' . $fila, $data[$i]['id_etiqueta']);
            $sheet->setCellValue('I' . $fila, $data[$i]['cantidad']);
            $sheet->setCellValue('J' . $fila, $data[$i]['id_otros']);
            $sheet->setCellValue('K' . $fila, $data[$i]['cantidad']);
            $fila++;
        }

        $writer = new Xlsx($spreadsheet);

        $fileLabels = 'C:/label';
        if (!file_exists($fileLabels))
            mkdir($fileLabels, 0777, true);

        $writer->save('C:\label\gestionEnvase.xlsx');
        return $fila;
    }
}
