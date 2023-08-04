<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;
use Dompdf\Dompdf;

class PdfBatchDao extends Dompdf
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function convertPdfBatch($html)
    {
        try {
            // Carga el HTML en Dompdf
            $this->loadHtml($html);

            // Renderiza el PDF
            $this->render();

            // Genera el archivo PDF
            $output = $this->output();

            return $output;
        } catch (\Exception $e) {
            $message = $e->getMessage();

            $error = array('info' => true, 'message' => $message);
            return $error;
        }
    }
}
