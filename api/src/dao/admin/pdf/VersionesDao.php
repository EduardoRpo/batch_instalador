<?php


namespace BatchRecord\dao;


use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class VersionesDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function findAllVersionsByType($type)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT * FROM pdf_version WHERE type = :type");
        $stmt->execute(['type' => $type]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $versionPDF = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("version Actual", array('version' => $versionPDF));
        return $versionPDF;
    }

    public function findCurrentlyVersionByType($fechaCreacionBatch, $type)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT * FROM `pdf_version` 
                                      WHERE fecha <= :fechaCreacionBatch AND type = :type 
                                      ORDER BY fecha DESC LIMIT 1;");
        $stmt->execute(['fechaCreacionBatch'=> $fechaCreacionBatch, 'type' => $type]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $versionPDF = $stmt->fetch($connection::FETCH_ASSOC);
        $this->logger->notice("version Actual", array('version' => $versionPDF));
        return $versionPDF;
    }

    public function saveVersionByType($dataVersionPDF)
    {
        $connection = Connection::getInstance()->getConnection();
        try {

            $stmt = $connection->prepare("INSERT INTO pdf_version (codigo, version, fecha, type) 
                                          VALUES(:codigo, :version, :fecha, :type)");
            $stmt->execute([
                'codigo' => $dataVersionPDF['codigo'],
                'version' => $dataVersionPDF['version'],
                'fecha' => $dataVersionPDF['fecha'],
                'type' => $dataVersionPDF['type']
            ]);
            $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        } catch (\Exception $e) {

            $message = $e->getMessage();

            if ($e->getCode() == 23000)
                $message = 'Código duplicado. Ingrese uno nuevo';

            $error = array('info' => true, 'message' => $message);
            return $error;
        }
    }

    public function updateVersionByType($dataVersionPDF)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("UPDATE pdf_version 
                                      SET version = :version, fecha = :fecha
                                      WHERE id_pdf_version = :id_pdf_version");
        $stmt->execute([
            'version' => $dataVersionPDF['version'],
            'fecha' => $dataVersionPDF['fecha'],
            'id_pdf_version' => $dataVersionPDF['id_pdf_version'],
        ]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }

    public function deleteVersionByType($idVersionPDF)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("DELETE FROM pdf_version WHERE id_pdf_version = :id_pdf_version");
        $stmt->execute(['id_pdf_version' => $idVersionPDF]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }
}
