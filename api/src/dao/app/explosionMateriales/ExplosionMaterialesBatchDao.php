<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class ExplosionMaterialesBatchDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function registrarExplosionMaterialesUso($dataMateriales)
    {
        $connection = Connection::getInstance()->getConnection();

        $batch = $dataMateriales['idBatch'];

        /* Inicio Batch para cargar informacion de pesaje materia prima */
        if ($batch < 602) exit();

        /* buscar la referencia del producto */

        $sql = "SELECT id_producto, tamano_lote FROM batch WHERE id_batch = :batch";
        $query = $connection->prepare($sql);
        $query->execute(['batch' => $batch]);
        $productoTamanio = $query->fetch($connection::FETCH_ASSOC);

        /* busca la materia prima */

        $sql = "SELECT f.id, mp.referencia, cast(AES_DECRYPT(porcentaje, 'Wf[Ht^}2YL=D^DPD') as char)porcentaje 
            FROM formula f INNER JOIN materia_prima mp ON f.id_materiaprima = mp.referencia 
            WHERE f.id_producto = :id_producto";
        $query = $connection->prepare($sql);
        $query->execute(['id_producto' => $productoTamanio['id_producto']]);
        $materiales = $query->fetchAll($connection::FETCH_ASSOC);

        /* Calcula la cantidad de materia prima */

        foreach ($materiales as $material) {
            $tanques = $dataMateriales['tanques'];
            $cantidad = (($material['porcentaje'] / 100) * $productoTamanio['tamano_lote']) / $tanques;

            $sql = "SELECT * FROM explosion_materiales_batch WHERE batch = :batch AND id_producto = :id_producto AND id_materiaprima = :id_materia_prima";
            $query = $connection->prepare($sql);
            $query->execute([
                'batch' => $batch,
                'id_producto' => $productoTamanio['id_producto'],
                'id_materia_prima' => $material['referencia']
            ]);
            $rows = $query->rowCount();

            if ($rows > 0) {
                $materia_prima = $query->fetch($connection::FETCH_ASSOC);

                $cantidadUsoOld = floatval($materia_prima['uso']);
                $cantidadUsoNueva = $cantidad + $cantidadUsoOld;

                /* Actualiza */

                $sql = "UPDATE explosion_materiales_batch SET uso = :uso WHERE batch = :batch AND id_producto = :id_producto AND id_materiaprima = :id_materia_prima";
                $query = $connection->prepare($sql);
                $query->execute([
                    'uso' => $cantidadUsoNueva,
                    'id_producto' => $productoTamanio['id_producto'],
                    'batch' => $batch,
                    'id_materia_prima' => $material['referencia']
                ]);
            } /* else {
            $sql = "INSERT INTO batch_explosion_materiales (id_materiaprima, cantidad) 
                    VALUES(:id_materiaprima, :cantidad)";
            $query = $conn->prepare($sql);
            $query->execute(['id_materia_prima' => $material['id_materiaprima'], 'uso' => $cantidad]);
        } */
        }
    }
}
