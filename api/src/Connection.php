<?php

namespace BatchRecord\Dao;

use PDO;
use PDOException;
use Symfony\Component\Dotenv\Dotenv;

/**
 * Class Connection
 * @package BatchRecord\Dao
 * @author Teenus <Teenus-SAS>
 */
class Connection
{
    protected $dbh;
    private static $_instance;

    /**
     * Connection constructor.
     */
    public function __construct()
    {
        $dotenv = new Dotenv();
        $dotenv->load(__DIR__ . '/../environment.env');
        try {
            $host = $_ENV["DB_HOST"];
            $dbname = $_ENV["DB_NAME"];
            $dbport = $_ENV["DB_PORT"];
            $dsn = "mysql:host=$host;port=$dbport;dbname=$dbname;charset=utf8";
            
            // Configuraciones básicas de PDO para estabilidad
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                PDO::ATTR_PERSISTENT => false, // Deshabilitar conexiones persistentes
            ];
            
            $this->dbh = new PDO($dsn, $_ENV["DB_USER"], $_ENV["DB_PASS"], $options);
            $this->dbh->exec('SET NAMES utf8');
        } catch (PDOException $e) {
            // Error de conexión sin logging
            throw new PDOException("Error de conexión a la base de datos: " . $e->getMessage());
        }
    }

    /*
	Get an instance of the Database
	@return Instance
	*/
    public static function getInstance()
    {
        if (!self::$_instance) { // If no instance then make one
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    // Magic method clone is empty to prevent duplication of connection
    private function __clone()
    {
    }

    // Get mysqli connection
    public function getConnection()
    {
        return $this->dbh;
    }
}
