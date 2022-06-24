<?php

namespace BatchRecord\dao;

use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class ControlEspecificacionesDao
{
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger(self::class);
        $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
    }

    public function insertCEspecificacionesByPreparacion($dataBatch)
    {
        $connection = Connection::getInstance()->getConnection();

        $modulo = $dataBatch['modulo'];
        $controlProducto = $dataBatch['controlProducto'];

        if ($modulo == 3) {
            $controlProducto[9] = 0;
            $controlProducto[10] = 0;
        }

        $sql = "INSERT INTO batch_control_especificaciones (color, olor, apariencia, ph, viscosidad, densidad, untuosidad, espumoso, alcohol, aguja, rpm, modulo, batch) 
                        VALUES(:color, :olor, :apariencia, :ph, :viscosidad, :densidad, :untuosidad, :espumoso, :alcohol, :aguja, :rpm, :modulo, :batch)";
        $query = $connection->prepare($sql);
        $result = $query->execute([
            'color' => $controlProducto[0],
            'olor' => $controlProducto[1],
            'apariencia' => $controlProducto[2],
            'ph' => $controlProducto[3],
            'viscosidad' => $controlProducto[4],
            'densidad' => $controlProducto[5],
            'untuosidad' => $controlProducto[6],
            'espumoso' => $controlProducto[7],
            'alcohol' => $controlProducto[8],
            'aguja' => $controlProducto[9],
            'rpm' => $controlProducto[10],
            'modulo' => $dataBatch['modulo'],
            'batch' => $dataBatch['idBatch'],
        ]);
    }

    public function insertCEspecificacionesByFisicoquimico($dataBatch)
    {
        $connection = Connection::getInstance()->getConnection();

        $sql = "SELECT * FROM `batch_control_especificaciones` WHERE batch = :batch AND modulo = :modulo;";
        $query = $connection->prepare($sql);
        $query->execute(['modulo' => $dataBatch['modulo'], 'batch' => $dataBatch['idBatch']]);
        $rows = $query->rowCount();
        $data = $query->fetchAll($connection::FETCH_ASSOC);

        if ($rows) {
            $ph = 0;
            $densidad = 0;
            $viscosidad = 0;
            $untuosidad = 0;
            $espumoso = 0;
            $alcohol = 0;

            for ($i = 0; $i < sizeof($data); $i++) {
                $ph = $ph + $data[$i]['ph'] / sizeof($data);
                $densidad = $densidad + $data[$i]['densidad'] / sizeof($data);
                $viscosidad = $viscosidad + $data[$i]['viscosidad'] / sizeof($data);
                $untuosidad = $untuosidad + $data[$i]['untuosidad'] / sizeof($data);
                $espumoso = $espumoso + $data[$i]['espumoso'] / sizeof($data);
                $alcohol = $alcohol + $data[$i]['alcohol'] / sizeof($data);
            }

            $sql = "INSERT INTO batch_control_especificaciones (color, olor, apariencia, ph, viscosidad, densidad, untuosidad, espumoso, alcohol, modulo, batch) 
                        VALUES(:color, :olor, :apariencia, :ph, :viscosidad, :densidad, :untuosidad, :espumoso, :alcohol, :modulo, :batch)";
            $query = $connection->prepare($sql);
            $query->execute([
                'color' => $data[0]['color'],
                'olor' => $data[0]['olor'],
                'apariencia' => $data[0]['apariencia'],
                'ph' => $ph,
                'viscosidad' => $viscosidad,
                'densidad' => $densidad,
                'untuosidad' => $untuosidad,
                'espumoso' => $espumoso,
                'alcohol' => $alcohol,
                'modulo' => 9,
                'batch' => $dataBatch['idBatch']
            ]);
        }
    }
}
