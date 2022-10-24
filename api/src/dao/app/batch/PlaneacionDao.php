<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class PlaneacionDao

{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function setDataPedidos($dataPedidos)
    {
        $dataPedidosGranel = array();

        foreach ($dataPedidos as $t) {
            $repeat = false;
            for ($i = 0; $i < count($dataPedidosGranel); $i++) {
                if ($dataPedidosGranel[$i]['granel'] == $t['granel']) {
                    $dataPedidosGranel[$i]['cantidad_acumulada'] += $t['cantidad_acumulada'];
                    $dataPedidosGranel[$i]['tamanio_lote'] += $t['tamanio_lote'];
                    $repeat = true;
                    break;
                }
            }
            if ($repeat == false)
                $dataPedidosGranel[] = array(
                    'granel' => $t['granel'],
                    'producto' => $t['producto'],
                    'cantidad_acumulada' => $t['cantidad_acumulada'],
                    'tamanio_lote' => $t['tamanio_lote']
                );
        }

        for ($i = 0; $i < sizeof($dataPedidosGranel); $i++) {
            for ($j = 0; $j < sizeof($dataPedidos); $j++)
                if ($dataPedidosGranel[$i]['granel'] == $dataPedidos[$j]['granel'])
                    //Adiciona la multipresentacion al Granel
                    $dataPedidosGranel[$i]['multi'][$j] = $dataPedidos[$j];
            // Restablecer llaves de variable $dataPedidosGranel
            $dataPedidosGranel[$i]['multi'] = array_values($dataPedidosGranel[$i]['multi']);
        }

        return $dataPedidosGranel;
    }
}
