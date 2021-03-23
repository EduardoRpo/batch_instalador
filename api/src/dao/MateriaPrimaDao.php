<?php


  namespace BatchRecord\dao;


  use BatchRecord\Constants\Constants;
  use Monolog\Handler\RotatingFileHandler;
  use Monolog\Logger;

  /**
   * Class MateriaPrimaDao
   * @package BatchRecord\dao
   * @author Teenus <Teenus-SAS>
   */
  
   class MateriaPrimaDao
  {
    private $logger;

    public function __construct()
    {
      $this->logger = new Logger(self::class);
      $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20,Logger::DEBUG));
    }

    public function findByProduct($idProduct)
    {
      $connection = Connection::getInstance()->getConnection();
      //$stmt = $connection->prepare("SELECT * FROM formula INNER JOIN materia_prima ON formula.id_materiaprima = materia_prima.referencia WHERE formula.id_producto = :referencia");
      $stmt = $connection->prepare("SELECT f.id, mp.referencia, mp.alias, cast(AES_DECRYPT(porcentaje, 'Wf[Ht^}2YL=D^DPD') as char)porcentaje FROM formula f INNER JOIN materia_prima mp ON f.id_materiaprima = mp.referencia WHERE f.id_producto =:referencia");
      $stmt->execute(array('referencia'=> $idProduct));
      $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
      $pesajes = $stmt->fetchAll($connection::FETCH_ASSOC);
      $this->logger->notice("materia Primas Obtenidas", array('materias Primas' => $pesajes));
      return $pesajes;
    }
  }