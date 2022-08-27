<?php


namespace BatchRecord\dao;


use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class DataSelectorDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function findData($tbl)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT * FROM $tbl");
        $stmt->execute();
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $selectorData = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("Data Selector", array('selector' => $selectorData));
        return $selectorData;
    }
    
    /* public function findSelectorModules($tbl)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT * FROM $tbl");
        $stmt->execute();
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $selectorData = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("Data Selector", array('selector' => $selectorData));
        return $selectorData;
    } */
    
   /*  public function findSelectorPositions($tbl)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT * FROM $tbl");
        $stmt->execute();
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $selectorData = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("Data Selector", array('selector' => $selectorData));
        return $selectorData;
    } */
}
