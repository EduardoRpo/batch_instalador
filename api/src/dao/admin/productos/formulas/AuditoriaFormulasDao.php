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

    public function findAllFormulas()
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT fa.id_formulas_audit, fa.action, fa.action_time, fa.action_user, fa.formula_id, fa.old_formula_data, fa.new_formula_data, u.nombre, u.apellido, u.email
                                      FROM formulas_audit fa
                                      INNER JOIN usuario u ON u.id = fa.action_user
                                      ORDER BY fa.action_time ASC");
        $stmt->execute();
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $formulas = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("formulas Obtenidas", array('formulas' => $formulas));
        return $formulas;
    }

    public function AuditFormula($dataFormula, $row, $action)
    {
        $connection = Connection::getInstance()->getConnection();
        session_start();
        $id_user = $_SESSION['idUser'];

        $new_formula_data = 'id_product: ' . $dataFormula['ref_producto'] . ', id_materiaprima: ' . $dataFormula['ref_materiaprima'];

        if ($action == 'INSERT') {
            $sql = "INSERT INTO formulas_audit (`action`, action_time, action_user, formula_id, new_formula_data)
                VALUES (:action, NOW(), :action_user, :formula_id, :new_formula_data)";
            $stmt = $connection->prepare($sql);
            $stmt->execute([
                'action' => $action,
                'formula_id' => $dataFormula['id'],
                'new_formula_data' => $new_formula_data,
                'action_user' => $id_user
            ]);
        } else if ($action == 'UPDATE') {
            $old_formula_data = 'id_product: ' . $row[0]['id_producto'] . ', id_materiaprima: ' . $row[0]['id_materiaprima'];

            $sql = "INSERT INTO formulas_audit (`action`, action_time, action_user, formula_id, old_formula_data, new_formula_data)
                VALUES (:action, NOW(), :action_user, :formula_id, :old_formula_data, :new_formula_data)";
            $stmt = $connection->prepare($sql);
            $stmt->execute([
                'action' => $action,
                'formula_id' => $row[0]['id'],
                'old_formula_data' => 'id_product: ' . $old_formula_data,
                'new_formula_data' => 'id_product: ' . $new_formula_data,
                'action_user' => $id_user
            ]);
        } else if ($action == 'DELETE') {
            $old_formula_data = 'id_product: ' . $row[0]['id_producto'] . ', id_materiaprima: ' . $row[0]['id_materiaprima'];

            $sql = "INSERT INTO formulas_audit (`action`, action_time, action_user, formula_id, old_formula_data)
                VALUES (:action, NOW(), :action_user, :formula_id, :old_formula_data)";
            $stmt = $connection->prepare($sql);
            $stmt->execute([
                'action' => $action,
                'formula_id' => $row[0]['id'],
                'old_formula_data' => 'id_product: ' . $old_formula_data,
                'new_formula_data' => 'id_product: ' . $new_formula_data,
                'action_user' => $id_user
            ]);
        }

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
