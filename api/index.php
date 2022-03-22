<?php


use BatchRecord\Dao\Connection;
/*
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request; */
use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';
include_once __DIR__ . '/AutoloaderSourceCode.php';

$app = AppFactory::create();
$app->setBasePath('/api');

// Add Routing Middleware
$app->addRoutingMiddleware();
$errorMiddleware = $app->addErrorMiddleware(true, true, true);


// Define app routes

/* Admin */
require_once __DIR__ . '/src/routes/admin/productos.php';

/* App */
require_once __DIR__ . '/src/routes/batch.php';
require_once __DIR__ . '/src/routes/colasTrabajo.php';
require_once __DIR__ . '/src/routes/multipresentacion.php';

require_once __DIR__ . '/src/routes/cargo.php';
require_once __DIR__ . '/src/routes/preguntas.php';
require_once __DIR__ . '/src/routes/desinfectante.php';
require_once __DIR__ . '/src/routes/materias_primas.php';
require_once __DIR__ . '/src/routes/equipos.php';
require_once __DIR__ . '/src/routes/etiquetas.php';
require_once __DIR__ . '/src/routes/pdf.php';

require_once __DIR__ . '/src/routes/pesaje.php';
require_once __DIR__ . '/src/routes/preparacion.php';
require_once __DIR__ . '/src/routes/envasado.php';

require_once __DIR__ . '/src/routes/explosion_materiales.php';
require_once __DIR__ . '/src/routes/pedidos.php';

require_once __DIR__ . '/src/routes/productos.php';
require_once __DIR__ . '/src/routes/usuarios.php';


// Run app
$app->run();
