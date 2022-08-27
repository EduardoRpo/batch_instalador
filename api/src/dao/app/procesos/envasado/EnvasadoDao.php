<?php


namespace BatchRecord\dao;


use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class EnvasadoDao
{


  private $logger;

  public function __construct()
  {
    $this->logger = new Logger(self::class);
    $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
  }

  public function findAllEnvase($ref)
  {
    $connection = Connection::getInstance()->getConnection();
    $stmt = $connection->prepare("SELECT env.id as id_envase, env.nombre as envase, tap.id as id_tapa, tap.nombre as tapa, 
                                          eti.id as id_etiqueta, eti.nombre as etiqueta, emp.id as id_empaque, emp.nombre as empaque, 
                                          otr.id as id_otros, otr.nombre as otros, p.unidad_empaque 
                                  FROM producto p 
                                  INNER JOIN envase env ON p.id_envase = env.id 
                                  INNER JOIN tapa tap ON p.id_tapa = tap.id 
                                  INNER JOIN etiqueta eti ON p.id_etiqueta = eti.id 
                                  INNER JOIN empaque emp ON p.id_empaque = emp.id 
                                  INNER JOIN otros otr ON p.id_otros = otr.id 
                                  WHERE p.referencia = :ref;");
    $stmt->execute(['ref' => $ref]);
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $insumos = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("insumos Obtenidos", array('insumos' => $insumos));
    return $insumos;
  }


  public function findAllEntregasParciales($data)
  {
    /* Busca parciales */
    $connection = Connection::getInstance()->getConnection();
    $stmt = $connection->prepare("SELECT * FROM batch_conciliacion_parciales WHERE batch = :batch AND modulo = 5 AND ref_multi = :ref");
    $stmt->execute(['batch' => $data['batch'], 'ref' => $data['referencia']]);
    $entregasParciales = $stmt->fetchAll($connection::FETCH_ASSOC);

    /* Busca totales */
    $stmt = $connection->prepare("SELECT * FROM batch_conciliacion_rendimiento WHERE batch = :batch AND modulo = 5 AND ref_multi = :ref");
    $stmt->execute(['batch' => $data['batch'], 'ref' => $data['referencia']]);
    $entregasTotales = $stmt->fetchAll($connection::FETCH_ASSOC);

    /* Consolida parciales */
    $parciales = 0;
    for ($i = 0; $i < sizeof($entregasParciales); $i++)
      $parciales = $parciales + $entregasParciales[$i]['unidades'];

    /* Consolida totales */
    if (sizeof($entregasTotales) == 0)
      $total = 0;
    else
      $total = $entregasTotales[0]['unidades_producidas'];

    /* Compara info parciales y totales */
    if ($parciales != 0) {
      if ($parciales == $total)
        $resp = array('success' => true, 'message' => 'total', 'unidades' => $parciales);
      else
        $resp = array('success' => true, 'message' => 'parcial', 'unidades' => $parciales);
    } else
      $resp = array('success' => true, 'message' => 'parcial', 'unidades' => $parciales);

    $this->logger->notice("entregasParciales Obtenidos", array('entregas Parciales' => $entregasParciales));
    return $resp;
  }


  public function saveEntregasParciales($entregaparcial)
  {
    $connection = Connection::getInstance()->getConnection();
    $stmt = $connection->prepare("INSERT INTO batch_conciliacion_parciales(unidades, modulo, batch, ref_multi)
                                    VALUES (:unidades, :modulo, :batch, :ref_multi)");
    $stmt->execute([
      'unidades' => $entregaparcial['unidadesEnv'],
      'modulo' => $entregaparcial['modulo'],
      'batch' => $entregaparcial['idBatch'],
      'ref_multi' => $entregaparcial['referencia']
    ]);

    $stmt = $connection->prepare("SELECT * FROM batch_conciliacion_parciales
                                  WHERE modulo = :modulo AND batch = :batch AND ref_multi = :ref_multi");
    $stmt->execute([
      'modulo' => $entregaparcial['modulo'],
      'batch' => $entregaparcial['idBatch'],
      'ref_multi' => $entregaparcial['referencia']
    ]);
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $entregas = $stmt->fetchAll($connection::FETCH_ASSOC);

    $parciales = 0;
    for ($i = 0; $i < sizeof($entregas); $i++) {
      $parciales = $parciales + $entregas[$i]['unidades'];
    }

    $this->logger->notice("entregas Obtenidas", array('entregas' => $entregas));
    return $parciales;
  }

  public function saveEntregasTotales($entregaTotal)
  {
    $connection = Connection::getInstance()->getConnection();

    $stmt = $connection->prepare("SELECT * FROM batch_conciliacion_parciales 
                                  WHERE modulo = :modulo AND batch = :batch AND ref_multi = :ref_multi");
    $stmt->execute([
      'modulo' => $entregaTotal['modulo'],
      'batch' => $entregaTotal['idBatch'],
      'ref_multi' => $entregaTotal['referencia']
    ]);
    $resp = $stmt->fetchAll($connection::FETCH_ASSOC);

    $parciales = 0;
    for ($i = 0; $i < sizeof($resp); $i++) {
      $parciales = $parciales + $resp[$i]['unidades'];
    }

    $stmt = $connection->prepare("INSERT INTO batch_conciliacion_parciales(unidades, modulo, batch, ref_multi)
                                    VALUES (:unidades, :modulo, :batch, :ref_multi)");
    $stmt->execute([
      'unidades' => $entregaTotal['unidadesEnv'],
      'modulo' => $entregaTotal['modulo'],
      'batch' => $entregaTotal['idBatch'],
      'ref_multi' => $entregaTotal['referencia']
    ]);

    $stmt = $connection->prepare("INSERT INTO batch_conciliacion_rendimiento(unidades_producidas, modulo, batch, ref_multi)
                                    VALUES (:unidades_producidas, :modulo, :batch, :ref_multi)");
    $stmt->execute([
      'unidades_producidas' => $entregaTotal['unidadesEnv'] + $parciales,
      'modulo' => $entregaTotal['modulo'],
      'batch' => $entregaTotal['idBatch'],
      'ref_multi' => $entregaTotal['referencia']
    ]);

    return $entregaTotal['unidadesEnv'] + $parciales;
  }
}
