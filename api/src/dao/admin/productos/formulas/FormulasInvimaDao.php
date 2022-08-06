<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class FormulasInvimaDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }
    public function findAllFormulaInvima($referencia){
    $connection = Connection::getInstance()->getConnection();
        if($referencia != 1){
            $stmt = $connection->prepare("SELECT f.id_producto, f.id_materiaprima as referencia, m.alias as alias, m.nombre, 
            cast(AES_DECRYPT(porcentaje, 'Wf[Ht^}2YL=D^DPD') as char)porcentaje 
            FROM formula f INNER JOIN materia_prima m ON f.id_materiaprima=m.referencia 
            WHERE f.id_producto = :referencia");
            $stmt->execute(['referencia' => $referencia]);
        }else
        {
            $stmt = $connection->prepare("SELECT f.id_producto, f.id_materiaprima as referencia, m.alias as alias, m.nombre, cast(AES_DECRYPT(porcentaje, 'Wf[Ht^}2YL=D^DPD') as char)porcentaje 
            FROM formula f INNER JOIN materia_prima m ON f.id_materiaprima=m.referencia");
            $stmt->execute();
        }
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $formulas = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("formulas Obtenidas", array('formulas' => $formulas));
        return $formulas;

    }
    
    public function saveFormula($dataFormula, $notif_sanitaria)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("INSERT INTO formula_f (notif_sanitaria, id_materiaprima, porcentaje) VALUES (:notif_sanitaria, :id_materiaprima, AES_ENCRYPT(:porcentaje,'Wf[Ht^}2YL=D^DPD') )");
        $stmt->execute(['id_materiaprima' => $dataFormula['ref_materiaprima'], 'notif_sanitaria' => $notif_sanitaria['id'], 'porcentaje' => $dataFormula['porcentaje']]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }

    public function updateFormula($dataFormula, $notif_sanitaria)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("UPDATE formula_f SET porcentaje = AES_ENCRYPT(:porcentaje,'Wf[Ht^}2YL=D^DPD') WHERE id_materiaprima = :id_materiaprima AND notif_sanitaria = :notif_sanitaria");
        $stmt->execute(['id_materiaprima' => $dataFormula['ref_materiaprima'], 'notif_sanitaria' => $notif_sanitaria['id'], 'porcentaje' => $dataFormula['porcentaje']]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }

    public function deleteFormula($dataFormula, $notif_sanitaria)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("DELETE FROM formula_f WHERE notif_sanitaria = :notif_sanitaria AND id_materiaprima = :ref_materiaprima");
        $stmt->execute(['notif_sanitaria' => $notif_sanitaria['id'], 'id_materiaprima' => $dataFormula['ref_materiaprima']]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }

    public function SearchIdNotifiSanitaria($dataFormulaInvima)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT id_notificacion_sanitaria as id FROM producto WHERE referencia = :referencia");
        $stmt->execute(['referencia' => $dataFormulaInvima['ref_producto']]);
        $referencia_notifiSanitaria = $stmt->fetch($connection::FETCH_ASSOC);
        return $referencia_notifiSanitaria;
    }

    public function countRowFormulaInvima($dataFormula, $notif_sanitaria)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT * FROM formula_f WHERE id_materiaprima = :id_materiaprima AND notif_sanitaria = :notif_sanitaria");
        $stmt->execute(['id_materiaprima' => $dataFormula['ref_materiaprima'], 'notif_sanitaria' => $notif_sanitaria['id']]);
        $rows = $stmt->rowCount();
        return $rows;
    }

    
}