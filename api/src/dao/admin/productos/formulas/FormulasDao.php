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

    public function findAllFormulas()
    {
        $connection = Connection::getInstance()->getConnection();

        $stmt = $connection->prepare("SELECT f.id_producto, mp.referencia, mp.nombre, mp.alias, cast(AES_DECRYPT(porcentaje, 'Wf[Ht^}2YL=D^DPD') as char)porcentaje 
                                      FROM formula f INNER JOIN materia_prima mp ON f.id_materiaprima = mp.referencia 
                                      WHERE f.id_producto LIKE 'Granel-%';");
        $stmt->execute();
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $formulas = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("formulas Obtenidas", array('formulas' => $formulas));
        return $formulas;
    }

    public function findFormulaByReference($referencia)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT f.id, mp.referencia, mp.nombre, mp.alias, cast(AES_DECRYPT(porcentaje, 'Wf[Ht^}2YL=D^DPD') as char)porcentaje 
                                      FROM formula f INNER JOIN materia_prima mp ON f.id_materiaprima = mp.referencia 
                                      WHERE f.id_producto = :referencia");
        $stmt->execute(['referencia' => $referencia]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $formulas = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("formulas Obtenidas", array('formulas' => $formulas));
        return $formulas;
    }

    public function findFormulaByRefMaterial($dataFormula, $tbl)
    {
        $connection = Connection::getInstance()->getConnection();

        if ($tbl == 'formula') {
            $stmt = $connection->prepare("SELECT * FROM formula
                                      WHERE id_materiaprima = :id_materiaprima AND id_producto = :id_producto");
            $stmt->execute(['id_materiaprima' => $dataFormula['ref_materiaprima'], 'id_producto' => $dataFormula['ref_producto']]);
        } else {
            $stmt = $connection->prepare("SELECT * FROM formula_f 
                                      WHERE id_materiaprima = :id_materiaprima AND notif_sanitaria = :notif_sanitaria");
            $stmt->execute([
                'id_materiaprima' => $dataFormula['ref_materiaprima'],
                'notif_sanitaria' => $dataFormula['notif_sanitaria']
            ]);
        }
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $formulas = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("formulas Obtenidas", array('formulas' => $formulas));
        return $formulas;
    }

    public function findLastInsertedFormula()
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT MAX(id) AS id FROM formula");
        $stmt->execute();
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $formula = $stmt->fetch($connection::FETCH_ASSOC);
        $this->logger->notice("formula Obtenidas", array('formula' => $formula));
        return $formula;
    }

    public function saveFormula($dataFormula)
    {
        $connection = Connection::getInstance()->getConnection();

        $datos = $dataFormula['array'];

        foreach ($datos as $dato) {
            $sql = "INSERT INTO formula (id_producto, id_materiaprima, porcentaje) 
                VALUES (:id_producto, :id_materiaprima, AES_ENCRYPT(:porcentaje,'Wf[Ht^}2YL=D^DPD') )";
            $stmt = $connection->prepare($sql);
            $stmt->execute([
                'id_materiaprima' => $dato['0'],
                'id_producto' => $dataFormula['ref_producto'],
                'porcentaje' => $dato['2']
            ]);
            $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        }
    }

    public function updateFormula($dataFormula)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("UPDATE formula SET porcentaje = AES_ENCRYPT(:porcentaje,'Wf[Ht^}2YL=D^DPD') WHERE id_materiaprima = :id_materiaprima AND id_producto = :id_producto");
        $stmt->execute(['id_materiaprima' => $dataFormula['ref_materiaprima'], 'id_producto' => $dataFormula['ref_producto'], 'porcentaje' => $dataFormula['porcentaje']]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }

    public function deleteFormula($dataFormula)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("DELETE FROM formula WHERE id_producto = :ref_producto AND id_materiaprima = :ref_materiaprima");
        $stmt->execute(['ref_producto' => $dataFormula['ref_producto'], 'ref_materiaprima' => $dataFormula['ref_materiaprima']]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    }

    /*  public function countRowFormula($dataFormula)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT * FROM formula WHERE id_materiaprima = :id_materiaprima AND id_producto = :id_producto");
        $stmt->execute(['id_materiaprima' => $dataFormula['ref_materiaprima'], 'id_producto' => $dataFormula['ref_producto']]);
        $rows = $stmt->rowCount();
        return $rows;
    } */

    /*  public function FindMultiByFormula($referencia)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT multi FROM producto WHERE referencia = :referencia");
        $stmt->execute(['referencia' => $referencia]);
        $multi = $stmt->fetch($connection::FETCH_ASSOC);
        if ($multi['multi'] != 0) {
            $stmt = $connection->prepare("SELECT referencia FROM producto WHERE multi = :multi");
            $stmt->execute(['multi' => $multi['multi']]);
            $ref_multi = $stmt->fetchAll($connection::FETCH_ASSOC);
            return $ref_multi;
        }
    } */
}
