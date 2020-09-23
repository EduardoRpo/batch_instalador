<?php


  class Router
  {
    protected $requestUri;
    protected $routes;
    public static $basePath;

    const GET_PARAMS_DELIMITER = '?';

    public function __construct($requestUri)
    {
      $this->routes = [];

      $this->setRequestUri($requestUri);
      self::$basePath = '';
    }

    public function setBasePath($path)
    {
      self::$basePath = $path;
    }

    public function setRequestUri($requestUri)
    {
      if (strpos(self::$basePath . $requestUri, self::GET_PARAMS_DELIMITER)) {
        $requestUri = strstr(self::$basePath . $requestUri, self::GET_PARAMS_DELIMITER, true);
      }
      $this->requestUri = $requestUri;
    }

    public function getRequestUri()
    {
      return $this->requestUri;
    }

    public function add($uri, $closure)
    {
      $route = new Route($uri, $closure);
      array_push($this->routes, $route);
    }

    public function run()
    {
      $response = false;
      $requestUri = $this->getRequestUri();

      foreach ($this->routes as $route) {
        if ($route->checkIfMatch($requestUri)) {
          $response = $route->execute();
          // break para no seguir dando vueltas
          // Ya se encontró la ruta correspondiente
          break;
        }
      }

      $this->sendResponse($response);
    }

    public function sendResponse($response)
    {
      if (is_string($response)) {
        echo $response;
      } else if (is_array($response)) {
        echo json_encode($response);
      } else if ($response instanceof Response) {
        $response->execute();
      } else {
        header("HTTP/1.0 404 Not Found");
        exit('404');
      }
    }

    public static function getRenderedHTML($path)
    {
      ob_start();
      include($path);
      $var = ob_get_contents();
      ob_end_clean();
      return $var;

    }
  }