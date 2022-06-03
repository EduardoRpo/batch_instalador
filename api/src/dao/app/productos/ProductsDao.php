<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class ProductsDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function findAllProductsGranel()
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT p.referencia, p.nombre_referencia, m.nombre as marca, ns.nombre as notificacion_sanitaria, 
                                             pp.nombre as propietario, np.nombre as producto, pc.nombre as presentacion_comercial, l.nombre as linea, l.densidad, l.ajuste, p.densidad_producto 
                                             FROM producto p 
                                             INNER JOIN marca m ON p.id_marca = m.id
                                             INNER JOIN notificacion_sanitaria ns ON p.id_notificacion_sanitaria = ns.id
                                             INNER JOIN propietario pp ON p.id_propietario=pp.id
                                             INNER JOIN nombre_producto np ON p.id_nombre_producto= np.id
                                             INNER JOIN linea l ON p.id_linea=l.id
                                             INNER JOIN presentacion_comercial pc On pc.id = p.presentacion_comercial
                                      WHERE referencia LIKE '%G%'
                                      ORDER BY nombre_referencia ASC");
        $stmt->execute();
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $granel = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("granel Obtenidos", array('granel' => $granel));
        return $granel;
    }

    // Buscar tamaño de lote presentacion por el nombre del granel
    public function findProductGranel($dataGranel)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT pc.nombre as presentacion 
                                      FROM producto p 
                                      INNER JOIN presentacion_comercial pc On pc.id = p.presentacion_comercial 
                                      WHERE p.referencia = :referencia");
        $stmt->execute(['referencia' => $dataGranel['granel']]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $presentacion = $stmt->fetch($connection::FETCH_ASSOC);
        $this->logger->notice("presentacion Obtenido", $presentacion);
        return $presentacion['presentacion'];
    }
}
