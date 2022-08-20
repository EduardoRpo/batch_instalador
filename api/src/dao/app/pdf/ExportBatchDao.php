<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * Class BatchData
 * @package BatchRecord\dao
 * @author Teenus <Teenus-SAS>
 */

class ExportBatchDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function findByIdBatch($idBatch)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT p.referencia, UPPER(p.nombre_referencia) AS nombre_referencia, m.nombre as marca, pp.nombre as propietario, 
                                            pc.nombre as presentacion, linea.nombre as linea, ns.nombre as notificacion, b.numero_orden, b.numero_lote, b.fecha_creacion, b.tamano_lote, 
                                            b.unidad_lote, b.lote_presentacion, linea.densidad, b.estado 
                                    FROM batch b 
                                    INNER JOIN producto p ON p.referencia= b.id_producto 
                                    INNER JOIN presentacion_comercial pc ON p.presentacion_comercial = pc.id 
                                    INNER JOIN marca m ON m.id = p.id_marca 
                                    INNER JOIN propietario pp ON pp.id = p.id_propietario 
                                    INNER JOIN notificacion_sanitaria ns ON ns.id = p.id_notificacion_sanitaria 
                                    INNER JOIN linea ON linea.id = p.id_linea WHERE id_batch = :id");
        $stmt->execute(['id' => $idBatch]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $batch = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("batch Obtenidos", array('batch' => $batch));
        return $batch;
    }

    public function findDesinfectByIdBatch($idBatch)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT d.nombre as desinfectante, d.concentracion, bds.modulo, bds.realizo, u.urlfirma as realizo, CONCAt(u.nombre, ' ', u.apellido) as nombre_realizo, us.urlfirma as verifico, CONCAt(us.nombre, ' ' ,us.apellido) as nombre_verifico, bds.verifico as firma, bds.fecha_registro, bds.fecha_nuevo_registro 
                                        FROM desinfectante d INNER JOIN batch_desinfectante_seleccionado bds ON bds.desinfectante = d.id 
                                        INNER JOIN	usuario u ON u.id = bds.realizo
                                        INNER JOIN	usuario us ON us.id = bds.verifico
                                        WHERE bds.batch = :batch 

                                        UNION

                                        SELECT d.nombre as desinfectante, d.concentracion, bds.modulo, bds.realizo, u.urlfirma as realizo, CONCAt(u.nombre, ' ', u.apellido) as nombre_realizo, bds.verifico, bds.verifico as nombre_verifico, bds.verifico as firma, bds.fecha_registro, bds.fecha_nuevo_registro 
                                        FROM desinfectante d INNER JOIN batch_desinfectante_seleccionado bds ON bds.desinfectante = d.id 
                                        INNER JOIN	usuario u ON u.id = bds.realizo
                                        WHERE bds.batch = :batch1 AND verifico = 0
                                        ORDER BY modulo");
        $stmt->execute(['batch' => $idBatch, 'batch1' => $idBatch]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $desinfect = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("desinfect Obtenidos", array('desinfect' => $desinfect));
        return $desinfect;
    }

    public function findTemperatureByIdBatch($idBatch)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT fecha, temperatura, humedad, id_modulo as modulo 
                                      FROM batch_condicionesmedio WHERE id_batch = :batch");
        $stmt->execute(['batch' => $idBatch]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $temperature = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("temperature Obtenidos", array('temperature' => $temperature));
        return $temperature;
    }

    public function findSpecificationsControl($idBatch)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT * FROM batch_control_especificaciones 
                                      WHERE batch = :batch");
        $stmt->execute(['batch' => $idBatch]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $specificationsControl = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("specificationsControl Obtenidos", array('specificationsControl' => $specificationsControl));
        return $specificationsControl;
    }

    public function findMulti($idBatch)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT m.id_batch, m.referencia, pc.nombre as presentacion_comercial, m.cantidad, m.total 
                                      FROM multipresentacion m 
                                      INNER JOIN producto p ON p.referencia = m.referencia 
                                      INNER JOIN presentacion_comercial pc ON pc.id = p.presentacion_comercial 
                                      WHERE id_batch = :batch ORDER BY `m`.`referencia` ASC");
        $stmt->execute(['batch' => $idBatch]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $multi = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("multi Obtenidos", array('multi' => $multi));
        return $multi;
    }


    public function findEnvase($reference)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT env.id as id_envase, env.nombre as envase, tap.id as id_tapa, tap.nombre as tapa, eti.id as id_etiqueta, 
                                            eti.nombre as etiqueta, emp.id as id_empaque, emp.nombre as empaque, otr.id as id_otros, 
                                            otr.nombre as otros, p.unidad_empaque FROM producto p LEFT JOIN envase env ON p.id_envase = env.id 
                                    LEFT JOIN tapa tap ON p.id_tapa = tap.id 
                                    LEFT JOIN etiqueta eti ON p.id_etiqueta = eti.id 
                                    LEFT JOIN empaque emp ON p.id_empaque = emp.id 
                                    LEFT JOIN otros otr ON p.id_otros = otr.id 
                                    WHERE p.referencia = :referencia");
        $stmt->execute(['referencia' => $reference]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $envases = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("envases Obtenidos", array('envases' => $envases));
        return $envases;
    }

    public function findEnvaseSobrante($batch)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT bms.id, bms.ref_material, ev.nombre as envase, et.nombre as tapa, t.nombre as etiqueta,  bms.envasada, bms.averias, bms.sobrante, bms.ref_producto, bms.batch, bms.modulo, u.urlfirma as realizo 
                                      FROM batch_material_sobrante bms
                                      LEFT JOIN envase ev ON ev.id = bms.ref_material
                                      LEFT JOIN tapa t ON t.id = bms.ref_material
                                      LEFT JOIN etiqueta et ON et.id = bms.ref_material
                                      INNER JOIN usuario u ON u.id = bms.realizo
                                      WHERE batch = :batch ORDER BY modulo;");
        $stmt->execute(['batch' => $batch]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $envaseSobrante = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("envaseSobrante Obtenidos", array('envaseSobrante' => $envaseSobrante));
        return $envaseSobrante;
    }

    public function findMuestras($idBatch, $modulo)
    {
        $connection = Connection::getInstance()->getConnection();

        if ($modulo == 5)
            $stmt = $connection->prepare("SELECT * FROM batch_muestras WHERE batch = :batch");
        else
            $stmt = $connection->prepare("SELECT * FROM batch_muestras_acondicionamiento WHERE batch = :batch");

        $stmt->execute(['batch' => $idBatch]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $muestras = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("muestras Obtenidos", array('muestras' => $muestras));
        return $muestras;
    }
}
