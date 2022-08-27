<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class LineClearanceDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function findAllLinesC()
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT mp.id, p.pregunta, mp.resp, m.modulo FROM modulo_pregunta mp INNER JOIN preguntas p INNER JOIN modulo m ON mp.id_pregunta=p.id AND mp.id_modulo=m.id");
        $stmt->execute();
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $LinesC = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("get lines", array('lines' => $LinesC));
        return $LinesC;
    }



    public function saveLinesC($dataLinesC)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("INSERT INTO modulo_pregunta (id_pregunta, resp, id_modulo) VALUES(:pregunta, :respuesta, :modulo)");
        $stmt->execute(['pregunta' => $dataLinesC['pregunta'], 'respuesta' => $dataLinesC['respuesta'], 'modulo' => $dataLinesC['modulo']]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }
    public function updateLinesC($dataLinesC)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("UPDATE modulo_pregunta SET resp = :respuesta, id_modulo = :modulo WHERE id_pregunta = :id_pregunta");
        $stmt->execute(['id_pregunta' => $dataLinesC['id_pregunta'], 'respuesta' => $dataLinesC['respuesta'], 'modulo' => $dataLinesC['modulo']]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }

    public function deleteLinesC($id)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("DELETE FROM modulo_pregunta WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }
}
