<?php


namespace BatchRecord\dao;


use BatchRecord\Constants\Constants;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class ImagenProductoDao
{


  private $logger;

  public function __construct()
  {
    $this->logger = new Logger(self::class);
    $this->logger->pushHandler(new RotatingFileHandler(Constants::LOGS_PATH . 'querys.log', 20, Logger::DEBUG));
  }

  public function loadImageProduct()
  {
    $connection = Connection::getInstance()->getConnection();

    $targetDir = "../../../html/img/referencias/";
    $allowTypes = array('jpg', 'jpeg');

    $images_arr = array();
    foreach ($_FILES['images']['name'] as $key => $val) {

      $image_name = $_FILES['images']['name'][$key];
      $tmp_name   = $_FILES['images']['tmp_name'][$key];
      $size       = $_FILES['images']['size'][$key];
      $type       = $_FILES['images']['type'][$key];
      $error      = $_FILES['images']['error'][$key];
      $targetFilePath = $targetDir . $image_name;
      $referencia = substr($image_name, 0, -4);

      $sql = "SELECT img FROM producto WHERE referencia = :referencia";
      $stmt = $connection->prepare($sql);
      $stmt->execute(['referencia' => $referencia]);
      $rows = $stmt->rowCount();

      if ($rows > 0) {
        $sql = "UPDATE producto SET img = :img WHERE referencia = :referencia";
        $stmt = $connection->prepare($sql);
        $result = $stmt->execute(['referencia' => $referencia, 'img' => $targetFilePath]);

        $fileName = basename($_FILES['images']['name'][$key]);
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        if (in_array($fileType, $allowTypes)) {
          move_uploaded_file($tmp_name, $targetFilePath);
        }
      } else
        echo "false";
    }

    $this->logger->info(__FUNCTION__, array('query' => $stmt->queryString, 'errors' => $stmt->errorInfo()));
    //return $productos;
  }
}
