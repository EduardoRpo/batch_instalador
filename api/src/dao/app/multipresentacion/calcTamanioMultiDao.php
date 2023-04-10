<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class calcTamanioMultiDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function calcularTamanioLote($data, $cantidad)
    {
        /* densidad es la tabla producto */
        //rendimiento
        //$rendimiento = 100 - $rendimiento_producto;
        //$tamanioLote = (((floatval($data['densidad_producto']) * floatval($data['presentacion']) * floatval($cantidad)) * (1 + $rendimiento)) * (1 + $data['ajuste'])) / 1000;
        $tamanioLote = ((floatval($data['densidad']) * floatval($data['presentacion']) * floatval($cantidad)) * (1 + $data['ajuste'])) / 1000;
        return $tamanioLote;
    }
}
