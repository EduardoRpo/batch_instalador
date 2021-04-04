<?php


  namespace BatchRecord\Dao;

  use BatchRecord\Constants\Constants;
  use Monolog\Handler\RotatingFileHandler;
  use Monolog\Handler\StreamHandler;
  use Monolog\Logger;

  /**
   * Class ProductDao
   * @package BatchRecord\Dao
   * @author Teenus <Teenus-SAS>
   */
  class ProductDao
  {
    private $logger;

    public function __construct()
    {
      $this->logger = new Logger(self::class);
      $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20,Logger::DEBUG));
    }

    public function findAll()
    {
      $connection = Connection::getInstance()->getConnection();
      $stmt = $connection->prepare("SELECT * FROM producto WHERE ?");
      $stmt->execute(array(1));
      $products = $stmt->fetchAll($connection::FETCH_ASSOC);
      $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
      return $products;
    }

    public function findDetailsByProduct($idProduct)
    {
      $connection = Connection::getInstance()->getConnection();
      $stmt = $connection->prepare("SELECT producto.referencia, producto.nombre_referencia,
      color.nombre as color, olor.nombre as olor, apariencia.nombre as apariencia,
      viscosidad.limite_inferior as limite_inferior_viscosidad ,
      viscosidad.limite_superior as limite_superior_viscosidad,
      densidad_gravedad.limite_inferior as limite_inferior_densidad_gravedad,
      densidad_gravedad.limite_superior as limite_superior_densidad_gravedad,
      untuosidad.nombre as untuosidad, 
      poder_espumoso.nombre as poder_espumoso,
      grado_alcohol.limite_inferior as limite_inferior_grado_alcohol,
      grado_alcohol.limite_superior as limite_superior_grado_alcohol,
      ph.limite_inferior as limite_inferior_ph,
      ph.limite_superior as limite_superior_ph
      FROM producto
      LEFT JOIN olor ON olor.id = producto.id_olor
      LEFT JOIN color ON color.id = producto.id_color
      LEFT JOIN apariencia ON apariencia.id = producto.id_apariencia
      LEFT JOIN ph ON ph.id = producto.id_ph
      LEFT JOIN viscosidad ON viscosidad.id = producto.id_viscosidad
      LEFT JOIN densidad_gravedad ON densidad_gravedad.id = producto.id_densidad_gravedad
      LEFT JOIN untuosidad ON untuosidad.id = producto.id_untuosidad
      LEFT JOIN poder_espumoso ON poder_espumoso.id = producto.id_poder_espumoso
      LEFT JOIN grado_alcohol ON grado_alcohol.id = producto.id_grado_alcohol
      WHERE producto.referencia = ?");
      $stmt->execute(array($idProduct));
      $products = $stmt->fetch($connection::FETCH_ASSOC);
      $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
      return $products;
    }
  }