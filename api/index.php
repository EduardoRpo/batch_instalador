<?php


//use BatchRecord\Dao\Connection;
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
//require_once __DIR__ . '/src/routes/admin/preparacion/Instructivos.php';
require_once __DIR__ . '/src/routes/admin/pdf/certificados.php';
require_once __DIR__ . '/src/routes/admin/pdf/versiones.php';


/* App */

require_once __DIR__ . '/src/routes/app/productos/granel.php';
require_once __DIR__ . '/src/routes/app/productos/productos.php';

//prebatch
require_once __DIR__ . '/src/routes/app/preBatch/preBatch.php';
require_once __DIR__ . '/src/routes/app/preBatch/importarPedidos.php';

//Batch
//require_once __DIR__ . '/src/routes/batch.php';
require_once __DIR__ . '/src/routes/app/batch/batch.php';
require_once __DIR__ . '/src/routes/app/batch/clonebatch.php';
require_once __DIR__ . '/src/routes/app/colas/colasTrabajo.php';

//Multipresentacion
require_once __DIR__ . '/src/routes/app/multi/multi.php';
require_once __DIR__ . '/src/routes/app/multi/calcTamanioLote.php';

//require_once __DIR__ . '/src/routes/cargo.php';
require_once __DIR__ . '/src/routes/app/global/preguntas.php';
require_once __DIR__ . '/src/routes/app/global/desinfectante.php';
require_once __DIR__ . '/src/routes/app/global/materias_primas.php';
require_once __DIR__ . '/src/routes/app/global/etiquetas.php';

//Pesaje
require_once __DIR__ . '/src/routes/app/pesaje/pesaje.php';

//Preparacion
require_once __DIR__ . '/src/routes/app/preparacion/preparacion.php';

//envasado
require_once __DIR__ . '/src/routes/app/envasado/envasado.php';
require_once __DIR__ . '/src/routes/app/envasado/equipos.php';

//Explosion de Materiales
require_once __DIR__ . '/src/routes/app/explosionMateriales/explosion_materiales.php';
require_once __DIR__ . '/src/routes/app/explosionMateriales/pedidos.php';

/* pdf */
require_once __DIR__ . '/src/routes/app/pdf.php';


require_once __DIR__ . '/src/routes/app/usuarios.php';


// Run app
$app->run();
