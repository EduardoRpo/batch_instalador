<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class FormulasDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function findFormulaByReference($referencia)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT f.id, mp.referencia, mp.alias, cast(AES_DECRYPT(porcentaje, 'Wf[Ht^}2YL=D^DPD') as char)porcentaje 
                                      FROM formula f INNER JOIN materia_prima mp ON f.id_materiaprima = mp.referencia 
                                      WHERE f.id_producto = :referencia");
        $stmt->execute(['referencia' => $referencia]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $formulas = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("formulas Obtenidas", array('formulas' => $formulas));
        return $formulas;
    }

    public function saveFormula($referencia)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("");
        $stmt->execute();
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $formulas = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("formulas Obtenidos", array('formulas' => $formulas));
        return $formulas;
    }

    public function updateFormula($referencia)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("");
        $stmt->execute(['referencia' => $referencia]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $formulas = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("formulas Obtenidos", array('formulas' => $formulas));
        return $formulas;
    }

    public function deleteFormula($referencia)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("");
        $stmt->execute(['referencia' => $referencia]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $formulas = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("formulas Obtenidos", array('formulas' => $formulas));
        return $formulas;
    }
}
