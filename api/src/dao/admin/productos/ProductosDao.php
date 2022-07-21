<?php


namespace BatchRecord\dao;


use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class ProductosDao
{


  private $logger;

  public function __construct()
  {
    $this->logger = new Logger(self::class);
    $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
  }

  public function findAllProducts()
  {
    $connection = Connection::getInstance()->getConnection();
    $stmt = $connection->prepare("SELECT * FROM producto");
    $stmt->execute();
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $productos = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("productos Obtenidos", array('productos' => $productos));
    return $productos;
  }

  public function findProductById($referencia)
  {
    $connection = Connection::getInstance()->getConnection();
    $stmt = $connection->prepare("SELECT * FROM producto WHERE referencia = :referencia");
    $stmt->execute(['referencia' => $referencia]);
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $producto = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("producto Obtenido", array('producto' => $producto));
    return $producto;
  }

  public function saveProduct($dataProducto)
  {
    $connection = Connection::getInstance()->getConnection();

    $stmt = "SELECT * FROM producto WHERE referencia =:referencia";
    $query = $connection->prepare($stmt);
    $query->execute(['referencia' => $dataProducto['referencia']]);
    $rows = $query->rowCount();

    if ($rows == 0) {

      $path = '../../html/img/referencias/' . $dataProducto['referencia'] . '.jpg';

      $stmt = $connection->prepare("INSERT INTO producto (referencia, nombre_referencia, unidad_empaque, id_nombre_producto, 
                                              id_notificacion_sanitaria, id_linea, densidad_producto, id_marca, id_propietario, presentacion_comercial, id_color, id_olor, 
                                              id_apariencia, id_untuosidad, id_poder_espumoso, id_recuento_mesofilos, id_pseudomona, id_escherichia, 
                                              id_staphylococcus, id_ph, id_viscosidad, id_densidad_gravedad, id_grado_alcohol, id_envase, id_tapa, id_etiqueta, 
                                              id_empaque, id_otros, base_instructivo, instructivo, img)
                                  VALUES (:referencia, :nombre, :uniEmpaque, :nombre_producto, :notificacion_sanitaria, 
                                              :linea, :densidad_producto, :marca, :propietario, :presentacion_comercial, :color, :olor, :apariencia, 
                                              :untuosidad, :poder_espumoso, :recuento_mesofilos, :pseudomona, :escherichia, :staphylococcus,
                                              :ph, :viscosidad, :densidad_gravedad, :grado_alcohol, :envase, :tapa, :etiqueta, :empaque, :otros,
                                              :bases_instructivo, :instructivo, :img)");
      $stmt->execute([
        'referencia' => $dataProducto['referencia'], 'nombre' => $dataProducto['nombre'], 'uniEmpaque' => $dataProducto['uniEmpaque'], 'nombre_producto' => $dataProducto['nombre_producto'],
        'notificacion_sanitaria' => $dataProducto['notificacion_sanitaria'], 'linea' => $dataProducto['linea'], 'densidad_producto' => $dataProducto['densidad'], 'marca' => $dataProducto['marca'], 'propietario' => $dataProducto['propietario'],
        'presentacion_comercial' => $dataProducto['presentacion_comercial'], 'color' => $dataProducto['color'], 'olor' => $dataProducto['olor'], 'apariencia' => $dataProducto['apariencia'],
        'untuosidad' => $dataProducto['untuosidad'], 'poder_espumoso' => $dataProducto['poder_espumoso'], 'recuento_mesofilos' => $dataProducto['recuento_mesofilos'],
        'pseudomona' => $dataProducto['pseudomona'], 'escherichia' => $dataProducto['escherichia'], 'staphylococcus' => $dataProducto['staphylococcus'], 'ph' => $dataProducto['ph'],
        'viscosidad' => $dataProducto['viscosidad'], 'densidad_gravedad' => $dataProducto['densidad_gravedad'], 'grado_alcohol' => $dataProducto['grado_alcohol'],
        'envase' => $dataProducto['envase'], 'tapa' => $dataProducto['tapa'], 'etiqueta' => $dataProducto['etiqueta'], 'empaque' => $dataProducto['empaque'], 'otros' => $dataProducto['otros'],
        'bases_instructivo' => $dataProducto['bases_instructivo'], 'instructivo' => $dataProducto['instructivo'], 'img' => $path
      ]);
      $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    } else
      return 1;
  }

  public function updateProduct($dataProducto)
  {
    $connection = Connection::getInstance()->getConnection();
    $stmt = $connection->prepare("UPDATE producto SET nombre_referencia =:nombre,  unidad_empaque = :uniEmpaque,  
                                          id_nombre_producto = :nombre_producto, id_notificacion_sanitaria = :notificacion_sanitaria, id_linea = :linea, densidad_producto = :densidad_producto, 
                                          id_marca =:marca, id_propietario =:propietario, presentacion_comercial= :presentacion_comercial, 
                                          id_color =:color, id_olor= :olor, id_apariencia = :apariencia, id_untuosidad=:untuosidad, 
                                          id_poder_espumoso =:poder_espumoso, id_recuento_mesofilos =:recuento_mesofilos, id_pseudomona=:pseudomona, 
                                          id_escherichia =:escherichia, id_staphylococcus=:staphylococcus, id_ph =:ph, id_viscosidad =:viscosidad, 
                                          id_densidad_gravedad =:densidad_gravedad, id_grado_alcohol = :grado_alcohol, id_tapa = :tapa, id_envase = :envase, 
                                          id_etiqueta = :etiqueta, id_empaque =:empaque, id_otros = :otros, base_instructivo = :bases_instructivo, 
                                          instructivo = :instructivo 
                                  WHERE referencia = :id_referencia");
    $stmt->execute([
      'nombre' => $dataProducto['nombre'], 'uniEmpaque' => $dataProducto['uniEmpaque'], 'nombre_producto' => $dataProducto['nombre_producto'],
      'notificacion_sanitaria' => $dataProducto['notificacion_sanitaria'], 'linea' => $dataProducto['linea'], 'densidad_producto' => $dataProducto['densidad'], 'marca' => $dataProducto['marca'], 'propietario' => $dataProducto['propietario'],
      'presentacion_comercial' => $dataProducto['presentacion_comercial'], 'color' => $dataProducto['color'], 'olor' => $dataProducto['olor'], 'apariencia' => $dataProducto['apariencia'],
      'untuosidad' => $dataProducto['untuosidad'], 'poder_espumoso' => $dataProducto['poder_espumoso'], 'recuento_mesofilos' => $dataProducto['recuento_mesofilos'],
      'pseudomona' => $dataProducto['pseudomona'], 'escherichia' => $dataProducto['escherichia'], 'staphylococcus' => $dataProducto['staphylococcus'], 'ph' => $dataProducto['ph'],
      'viscosidad' => $dataProducto['viscosidad'], 'densidad_gravedad' => $dataProducto['densidad_gravedad'], 'grado_alcohol' => $dataProducto['grado_alcohol'],
      'tapa' => $dataProducto['tapa'], 'envase' => $dataProducto['envase'], 'etiqueta' => $dataProducto['etiqueta'], 'empaque' => $dataProducto['empaque'], 'otros' => $dataProducto['otros'],
      'bases_instructivo' => $dataProducto['bases_instructivo'], 'instructivo' => $dataProducto['instructivo'], 'id_referencia' => $dataProducto['referencia']
    ]);
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
  }

  public function deleteProductById($referencia)
  {
    $connection = Connection::getInstance()->getConnection();
    $stmt = $connection->prepare("DELETE FROM producto WHERE referencia = :referencia");
    $stmt->execute(['referencia' => $referencia]);
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $producto = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("producto eliminado", array('producto' => $producto));
    return $producto;
  }

 

  public function findBase()
  {
    $connection = Connection::getInstance()->getConection();
    $stmt = $connection->prepare("SELECT DISTINCT np.id, np.nombre as producto_base 
    FROM instructivos_base ib 
    INNER JOIN nombre_producto np ON np.id = ib.producto");
    $stmt->execute();
    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    $base = $stmt->fetchAll($connection::FETCH_ASSOC);
    $this->logger->notice("bases recuperadas", array('bases' => $base));
    return $base;
  }
}
