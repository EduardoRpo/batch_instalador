<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class MultiDao extends ControlFirmasMultiDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function findMultiByBatch($id_batch)
    {

        $connection = Connection::getInstance()->getConnection();

        $sql = "SELECT p.referencia, p.nombre_referencia AS nombre, multi.id_batch, multi.cantidad, multi.total, linea.densidad, pc.nombre as presentacion, p.img 
                FROM producto p
                INNER JOIN multipresentacion multi ON p.referencia = multi.referencia 
                INNER JOIN linea ON p.id_linea = linea.id 
                INNER JOIN presentacion_comercial pc ON p.presentacion_comercial = pc.id 
                WHERE id_batch = :batch";
        $query = $connection->prepare($sql);
        $query->execute(['batch' => $id_batch]);
        $multi = $query->fetchAll($connection::FETCH_ASSOC);
        return $multi;
    }

    public function findProductMultiByRef($referencia)
    {

        $connection = Connection::getInstance()->getConnection();

        $sql = "SELECT p.referencia, p.densidad_producto as densidad, linea.ajuste, pc.nombre as presentacion 
                FROM producto p 
                INNER JOIN linea ON p.id_linea = linea.id 
                INNER JOIN presentacion_comercial pc ON p.presentacion_comercial = pc.id 
                WHERE p.referencia = :referencia;";
        $query = $connection->prepare($sql);
        $query->execute(['referencia' => $referencia]);
        $dataProduct = $query->fetch($connection::FETCH_ASSOC);
        return $dataProduct;
    }


    public function findMultiByRef($referencia)
    {
        $connection = Connection::getInstance()->getConnection();

        $sql = "SELECT multi FROM producto WHERE referencia = :referencia";
        $query = $connection->prepare($sql);
        $query->execute(['referencia' => $referencia]);
        $ids = $query->fetchAll($connection::FETCH_ASSOC);

        foreach ($ids as $id)
            $multi = $id['multi'];

        $rows = $query->rowCount();

        if ($rows > 0) {
            $sql = "SELECT p.referencia, p.nombre_referencia as nombre, m.nombre as marca, ns.nombre as notificacion, pp.nombre as propietario, np.nombre as producto, pc.nombre as presentacion, l.nombre as linea, l.densidad 
                    FROM producto p INNER JOIN marca m INNER JOIN notificacion_sanitaria ns INNER JOIN propietario pp INNER JOIN nombre_producto np INNER JOIN linea l INNER JOIN presentacion_comercial pc
                    ON p.id_marca = m.id AND p.id_notificacion_sanitaria = ns.id AND p.id_propietario=pp.id AND p.id_nombre_producto= np.id AND p.id_linea=l.id AND pc.id = p.presentacion_comercial
                    WHERE multi = :multi AND referencia LIKE '%M%'";
            $query = $connection->prepare($sql);
            $query->execute(['multi' => $multi]);
            $multi = $query->fetchAll($connection::FETCH_ASSOC);
            return $multi;
        }
    }

    public function saveMulti($id_batch, $dataBatch, $multipresentaciones)
    {
        $connection = Connection::getInstance()->getConnection();

        for ($i = 0; $i < sizeof($multipresentaciones); $i++) {
            if (!empty($multipresentaciones[$i]['cantidad_acumulada'])) {
                $multipresentaciones[$i]['cantidadunidades'] = $multipresentaciones[$i]['cantidad_acumulada'];
                $multipresentaciones[$i]['tamaniopresentacion'] = $multipresentaciones[$i]['tamanio_lote'] - ($multipresentaciones[$i]['tamanio_lote'] * $multipresentaciones[$i]['ajuste']);
            }
        }

        /* Almacena multipresentacion */
        foreach ($multipresentaciones as $multipresentacion) {
            $sql = "INSERT INTO multipresentacion (id_batch, referencia, cantidad, total) 
                        VALUES (:id_batch, :referencia, :cantidad, :total)";
            $query = $connection->prepare($sql);
            $result = $query->execute([
                'id_batch' => $id_batch,
                'referencia' => $multipresentacion['referencia'],
                'cantidad' => $multipresentacion['cantidadunidades'],
                'total' => $multipresentacion['tamaniopresentacion'],
            ]);

            /* Actualiza batch con multipresentacion */
            if ($result) {
                $sql = "UPDATE batch SET multi = '1' WHERE id_batch= :id_batch";
                $query = $connection->prepare($sql);
                $result = $query->execute(['id_batch' => $id_batch,]);
            }
        }

        /* Actualizar tabla firmas con multipresentacion */
        $this->controlFirmasMulti($id_batch);
    }

    public function updateMulti($dataBatch)
    {
        $connection = Connection::getInstance()->getConnection();

        /* Cargar Multipresentacion */
        $multipresentaciones = json_decode($dataBatch['multi'], true);

        /* Buscar Multipresentaciones y actualizar*/
        foreach ($multipresentaciones as $multipresentacion) {
            $sql = "SELECT * FROM multipresentacion WHERE id_batch = :id_batch AND referencia = :referencia";
            $query = $connection->prepare($sql);
            $query->execute([
                'referencia' => $multipresentacion['referencia'],
                'id_batch' => $multipresentacion['id_batch'],
            ]);

            $rows = $query->rowCount();

            if ($rows > 0) {
                $sql = "UPDATE multipresentacion SET cantidad = :cantidad, total = :total 
                        WHERE id_batch = :id_batch AND referencia = :referencia";
                $query = $connection->prepare($sql);
                $query->execute([
                    'referencia' => $multipresentacion['referencia'],
                    'id_batch' => $multipresentacion['id_batch'],
                    'cantidad' => $multipresentacion['cantidadunidades'],
                    'total' => $multipresentacion['tamaniopresentacion'],
                ]);
            }
        }

        /* Actualizar tabla firmas con multipresentacion */
        //$this->controlFirmasMulti($id_batch);
    }
}
