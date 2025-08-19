<?php


//use BatchRecord\Dao\Connection;
/*
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request; */

use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';
include_once __DIR__ . '/AutoloaderSourceCode.php';

// Incluir la clase Constants
require_once __DIR__ . '/src/constants/Constants.php';

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
require_once __DIR__ . '/src/routes/admin/auditory/capacidadEnvasado.php';
require_once __DIR__ . '/src/routes/admin/auditory/capacidadFirmas.php';
require_once __DIR__ . '/src/routes/admin/auditory/auditoriaFirmas.php';


require_once __DIR__ . '/src/routes/admin/productos/Generales/nombresProductos.php';
require_once __DIR__ . '/src/routes/admin/productos/Generales/notifiSanitaria.php';
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

require_once __DIR__ . '/src/routes/admin/productos/RawMaterial/materiaPrima.php';
require_once __DIR__ . '/src/routes/admin/productos/formulas/formulas.php';

require_once __DIR__ . '/src/routes/admin/productos/instructive/baseInstructive.php';
require_once __DIR__ . '/src/routes/admin/productos/instructive/instructivos.php';

require_once __DIR__ . '/src/routes/admin/productos/multiP.php';
require_once __DIR__ . '/src/routes/admin/productos/productos.php';
require_once __DIR__ . '/src/routes/admin/pdf/certificados.php';
require_once __DIR__ . '/src/routes/admin/pdf/versiones.php';

require_once __DIR__ . '/src/routes/admin/global/selector.php';

require_once __DIR__ . '/src/routes/admin/usuarios/usuarios.php';
require_once __DIR__ . '/src/routes/admin/usuarios/cargos.php';

/* App */

require_once __DIR__ . '/src/routes/app/productos/granel.php';
require_once __DIR__ . '/src/routes/app/productos/productos.php';

//prebatch
require_once __DIR__ . '/src/routes/app/preBatch/preBatch.php';
require_once __DIR__ . '/src/routes/app/preBatch/importarPedidos.php';
require_once __DIR__ . '/src/routes/app/preBatch/pedidosSinReferencia.php';

//Batch
//require_once __DIR__ . '/src/routes/batch.php';
require_once __DIR__ . '/src/routes/app/batch/batch.php';
require_once __DIR__ . '/src/routes/app/batch/clonebatch.php';
require_once __DIR__ . '/src/routes/app/batch/planeacion.php';
require_once __DIR__ . '/src/routes/app/colas/colasTrabajo.php';

//Batch_Tanques
require_once __DIR__ . '/src/routes/app/batchTanques/batchTanques.php';

//Multipresentacion
require_once __DIR__ . '/src/routes/app/multi/multi.php';
require_once __DIR__ . '/src/routes/app/multi/calcTamanioLote.php';
require_once __DIR__ . '/src/routes/app/multi/calcTamanioLoteSimple.php';
require_once __DIR__ . '/src/routes/app/multi/testSimple.php';

//Observaciones
require_once __DIR__ . '/src/routes/app/observaciones/observaciones.php';

//require_once __DIR__ . '/src/routes/cargo.php';
require_once __DIR__ . '/src/routes/app/global/granel.php';
require_once __DIR__ . '/src/routes/app/global/preguntas.php';
require_once __DIR__ . '/src/routes/app/global/desinfectante.php';
require_once __DIR__ . '/src/routes/app/global/materias_primas.php';
require_once __DIR__ . '/src/routes/app/global/etiquetas.php';
require_once __DIR__ . '/src/routes/app/global/firmas.php';
require_once __DIR__ . '/src/routes/app/global/autenticacion.php';
require_once __DIR__ . '/src/routes/app/global/validacionesCierre.php';
require_once __DIR__ . '/src/routes/app/global/muestras.php';
require_once __DIR__ . '/src/routes/app/global/conciliacion.php';

