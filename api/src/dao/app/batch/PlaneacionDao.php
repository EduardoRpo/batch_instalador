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
        // Consolidar referencias
        $dataPedidosReferencias = array();

        foreach ($dataPedidos as $t) {
            $repeat = false;
            for ($i = 0; $i < count($dataPedidosReferencias); $i++) {
                if ($dataPedidosReferencias[$i]['referencia'] == $t['referencia']) {
                    $dataPedidosReferencias[$i]['id'] = "{$dataPedidosReferencias[$i]['id']} - {$t['id']}";
                    $dataPedidosReferencias[$i]['numPedido'] = "{$dataPedidosReferencias[$i]['numPedido']} - {$t['numPedido']}";
                    $dataPedidosReferencias[$i]['tamanio_lote'] += $t['tamanio_lote'];
                    $dataPedidosReferencias[$i]['cantidad_acumulada'] += $t['cantidad_acumulada'];
                    $dataPedidosReferencias[$i]['fecha_insumo'] = "{$dataPedidosReferencias[$i]['fecha_insumo']} - {$t['fecha_insumo']}";
                    $repeat = true;
                    break;
                }
            }
            if ($repeat == false)
                $dataPedidosReferencias[] = array(
                    'id' => $t['id'],
                    'granel' => $t['granel'],
                    'numPedido' => $t['numPedido'],
                    'referencia' => $t['referencia'],
                    'producto' => $t['producto'],
                    'tamanio_lote' => $t['tamanio_lote'],
                    'fecha_planeacion' => $t['fecha_planeacion'],
                    'cantidad_acumulada' => $t['cantidad_acumulada'],
                    'fecha_insumo' => $t['fecha_insumo'],
                );
        }

        // Consolidad graneles
        $dataPedidosGranel = array();

        foreach ($dataPedidosReferencias as $t) {
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
                    'tamanio_lote' => $t['tamanio_lote'],
                    'fecha_planeacion' => $t['fecha_planeacion']
                );
        }

        for ($i = 0; $i < sizeof($dataPedidosGranel); $i++) {
            for ($j = 0; $j < sizeof($dataPedidosReferencias); $j++)
                if ($dataPedidosGranel[$i]['granel'] == $dataPedidosReferencias[$j]['granel'])
                    //Adiciona la multipresentacion al Granel
                    $dataPedidosGranel[$i]['multi'][$j] = $dataPedidosReferencias[$j];
            // Restablecer llaves de variable $dataPedidosGranel
            $dataPedidosGranel[$i]['multi'] = array_values($dataPedidosGranel[$i]['multi']);
        }

        return $dataPedidosGranel;
    }
}
