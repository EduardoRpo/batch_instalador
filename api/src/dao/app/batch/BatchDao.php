<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class BatchDao extends MultiDao

{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function findAllBatch($batch)
    {
        $connection = Connection::getInstance()->getConnection();
    }

    /**
     * @return array
     */
    public function findAll()
    {
        $connection = Connection::getInstance()->getConnection();
        //$stmt = $connection->prepare("SELECT * FROM producto INNER JOIN batch ON batch.id_producto = producto.referencia INNER JOIN linea ON producto.id_linea = linea.id INNER JOIN propietario ON producto.id_propietario = propietario.id WHERE batch.estado = 1 OR batch.estado = 2 AND batch.fecha_programacion = CURRENT_DATE()");
        $stmt = $connection->prepare("SELECT batch.id_batch, batch.numero_orden, producto.referencia, producto.nombre_referencia, pc.nombre  as presentacion_comercial, batch.numero_lote, batch.tamano_lote, propietario.nombre,batch.fecha_creacion, batch.fecha_programacion, batch.estado, batch.multi
                                  FROM batch INNER JOIN producto INNER JOIN propietario INNER JOIN presentacion_comercial pc
                                  ON batch.id_producto = producto.referencia AND producto.id_propietario = propietario.id AND producto.presentacion_comercial = pc.id
                                  WHERE batch.id_batch NOT IN (SELECT batch FROM `batch_liberacion` WHERE dir_produccion > 0 AND dir_calidad > 0 and dir_tecnica > 0) 
                                  ORDER BY `batch`.`id_batch` ASC");
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
                                  WHERE b.estado = 10 GROUP BY batch HAVING firmas = 1 ORDER BY b.id_batch DESC");
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

    public function findById($id)
    {
        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT p.referencia, p.nombre_referencia, pc.nombre as presentacion, p.unidad_empaque, pp.nombre as propietario, batch.numero_orden, batch.tamano_lote, batch.numero_lote, batch.unidad_lote, linea.nombre as linea, linea.densidad, p.densidad_producto, batch.fecha_programacion, batch.estado, p.img 
                                  FROM producto p 
                                  INNER JOIN batch ON batch.id_producto = p.referencia 
                                  INNER JOIN presentacion_comercial pc ON pc.id = p.presentacion_comercial 
                                  INNER JOIN linea ON linea.id = p.id_linea 
                                  INNER JOIN propietario pp ON pp.id = p.id_propietario WHERE id_batch = :idBatch");

        $stmt->execute(array('idBatch' => $id));
        $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
        $batch = $stmt->fetch($connection::FETCH_ASSOC);
        $this->logger->notice("batch consultado", array('batch' => $batch));

        return $batch;
    }

    public function saveBatch($dataBatch)
    {
        $id_batch               = $dataBatch['id_batch'];
        $referencia             = $dataBatch['ref'];
        $tamanototallote        = $dataBatch['lote'];
        $fechaprogramacion      = $dataBatch['programacion'];
        $tamanolotepresentacion = $dataBatch['presentacion'];
        $tanque                 = $dataBatch['tanque'];
        $cantidades             = $dataBatch['cantidades'];
        $multi                  = json_decode($dataBatch['multi'], true);
        $fechahoy               = date("Y-m-d");

        $connection = Connection::getInstance()->getConnection();
        $unidadesxlote = 0;

        /* sumar total cantidades */

        for ($i = 0; $i < sizeof($multi); $i++)
            $unidadesxlote = $unidadesxlote + $multi[$i]['cantidadunidades'];

        /* Modifica estdo inicial */

        $result = $this->estadoInicial($referencia, $fechaprogramacion);
        $estado = $result['0'];
        $fechaprogramacion = $result['1'];

        /* Inserta y crea batch */

        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("INSERT INTO batch (fecha_creacion, fecha_programacion, fecha_actual, numero_orden, numero_lote, tamano_lote, lote_presentacion, unidad_lote, estado, id_producto) 
                                      VALUES(:fecha_creacion, :fecha_programacion, :fecha_actual, :numero_orden, :numero_lote, :tamano_lote, :lote_presentacion, :unidad_lote, :estado, :id_producto)");
        $stmt->execute([
            'fecha_creacion' => $fechahoy,
            'fecha_programacion' => $fechaprogramacion,
            'fecha_actual' => $fechahoy,
            'numero_orden' => 'OP012020',
            'numero_lote' => ' X0010320',
            'fecha_creacion' => $fechahoy,
            'tamano_lote' => $tamanototallote,
            'lote_presentacion' => $tamanolotepresentacion,
            'unidad_lote' => $unidadesxlote,
            'estado' => $estado,
            'id_producto' => $referencia
        ]);

        /* Inserte tanque y cantidades */

        if ($result) {
            $lastIdInsert = $connection->lastInsertId();

            /* Registre los tanques */
            $this->saveTanques($dataBatch, $lastIdInsert);

            /* registre modulos y cantidad de firmas */
            $this->saveControlFirmas($lastIdInsert);

            /* Insertar Multipresentacion */
            $this->saveMulti($lastIdInsert, $multi);

            /* registrar explosion */
            /* if ($id < 602) exit();
            else explosion($connection, $id, $referencia, $tamanototallote); */
        }

        /*  mysqli_close($connection);

        if (!$result) echo 'false' . mysqli_error($connection);
        else echo 'true'; */
    }

    public function updateBatch()
    {
        $id_batch     = $_POST['id_batch'];
        $referencia   = $_POST['ref'];
        $unidades     = $_POST['unidades'];
        $lote         = $_POST['lote'];
        $fechaprogramacion = $_POST['programacion'];
        $tanque    = $_POST['tanque'];
        $cantidades  = $_POST['cantidades'];

        $connection = Connection::getInstance()->getConnection();

        /* asigna el estado */
        $result = estadoInicial($connection, $referencia, $fechaprogramacion);
        $estado = $result['0'];
        $fechaprogramacion = $result['1'];

        /* Actualiza el batch */
        $query_actualizar = "UPDATE batch SET unidad_lote = '$unidades', tamano_lote = '$lote', estado = '$estado', fecha_programacion = ";
        $query_actualizar .= $fechaprogramacion != null ? "'$fechaprogramacion'" : "NULL ";
        $query_actualizar .= "WHERE id_batch ='$id_batch'";
        $result = mysqli_query($connection, $query_actualizar);

        /* Actualizar los tanques */
        if ($result) {
            $query_tanque = "SELECT * FROM batch_tanques WHERE id_batch = '$id_batch'";
            $result = mysqli_query($connection, $query_tanque);
            if ($result) {
                $query_tanque = "UPDATE batch_tanques SET tanque = '$tanque', cantidad = '$cantidades' WHERE id_batch = '$id_batch'";
                $result = mysqli_query($connection, $query_tanque);
            } /* else {
            $query_tanque = "INSERT INTO batch_tanques (tanque, cantidad, id_batch) VALUES('$tanque' , '$cantidades', '$id_batch')";
            $result = mysqli_query($connection, $query_tanque);
        } */
        }

        if ($result)
            echo "true";
        else
            echo 'false ' . mysqli_error($connection);

        mysqli_close($connection);
    }

    public function deleteBatch()
    {
    }


    public function estadoInicial($referencia, $fechaprogramacion)
    {
        $connection = Connection::getInstance()->getConnection();

        /* validar que exista la formula*/

        $connection = Connection::getInstance()->getConnection();
        $stmt = $connection->prepare("SELECT * FROM formula WHERE id_producto = :referencia");
        $stmt->execute(['referencia' => $referencia]);
        $resultFormula = $stmt->rowCount();

        /* validar que exista el instructivo */

        $stmt = $connection->prepare("SELECT * FROM instructivo_preparacion WHERE id_producto = :referencia");
        $stmt->execute(['referencia' => $referencia]);
        $resultPreparacionInstructivos = $stmt->rowCount();


        /* si el instructivo no existe valida que exista el instructivo en Bases*/
        if ($resultPreparacionInstructivos == 0) {
            $stmt = $connection->prepare("SELECT instructivo FROM producto WHERE referencia = :referencia");
            $stmt->execute(['referencia' => $referencia]);
            $resultPreparacionInstructivos = $stmt->rowCount();
        }

        /* consolida resultados */
        $result = $resultFormula * $resultPreparacionInstructivos;

        /* Asigna el estado de acuerdo con el resultado */
        if ($result === 0) {
            $estado = '1';  //Sin formula
            $fechaprogramacion = '';
        }

        if ($result > 0 && $fechaprogramacion == '')
            $estado = '2'; // Inactivo  


        if ($result > 0 && $fechaprogramacion != '')
            $estado = '3';  //Pesaje


        return array($estado, $fechaprogramacion);
    }


    public function saveTanques($dataBatch, $lastIdInsert)
    {
        $tanque = $dataBatch['tanque'];
        $cantidades = $dataBatch['cantidades'];

        $connection = Connection::getInstance()->getConnection();

        $sql = "INSERT INTO batch_tanques (tanque, cantidad, id_batch) 
                VALUES(:tanque, :cantidades, :id)";
        $query_multi = $connection->prepare($sql);
        $query_multi->execute([
            'tanque' => $tanque,
            'cantidades' => $cantidades,
            'id' => $lastIdInsert
        ]);
    }

    public function saveControlFirmas($lastIdInsert)
    {
        $connection = Connection::getInstance()->getConnection();

        $sql = "INSERT INTO batch_control_firmas (modulo, batch, cantidad_firmas, total_firmas) 
                         VALUES('2' , :lastIdInsert, '0', '4')";
        $query = $connection->prepare($sql);
        $query->execute(['lastIdInsert' => $lastIdInsert]);

        $sql = "INSERT INTO batch_control_firmas (modulo, batch, cantidad_firmas, total_firmas) 
                         VALUES('3' , :lastIdInsert, '0', '4')";
        $query = $connection->prepare($sql);
        $query->execute(['lastIdInsert' => $lastIdInsert]);

        $sql = "INSERT INTO batch_control_firmas (modulo, batch, cantidad_firmas, total_firmas) 
                         VALUES('4' , :lastIdInsert, '0', '2')";
        $query = $connection->prepare($sql);
        $query->execute(['lastIdInsert' => $lastIdInsert]);

        $sql = "INSERT INTO batch_control_firmas (modulo, batch, cantidad_firmas, total_firmas) 
                         VALUES('5' , :lastIdInsert, '0', '6')";
        $query = $connection->prepare($sql);
        $query->execute(['lastIdInsert' => $lastIdInsert]);

        $sql = "INSERT INTO batch_control_firmas (modulo, batch, cantidad_firmas, total_firmas) 
                         VALUES('6' , :lastIdInsert, '0', '7')";
        $query = $connection->prepare($sql);
        $query->execute(['lastIdInsert' => $lastIdInsert]);

        $sql = "INSERT INTO batch_control_firmas (modulo, batch, cantidad_firmas, total_firmas) 
                         VALUES('7' , :lastIdInsert, '0', '1')";
        $query = $connection->prepare($sql);
        $query->execute(['lastIdInsert' => $lastIdInsert]);

        $sql = "INSERT INTO batch_control_firmas (modulo, batch, cantidad_firmas, total_firmas) 
                         VALUES('8' , :lastIdInsert, '0', '2')";
        $query = $connection->prepare($sql);
        $query->execute(['lastIdInsert' => $lastIdInsert]);

        $sql = "INSERT INTO batch_control_firmas (modulo, batch, cantidad_firmas, total_firmas) 
                         VALUES('9' , :lastIdInsert, '0', '2')";
        $query = $connection->prepare($sql);
        $query->execute(['lastIdInsert' => $lastIdInsert]);

        $sql = "INSERT INTO batch_control_firmas (modulo, batch, cantidad_firmas, total_firmas) 
                         VALUES('10' , :lastIdInsert, '0', '3')";
        $query = $connection->prepare($sql);
        $query->execute(['lastIdInsert' => $lastIdInsert]);
    }
}
