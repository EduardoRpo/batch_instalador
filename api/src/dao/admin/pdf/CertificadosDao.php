<?php


namespace BatchRecord\dao;


use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class CertificadosDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function findAllCert($type)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT * FROM pdf_version WHERE type = :type");
        $stmt->execute(['type' => $type]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $versionPDF = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("version Actual", array('version' => $versionPDF));
        return $versionPDF;
    }

    public function findCertById($val)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT b.id_batch, p.referencia, p.nombre_referencia, b.numero_lote, b.estado, b.fecha_creacion FROM batch b 
                                      INNER JOIN producto p ON b.id_producto = p.referencia
                                      WHERE numero_lote = :lote;");
        $stmt->execute(['lote' => $val]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $dataCert = $stmt->fetchAll($connection::FETCH_ASSOC);

        if (sizeof($dataCert) == 0) {
            $stmt = "SELECT b.id_batch, p.referencia, p.nombre_referencia, b.numero_lote, b.estado, b.fecha_creacion 
                    FROM batch b 
                    INNER JOIN producto p ON b.id_producto = p.referencia
                    WHERE id_batch = :batch";
            $stmt = $connection->prepare($stmt);
            $stmt->execute(['batch' => $val]);
            $dataCert = $stmt->fetchAll($connection::FETCH_ASSOC);
        }

        $this->logger->notice("version Actual", array('version' => $dataCert));
        return $dataCert;
    }
}
