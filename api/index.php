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
require_once __DIR__ . '/src/routes/admin/generalParameters/tanks.php';
require_once __DIR__ . '/src/routes/admin/generalParameters/lineClearance.php';
require_once __DIR__ . '/src/routes/admin/generalParameters/questions.php';
require_once __DIR__ . '/src/routes/admin/generalParameters/modules.php';
require_once __DIR__ . '/src/routes/admin/generalParameters/conditions.php';
require_once __DIR__ . '/src/routes/admin/generalParameters/disinfectant.php';
require_once __DIR__ . '/src/routes/admin/generalParameters/equipments.php';

require_once __DIR__ . '/src/routes/admin/productos/generales/nombresProductos.php';
require_once __DIR__ . '/src/routes/admin/productos/generales/notifiSanitaria.php';
require_once __DIR__ . '/src/routes/admin/productos/Generales/linea.php';
require_once __DIR__ . '/src/routes/admin/productos/Generales/marca.php';
require_once __DIR__ . '/src/routes/admin/productos/Generales/propietario.php';
require_once __DIR__ . '/src/routes/admin/productos/Generales/presentaciones.php';

require_once __DIR__ . '/src/routes/admin/productos/propiedadesFisicoquimicas/Apariencia.php';
require_once __DIR__ . '/src/routes/admin/productos/propiedadesFisicoquimicas/Color.php';
require_once __DIR__ . '/src/routes/admin/productos/propiedadesFisicoquimicas/Olor.php';
require_once __DIR__ . '/src/routes/admin/productos/propiedadesFisicoquimicas/Densidad.php';
require_once __DIR__ . '/src/routes/admin/productos/propiedadesFisicoquimicas/GradoAlcohol.php';
require_once __DIR__ . '/src/routes/admin/productos/propiedadesFisicoquimicas/ph.php';
require_once __DIR__ . '/src/routes/admin/productos/propiedadesFisicoquimicas/untuosidad.php';
require_once __DIR__ . '/src/routes/admin/productos/propiedadesFisicoquimicas/Viscosidad.php';
require_once __DIR__ . '/src/routes/admin/productos/propiedadesFisicoquimicas/PoderEspumoso.php';

require_once __DIR__ . '/src/routes/admin/productos/PropiedadesMicrobiologicas/recuento.php';
require_once __DIR__ . '/src/routes/admin/productos/PropiedadesMicrobiologicas/pseudomona.php';
require_once __DIR__ . '/src/routes/admin/productos/PropiedadesMicrobiologicas/escherichia.php';
require_once __DIR__ . '/src/routes/admin/productos/PropiedadesMicrobiologicas/staphylococcus.php';

require_once __DIR__ . '/src/routes/admin/productos/Packaging/tapa.php';
require_once __DIR__ . '/src/routes/admin/productos/Packaging/envases.php';
require_once __DIR__ . '/src/routes/admin/productos/Packaging/etiqueta.php';
require_once __DIR__ . '/src/routes/admin/productos/Packaging/caja.php';
require_once __DIR__ . '/src/routes/admin/productos/Packaging/otros.php';

require_once __DIR__ . '/src/routes/admin/productos/multiP.php';
require_once __DIR__ . '/src/routes/admin/productos/productos.php';
require_once __DIR__ . '/src/routes/admin/productos/instructivos.php';
require_once __DIR__ . '/src/routes/admin/pdf/certificados.php';
require_once __DIR__ . '/src/routes/admin/pdf/versiones.php';

require_once __DIR__ . '/src/routes/admin/global/selector.php';

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

//Batch_Tanques
require_once __DIR__ . '/src/routes/app/batchTanques/batchTanques.php';

//Multipresentacion
require_once __DIR__ . '/src/routes/app/multi/multi.php';
require_once __DIR__ . '/src/routes/app/multi/calcTamanioLote.php';

//Observaciones
require_once __DIR__ . '/src/routes/app/observaciones/observacionesInactivos.php';

//require_once __DIR__ . '/src/routes/cargo.php';
require_once __DIR__ . '/src/routes/app/global/granel.php';
require_once __DIR__ . '/src/routes/app/global/preguntas.php';
require_once __DIR__ . '/src/routes/app/global/desinfectante.php';
require_once __DIR__ . '/src/routes/app/global/materias_primas.php';
require_once __DIR__ . '/src/routes/app/global/etiquetas.php';
require_once __DIR__ . '/src/routes/app/global/autenticacion.php';

//Pesaje
require_once __DIR__ . '/src/routes/app/pesaje/cargos.php';
require_once __DIR__ . '/src/routes/app/pesaje/pesaje.php';

//Preparacion

//envasado
require_once __DIR__ . '/src/routes/app/envasado/envasado.php';
require_once __DIR__ . '/src/routes/app/envasado/equipos.php';

//Explosion de Materiales
require_once __DIR__ . '/src/routes/app/explosionMateriales/explosion_materiales.php';
require_once __DIR__ . '/src/routes/app/explosionMateriales/pedidos.php';

/* pdf */
require_once __DIR__ . '/src/routes/app/pdf/pdf.php';

/* Microbiologia */
require_once __DIR__ . '/src/routes/app/process/micro/micro.php';

/* Users */
require_once __DIR__ . '/src/routes/app/usuarios/usuarios.php';



// Run app
$app->run();
