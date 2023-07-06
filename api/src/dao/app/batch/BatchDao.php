<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class BatchDao extends estadoInicialDao

{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function findBatch($batch)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT * FROM batch WHERE id_batch = :id_batch");
        $stmt->execute(['id_batch' => $batch]);
        $dataBatch = $stmt->fetch($connection::FETCH_ASSOC);
        return $dataBatch;
    }

    public function findBatchByRef($reference)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT * FROM `batch` 
                                      WHERE id_producto = :granel;");
        $stmt->execute(['granel' => $reference]);
        $dataBatch = $stmt->fetchAll($connection::FETCH_ASSOC);
        return $dataBatch;
    }

    public function findEstadoBatch($ref_producto)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT estado FROM batch WHERE id_producto = :id_producto");
        $stmt->execute(['id_producto' => $ref_producto]);
        $estadoBatch = $stmt->fetchAll($connection::FETCH_ASSOC);
        return $estadoBatch;
    }

    public function findBatchByMinAndMax($dataBatch)
    {
        $connection = Connection::getInstance()->getConnection();

        $stmt = $connection->prepare("SELECT * FROM batch WHERE id_batch BETWEEN :minBacth AND :maxBacth");
        $stmt->execute([
            'minBacth' => $dataBatch['minBatch'],
            'maxBacth' => $dataBatch['maxBatch']
        ]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));

        $batchs = $stmt->fetchAll($connection::FETCH_ASSOC);
        return $batchs;
    }

    /**
     * @return array
     */
    public function findActive()
    {
        $connection = Connection::getInstance()->getConnection();
        //$stmt = $connection->prepare("SELECT * FROM producto INNER JOIN batch ON batch.id_producto = producto.referencia INNER JOIN linea ON producto.id_linea = linea.id INNER JOIN propietario ON producto.id_propietario = propietario.id WHERE batch.estado = 1 OR batch.estado = 2 AND batch.fecha_programacion = CURRENT_DATE()");
        $stmt = $connection->prepare("SELECT DISTINCT batch.id_batch, batch.numero_orden, producto.referencia, producto.nombre_referencia, pc.nombre as presentacion_comercial, batch.numero_lote, batch.tamano_lote, propietario.nombre, batch.fecha_creacion, WEEK(batch.fecha_creacion) AS semana_creacion, WEEK(batch.fecha_programacion) AS semana_programacion, 
                                                batch.fecha_programacion, batch.estado, batch.multi, (SELECT COUNT(*) FROM observaciones_batch_inactivos WHERE batch = batch.id_batch) AS cant_observations, producto.id_linea
                                        FROM batch 
                                        INNER JOIN producto ON batch.id_producto = producto.referencia
                                        INNER JOIN propietario  ON producto.id_propietario = propietario.id
                                        INNER JOIN presentacion_comercial pc ON producto.presentacion_comercial = pc.id
                                        LEFT JOIN observaciones_batch_inactivos obi ON obi.batch = batch.id_batch
                                        WHERE estado > 2 AND batch.id_batch 
                                        NOT IN (SELECT batch FROM `batch_liberacion` WHERE dir_produccion > 0 AND dir_calidad > 0 and dir_tecnica > 0) ORDER BY `semana_programacion` ASC");
        $stmt->execute();
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $batch = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("Batch Obtenidos", array('batch' => $batch));
        return $batch;
    }

    /**
     * @return array
     */
    public function findInactive()
    {
        $connection = Connection::getInstance()->getConnection();

        $stmt = $connection->prepare("SELECT DISTINCT batch.id_batch, batch.numero_orden, producto.referencia, producto.nombre_referencia, pc.nombre as presentacion_comercial, batch.numero_lote, batch.tamano_lote, propietario.nombre, batch.fecha_creacion, 
                                             batch.fecha_actual, WEEK(batch.fecha_creacion) AS semanas, batch.fecha_programacion, batch.estado, batch.multi, IFNULL(plan_pedidos.fecha_insumo, '0000-00-00') AS fecha_insumo, obi.fecha_registro,
                                             (SELECT COUNT(*) FROM observaciones_batch_inactivos WHERE batch = batch.id_batch) AS cant_observations
                                      FROM batch 
                                      INNER JOIN producto ON batch.id_producto = producto.referencia
                                      INNER JOIN propietario  ON producto.id_propietario = propietario.id
                                      INNER JOIN presentacion_comercial pc ON producto.presentacion_comercial = pc.id
                                      LEFT JOIN plan_pedidos ON plan_pedidos.id_producto = producto.referencia
                                      LEFT JOIN observaciones_batch_inactivos obi ON obi.batch = batch.id_batch
                                      WHERE batch.estado BETWEEN 1 AND 2 ORDER BY `batch`.`id_batch` DESC");
        $stmt->execute();
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $batch = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("Batch Obtenidos", array('batch' => $batch));
        return $batch;
    }

    /**
     * @return array
     */

    public function findAllClosed()
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT b.id_batch, b.numero_orden, p.referencia, p.nombre_referencia, pc.nombre as presentacion_comercial, b.numero_lote, b.tamano_lote, pp.nombre, b.fecha_creacion, b.fecha_programacion, b.estado, b.multi, 
                                  bcf.cantidad_firmas, SUM(bcf.cantidad_firmas) as cantidad_firmas, SUM(bcf.total_firmas) as total_firmas, IF(SUM(bcf.cantidad_firmas) = SUM(bcf.total_firmas), 1, 0) as firmas 
                                  FROM batch b INNER JOIN producto p ON b.id_producto = p.referencia 
                                  INNER JOIN propietario pp ON p.id_propietario = pp.id 
                                  INNER JOIN presentacion_comercial pc ON p.presentacion_comercial = pc.id 
                                  INNER JOIN batch_control_firmas bcf ON b.id_batch = bcf.batch 
                                  WHERE b.estado = 10 GROUP BY batch HAVING firmas = 1 
                                  ORDER BY b.id_batch DESC");
        $stmt->execute();
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $batch = $stmt->fetchAll($connection::FETCH_ASSOC);
        $this->logger->notice("Batch Obtenidos", array('batch' => $batch));
        return $batch;
    }

    /**
     * Encuentra un batch por id
     * @param $id integer id a buscar
     * @return mixed
     */

    public function findBatchById($id)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT b.id_batch, b.pedido, p.referencia, p.nombre_referencia, pc.nombre AS presentacion, m.nombre AS marca, 
                                             ns.nombre AS notificacion_sanitaria, p.unidad_empaque, pp.nombre as propietario, b.numero_orden, b.tamano_lote, b.numero_lote, 
                                             b.unidad_lote, l.nombre as linea, l.densidad, p.densidad_producto, b.fecha_programacion, b.fecha_creacion, b.estado, p.img, DATE_ADD(exp.fecha_insumo, INTERVAL 8 DAY) AS fecha_insumo, 
                                             IFNULL(bt.tanque,0) AS tanque, IFNULL(bt.cantidad,0) AS cantidad
                                      FROM batch b
                                            INNER JOIN producto p ON p.referencia = b.id_producto
                                            LEFT JOIN multipresentacion mul ON mul.id_batch = b.id_batch
                                            INNER JOIN presentacion_comercial pc ON pc.id = p.presentacion_comercial 
                                            INNER JOIN linea l ON l.id = p.id_linea 
                                            INNER JOIN propietario pp ON pp.id = p.id_propietario 
                                            INNER JOIN marca m ON m.id = p.id_marca
                                            INNER JOIN notificacion_sanitaria ns ON ns.id = p.id_notificacion_sanitaria
                                            LEFT JOIN plan_pedidos exp ON exp.id_producto = mul.referencia
                                            LEFT JOIN batch_tanques bt ON bt.id_batch = b.id_batch
                                      WHERE b.id_batch = :idBatch ORDER BY `exp`.`fecha_insumo` DESC LIMIT 1;");
        $stmt->execute(array('idBatch' => $id));
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $batch = $stmt->fetch($connection::FETCH_ASSOC);
        $this->logger->notice("batch consultado", array('batch' => $batch));
        return $batch;
    }

    public function saveBatch($dataBatch, $multi)
    {
        if (!empty($dataBatch['pedido']))
            $pedido = $dataBatch['pedido'];
        else
            $pedido = 1;

        $dataBatch['ref'] == null ? $referencia = $dataBatch['granel'] : $referencia = $dataBatch['ref'];
        $dataBatch['lote'] == null ? $tamanototallote = $dataBatch['tamanio_lote'] : $tamanototallote = $dataBatch['lote'];
        $dataBatch['presentacion'] == null ? $tamanolotepresentacion = 1 : $tamanolotepresentacion = $dataBatch['presentacion'];
        $dataBatch['programacion'] == null ? $fechaprogramacion = $dataBatch['date'] : $fechaprogramacion = $dataBatch['programacion'];

        // $fechaprogramacion      = $dataBatch['programacion'];
        // $referencia             = $dataBatch['ref'];
        // $tamanototallote        = $dataBatch['lote'];
        // $tamanolotepresentacion = $dataBatch['presentacion'];

        if ($dataBatch['fecha_planeacion'])
            $fecha           = $dataBatch['fecha_planeacion'];
        else
            $fecha           = date("Y-m-d");

        $fechahoy = date("Y-m-d");
        $unidadesxlote = 0;

        /* sumar total cantidades */
        if ($multi[0]['cantidadunidades'] != null) {
            for ($i = 0; $i < sizeof($multi); $i++)
                $unidadesxlote = $unidadesxlote + $multi[$i]['cantidadunidades'];
        } else
            $unidadesxlote = $dataBatch['cantidad_acumulada'];

        $connection = Connection::getInstance()->getConnection();
        /* Modifica estado inicial */

        $result = $this->estadoInicial($referencia, $fechaprogramacion);
        $estado = $result['0'];
        $fechaprogramacion = $result['1'];

        /* Inserta y crea batch */

        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("INSERT INTO batch (pedido, fecha_creacion, fecha_programacion, fecha_actual, numero_orden, numero_lote, tamano_lote, lote_presentacion, unidad_lote, estado, id_producto) 
                                      VALUES(:pedido, :fecha_creacion, :fecha_programacion, :fecha_actual, :numero_orden, :numero_lote, :tamano_lote, :lote_presentacion, :unidad_lote, :estado, :id_producto)");
        $stmt->execute([
            'pedido' => $pedido,
            'fecha_creacion' => $fecha,
            'fecha_programacion' => $fechaprogramacion,
            'fecha_actual' => $fechahoy,
            'numero_orden' => 'OP012020',
            'numero_lote' => ' X0010320',
            'tamano_lote' => $tamanototallote,
            'lote_presentacion' => $tamanolotepresentacion,
            'unidad_lote' => $unidadesxlote,
            'estado' => $estado,
            'id_producto' => $referencia
        ]);
    }

    public function updateBatch($dataBatch)
    {
        $id_batch     = $dataBatch['id_batch'];
        $referencia   = $dataBatch['ref'];
        $fechaprogramacion = $dataBatch['programacion'];

        $connection = Connection::getInstance()->getConnection();

        /* asigna el estado */
        $result = $this->estadoInicial($referencia, $fechaprogramacion);
        $estado = $result['0'];
        $fechaprogramacion = $result['1'];

        /* Actualiza el batch */
        $stmt =  $connection->prepare("UPDATE batch 
                                       SET estado = :estado, fecha_programacion = :fecha_programacion 
                                       WHERE id_batch = :id_batch");
        $result = $stmt->execute([
            'fecha_programacion' => $fechaprogramacion,
            'estado' => $estado,
            'id_batch' => $id_batch
        ]);

        /* Actualizar los tanques
        if ($result) {

            $tanque    = $dataBatch['tanque'];
            $cantidad  = $dataBatch['cantidades'];

            $stmt =  $connection->prepare("SELECT * FROM batch_tanques WHERE id_batch = :id_batch");
            $stmt->execute(['id_batch' => $id_batch]);
            $result = $stmt->rowCount();

            if ($result) {
                $stmt =  $connection->prepare("UPDATE batch_tanques SET tanque = :tanque, cantidad = :cantidad WHERE id_batch = :id_batch");
                $stmt->execute([
                    'tanque' => $tanque,
                    'cantidad' => $cantidad,
                    'id_batch' => $id_batch
                ]);
            }
        } */
    }

    public function updateEstadoBatch($batch, $estado)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("UPDATE batch SET estado = :estado WHERE id_batch = :batch");
        $result = $stmt->execute(['batch' => $batch, 'estado' => $estado]);
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        return $result;
    }

    public function updateBatchPedido($id_batch, $dataBatch)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("UPDATE batch SET pedido = :pedido WHERE id_batch = :id_batch");
        $stmt->execute([
            'pedido' => $dataBatch['numPedido'],
            'id_batch' => $id_batch
        ]);
    }

    public function deleteBatch($id_batch, $motivo)
    {
        $connection = Connection::getInstance()->getConnection();

        try {
            $stmt = $connection->prepare("UPDATE batch SET estado = 0, fecha_eliminacion = CURDATE() WHERE id_batch = :id_batch");
            $stmt->execute(['id_batch' => $id_batch]);

            $stmt = $connection->prepare("SELECT * FROM batch_eliminados WHERE batch = :batch");
            $stmt->execute(['batch' => $id_batch]);

            $row = $stmt->rowCount();

            if ($row > 0) {
                $stmt = $connection->prepare("INSERT INTO batch_eliminados (batch, motivo) VALUES(:batch, :motivo)");
                $stmt->execute(['batch' => $id_batch, 'motivo' => $motivo]);
            } else {
                $stmt = $connection->prepare("UPDATE batch_eliminados SET motivo = :motivo WHERE batch = :batch");
                $stmt->execute(['batch' => $id_batch, 'motivo' => $motivo]);
            }
        } catch (\Exception $e) {
            $message = $e->getMessage();
            $error = array('info' => true, 'message', $message);
            return $error;
        }
    }

    public function loadImagePdf()
    {
        try {
            $targetDir = dirname(dirname(dirname(dirname(dirname(dirname(dirname(dirname(dirname(__DIR__))))))))) . '/exportBatch/label/pdf/';
            $allowTypes = array('pdf');

            $image_name = str_replace(' ', '', $_FILES['pdf']['name']);
            $tmp_name   = $_FILES['pdf']['tmp_name'];
            $size       = $_FILES['pdf']['size'];
            $type       = $_FILES['pdf']['type'];
            $error      = $_FILES['pdf']['error'];

            /* Verifica si directorio esta creado y lo crea */
            if (!is_dir($targetDir))
                mkdir($targetDir, 0777, true);

            $targetDir = '/label/pdf/';
            $targetFilePath = $targetDir . '/' . $image_name;

            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

            if (in_array($fileType, $allowTypes)) {
                $targetDir = dirname(dirname(dirname(dirname(dirname(dirname(dirname(dirname(dirname(__DIR__))))))))) . '/exportBatch/label/pdf/';
                $targetFilePath1 = $targetDir . '/' . $image_name;

                // Verificar si el archivo de destino ya existe
                if (file_exists($targetFilePath1)) {
                    // Eliminar el archivo de destino existente
                    unlink($targetFilePath1);
                }

                move_uploaded_file($tmp_name, $targetFilePath1);

                // return $targetFilePath;
            }
        } catch (\Exception $e) {
            $message = $e->getMessage();

            $error = array('info' => true, 'message' => $message);
            return $error;
        }
    }
}
