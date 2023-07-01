<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class AuditoriaFormulasDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function AuditFormula($dataFormula, $action)
    {
        $connection = Connection::getInstance()->getConnection();
        $sql = "INSERT INTO formulas_audit (`action`, action_time, action_user, formula_id, old_formula_data, new_formula_data)
                VALUES (:action, NOW(), USER(), :id_product, :id_materiaprima)";
        $stmt = $connection->prepare($sql);
        $stmt->execute([
            'action' => $action,
            'id_product' => $dataFormula['id_producto'],
            'id_materiaprima' => $dataFormula['id_materiaprima'],
        ]);

        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }

    public function deleteAuditFormula($dataFormula, $notif_sanitaria)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("DELETE FROM formula_f WHERE notif_sanitaria = :notif_sanitaria AND id_materiaprima = :ref_materiaprima");
        $stmt->execute(['notif_sanitaria' => $notif_sanitaria['id'], 'id_materiaprima' => $dataFormula['ref_materiaprima']]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }



    /* public function countRowFormulaInvima($ref_materia, $notif_sanitaria)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT * FROM formula_f WHERE id_materiaprima = :id_materiaprima AND notif_sanitaria = :notif_sanitaria");
        $stmt->execute(['id_materiaprima' => $ref_materia, 'notif_sanitaria' => $notif_sanitaria['id']]);
        $rows = $stmt->rowCount();
        return $rows;
    } */
}
