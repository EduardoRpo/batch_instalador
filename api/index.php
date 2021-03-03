<?php

//use BatchRecord\dao\AgitadorDao;
use BatchRecord\dao\BatchDao;
use BatchRecord\dao\CargoDao;
use BatchRecord\Dao\Connection;
use BatchRecord\dao\DesinfectanteDao;
use BatchRecord\dao\IntructivoPreparacionDao;
//use BatchRecord\dao\MarmitaDao;
use BatchRecord\dao\EquipoDao;
use BatchRecord\dao\MateriaPrimaDao;
use BatchRecord\Dao\PesajeDao;
use BatchRecord\dao\PreguntaDao;
use BatchRecord\Dao\ProductDao;
use BatchRecord\dao\UserDao;
use BatchRecord\dao\ControlProcesoDao;
use BatchRecord\dao\PedidosDao;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';
include_once __DIR__ . '/AutoloaderSourceCode.php';

/* variables */

$productDao = new ProductDao();
$pesajeDao = new PesajeDao();
$batchDao = new BatchDao();
$preguntaDao = new PreguntaDao();
$desinfectanteDao = new DesinfectanteDao();
$materiaPrimaDao = new MateriaPrimaDao();
$cargoDao = new CargoDao();
//$agitadorDAo = new AgitadorDao();
$equipoDao = new EquipoDao();
//$marmitaDao = new MarmitaDao();
$instructivoPreparacionDao = new IntructivoPreparacionDao();
$userDao = new UserDao();
$controlProcesoDao = new ControlProcesoDao();
$pedidosDao = new PedidosDao();

$app = AppFactory::create();
$app->setBasePath('/api');

// Add Routing Middleware
$app->addRoutingMiddleware();

$errorMiddleware = $app->addErrorMiddleware(true, true, true);


// Define app routes
/* $app->get('/', function (Request $request, Response $response, $args) {
  $connection = Connection::getInstance()->getConnection();
  $response->getBody()->write("hello world");
  return $response;
}); */

$app->get('/products', function (Request $request, Response $response, $args) use ($productDao) {
  $products = $productDao->findAll();
  $response->getBody()->write(json_encode($products), JSON_NUMERIC_CHECK);
  return $response;
});

$app->get('/productsDetails/{idProducto}', function (Request $request, Response $response, $args) use ($productDao) {
  $products = $productDao->findDetailsByProduct($args["idProducto"]);
  $response->getBody()->write(json_encode($products), JSON_NUMERIC_CHECK);
  return $response->withHeader('Content-Type', 'application/json');
  return $response;
});