//Pesaje
require_once __DIR__ . '/src/routes/app/pesaje/cargos.php';
require_once __DIR__ . '/src/routes/app/pesaje/pesaje.php';

//Preparacion

//envasado
require_once __DIR__ . '/src/routes/app/envasado/envasado.php';
require_once __DIR__ . '/src/routes/app/envasado/entregasParciales.php';
require_once __DIR__ . '/src/routes/app/envasado/equipos.php';

//programacion envasado
require_once __DIR__ . '/src/routes/app/programacion_envasado/gestionEnvasado.php';
require_once __DIR__ . '/src/routes/app/programacion_envasado/programacion_envasado.php';

//Explosion de Materiales
require_once __DIR__ . '/src/routes/app/explosionMateriales/explosion_materiales.php';
require_once __DIR__ . '/src/routes/app/explosionMateriales/pedidos.php';
require_once __DIR__ . '/src/routes/app/explosionMateriales/planPrePlaneados.php';

// Libreacion
require_once __DIR__ . '/src/routes/app/liberacion/liberacion.php';

/* pdf */
require_once __DIR__ . '/src/routes/app/pdf/pdf.php';
require_once __DIR__ . '/src/routes/app/pdf/exportDataBatch.php';

/* Modulos */
require_once __DIR__ . '/src/routes/app/process/micro/micro.php';
require_once __DIR__ . '/src/routes/app/process/despachos/despachos.php';

/* Users */
require_once __DIR__ . '/src/routes/app/usuarios/usuarios.php';

// Ruta directa para cálculo de lote simplificado
$app->post('/api/calcLoteDirecto', function (Request $request, Response $response) {
    try {
        // Configuración directa de base de datos
        $host = '172.17.0.1';
        $port = '3307';
        $dbname = 'batch_record';
        $username = 'root';
        $password = 'S@m4r@_2025!';
        
        // Conexión directa PDO
        $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8";
        $pdo = new PDO($dsn, $username, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);
        
        // Obtener datos del request
        $data = $request->getParsedBody();
        $referencia = $data['referencia'] ?? 'M-20966';
        
        // Consulta directa
        $sql = "SELECT p.referencia, p.densidad_producto as densidad, linea.ajuste, pc.nombre as presentacion
                FROM producto p
                INNER JOIN linea ON p.id_linea = linea.id
                INNER JOIN presentacion_comercial pc ON p.presentacion_comercial = pc.id
                WHERE p.referencia = :referencia";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['referencia' => $referencia]);
        $productData = $stmt->fetch();
        
        if (!$productData) {
            return $response->withJson([
                'success' => false,
                'message' => 'Producto no encontrado',
                'referencia' => $referencia
            ], 404);
        }
        
        // Cálculo básico
        $densidad = floatval($productData['densidad']);
        $ajuste = floatval($productData['ajuste']);
        $presentacion = $productData['presentacion'];
        $tamanioLote = $densidad * $ajuste * 1000;
        
        // Respuesta
        $resultado = [
            'success' => true,
            'producto' => [
                'referencia' => $referencia,
                'densidad' => $densidad,
                'ajuste' => $ajuste,
                'presentacion' => $presentacion
            ],
            'calculo' => [
                'tamanio_lote' => round($tamanioLote, 2),
                'unidad' => 'kg'
            ],
            'pedidosLotes' => [
                [
                    'pedido' => 'TEST-001',
                    'referencia' => $referencia,
                    'tamanio_lote' => round($tamanioLote, 2),
                    'estado' => 'calculado'
                ]
            ]
        ];
        
        return $response->withJson($resultado);
        
    } catch (PDOException $e) {
        return $response->withJson([
            'success' => false,
            'message' => 'Error de base de datos: ' . $e->getMessage(),
            'error_code' => $e->getCode()
        ], 500);
        
    } catch (Exception $e) {
        return $response->withJson([
            'success' => false,
            'message' => 'Error general: ' . $e->getMessage()
        ], 500);
    }
});

// Run app
$app->run();
