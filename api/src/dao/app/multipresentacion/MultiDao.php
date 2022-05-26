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

    public function findAllMultiByRef()
    {
        $connection = Connection::getInstance()->getConnection();
        $referencia = $_POST['id'];

        $sql = "SELECT multi FROM producto WHERE referencia = :referencia";
        $query = $connection->prepare($sql);
        $query->execute(['referencia' => $referencia]);
        $ids = $query->fetchAll($connection::FETCH_ASSOC);

        foreach ($ids as $id)
            $multi = $id['multi'];

        $rows = $query->rowCount();

        if ($rows > 0 /* && $multi != 0 */) {
            //$sql = "SELECT p.referencia, p.nombre_referencia FROM producto p WHERE multi = :multi";
            $sql = "SELECT p.referencia, p.nombre_referencia as nombre, m.nombre as marca, ns.nombre as notificacion, pp.nombre as propietario, np.nombre as producto, pc.nombre as presentacion, l.nombre as linea, l.densidad 
                  FROM producto p INNER JOIN marca m INNER JOIN notificacion_sanitaria ns INNER JOIN propietario pp INNER JOIN nombre_producto np INNER JOIN linea l INNER JOIN presentacion_comercial pc
                  ON p.id_marca = m.id AND p.id_notificacion_sanitaria = ns.id AND p.id_propietario=pp.id AND p.id_nombre_producto= np.id AND p.id_linea=l.id AND pc.id = p.presentacion_comercial
                  WHERE multi = :multi";
            $query = $connection->prepare($sql);
            $query->execute(['multi' => $multi]);
            $query->execute(['multi' => $multi]);
            $id_multi = $query->fetchAll($connection::FETCH_ASSOC);
            echo json_encode($id_multi, JSON_UNESCAPED_UNICODE);
        }
    }

    public function saveMulti($id_batch, $multipresentaciones)
    {
        $connection = Connection::getInstance()->getConnection();
        
        foreach ($multipresentaciones as $multipresentacion) {
            $sql = "SELECT * FROM multipresentacion WHERE id_batch = :id_batch AND referencia = :referencia";
            $query = $connection->prepare($sql);
            $query->execute([
                'referencia' => $multipresentacion['referencia'],
                'id_batch' => $id_batch,
            ]);

            $rows = $query->rowCount();

            if ($rows > 0) {
                $sql = "UPDATE multipresentacion SET cantidad = :cantidad, total = :total 
                        WHERE id_batch = :id_batch AND referencia = :referencia";
                $query = $connection->prepare($sql);
                $result = $query->execute([
                    'referencia' => $multipresentacion['referencia'],
                    'id_batch' => $id_batch,
                    'cantidad' => $multipresentacion['cantidadunidades'],
                    'total' => $multipresentacion['tamaniopresentacion'],
                ]);
            } else {
                $sql = "INSERT INTO multipresentacion (id_batch, referencia, cantidad, total) 
                        VALUES (:id_batch, :referencia, :cantidad, :total)";
                $query = $connection->prepare($sql);
                $result = $query->execute([
                    'id_batch' => $id_batch,
                    'referencia' => $multipresentacion['referencia'],
                    'cantidad' => $multipresentacion['cantidadunidades'],
                    'total' => $multipresentacion['tamaniopresentacion'],
                ]);
            }
            if ($result) {
                $sql = "UPDATE batch SET multi = '1' WHERE id_batch= :id_batch";
                $query = $connection->prepare($sql);
                $result = $query->execute(['id_batch' => $id_batch,]);
            }
        }

        /* Actualizar tabla firmas con multipresentacion */
        $this->controlFirmasMulti($id_batch);

        if (!$result) {
            die('Error');
            echo '0';
        } else {
            echo '1';
        }
    }
}