$app->get('/pesajes', function (Request $request, Response $response, $args) use ($pesajeDao) {
  $pesajes = $pesajeDao->findAll();
  $response->getBody()->write(json_encode($pesajes, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/batch/{id}', function (Request $request, Response $response, $args) use ($batchDao) {
  $batch = $batchDao->findById($args["id"]);
  $response->getBody()->write(json_encode($batch, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/batch', function (Request $request, Response $response, $args) use ($batchDao) {
  $batch = $batchDao->findAll();
  $response->getBody()->write(json_encode($batch, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/clonebatch', function (Request $request, Response $response, $args) use ($batchDao) {
  $requestBody = json_decode($request->getBody(), true);
  $batch = $batchDao->findById($requestBody['idbatch']);
  //$batch["unidad_lote"] = $requestBody['unidades'];
  $duplicates = $requestBody['cantidad'];
  for ($i = 0; $i < $duplicates; $i++) {
    $rows = $batchDao->save($batch);
  }
  $resp = array('success' => ($rows > 0));
  $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/questions', function (Request $request, Response $response, $args) use ($preguntaDao) {
  $array = $preguntaDao->findAll();
  //$batch = utf8_string_array_encode($array);
  $batch = utf8_encode($array);
  if ($batch == null) {
    $response->getBody()->write('');
  } else {
    $response->getBody()->write(json_encode($batch));
  }
  return $response->withHeader('Content-Type', 'application/json');
});
// preguntas por modulo
$app->get('/questions/{idModule}', function (Request $request, Response $response, $args) use ($preguntaDao) {
  $array = $preguntaDao->findByModule($args["idModule"]);
  $response->getBody()->write(json_encode($array));

  return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/desinfectantes', function (Request $request, Response $response, $args) use ($desinfectanteDao) {
  $batch = $desinfectanteDao->findAll();
  $response->getBody()->write(json_encode($batch, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/materiasp/{idProduct}', function (Request $request, Response $response, $args) use ($materiaPrimaDao) {
  $batch = $materiaPrimaDao->findByProduct($args["idProduct"]);
  $response->getBody()->write(json_encode($batch, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/cargos', function (Request $request, Response $response, $args) use ($cargoDao) {
  $batch = $cargoDao->findAll();
  $response->getBody()->write(json_encode($batch, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});


$app->get('/equipos', function (Request $request, Response $response, $args) use ($equipoDao) {
  $equipos = $equipoDao->findAll();
  $response->getBody()->write(json_encode($equipos, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/equipos/{idBatch}', function (Request $request, Response $response, $args) use ($equipoDao) {
  $array = $equipoDao->findByBatch($args["idBatch"]);
  $response->getBody()->write(json_encode($array));

  return $response->withHeader('Content-Type', 'application/json');
});

/* $app->get('/loteadoras', function (Request $request, Response $response, $args) use ($marmitaDao) {
    $batch = $marmitaDao->findAll();
    $response->getBody()->write(json_encode($batch, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
  }); */

$app->get('/instructivos/{idProducto}', function (Request $request, Response $response, $args) use ($instructivoPreparacionDao) {
  $batch = $instructivoPreparacionDao->findByProduct($args["idProducto"]);
  $response->getBody()->write(json_encode($batch, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/user', function (Request $request, Response $response, $args) use ($userDao) {
  $parsedBody = json_decode($request->getBody(), true);
  $email = $parsedBody["email"];
  $password = $parsedBody["password"];
  $user = $userDao->findByEmail($email);

  $resp = array();
  if ($user != null) {
    if ($password === $user["password"]) {
      $user["firma"] = base64_encode($user["firma"]);
      $user["huella"] = base64_encode($user["huella"]);
      $response->getBody()->write(json_encode($user));
      return $response->withStatus(200)->withHeader('Content-Type', 'application/json');
    } else {
      $resp = array('error' => true, 'message' => 'Contraseña Invalida');
      $response->getBody()->write(json_encode($resp));
      return $response->withStatus(401)->withHeader('Content-Type', 'application/json');
    }
  } else {
    $resp = array('error' => true, 'message' => 'Usuario no Existe');
    $response->getBody()->write(json_encode($resp));
    return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
  }
});

$app->get('/controlproceso', function (Request $request, Response $response, $args) use ($controlProcesoDao) {
  $array = $controlProcesoDao->findAll();
  $response->getBody()->write(json_encode($array));

  return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/controlproceso/{idBatch}', function (Request $request, Response $response, $args) use ($controlProcesoDao) {
  $array = $controlProcesoDao->findByBatch($args["idBatch"]);
  $response->getBody()->write(json_encode($array));

  return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/pedidos', function (Request $request, Response $response, $args) use ($pedidosDao) {
  $array = $pedidosDao->findAll();
  $response->getBody()->write(json_encode($array));

  return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/pedidos/{idPedido}', function (Request $request, Response $response, $args) use ($pedidosDao) {
  $array = $pedidosDao->findByOrder($args["idPedido"]);
  $response->getBody()->write(json_encode($array));

  return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/pedidos/nuevos', function (Request $request, Response $response, $args)  use ($pedidosDao) {
  /* $data = file_get_contents('../pedidos.txt'); */
  $data = file_get_contents('../html/pedidos/pedidos.txt');
  $array = $pedidosDao->save($data);
  $response->getBody()->write(json_encode($array));
  
  return $response->withHeader('Content-Type', 'application/json');
});

// Run app
$app->run();
