<?php


//use BatchRecord\Dao\Connection;
/*
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request; */

use Slim\Factory\AppFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require __DIR__ . '/vendor/autoload.php';
include_once __DIR__ . '/AutoloaderSourceCode.php';

// Incluir la clase Constants
require_once __DIR__ . '/src/constants/Constants.php';

$app = AppFactory::create();
$app->setBasePath('/api');

// Add JSON middleware
$app->addBodyParsingMiddleware();
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

// Ruta de prueba simple
$app->get('/test-slim', function (Request $request, Response $response) {
    $data = [
        'success' => true,
        'message' => 'API funcionando correctamente',
        'timestamp' => date('Y-m-d H:i:s')
    ];
    
    $response->getBody()->write(json_encode($data));
    return $response->withHeader('Content-Type', 'application/json');
});

// Ruta OPTIONS para CORS preflight
$app->options('/calc-lote-directo', function (Request $request, Response $response) {
    return $response
        ->withHeader('Access-Control-Allow-Origin', '*')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
        ->withHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization');
});

// Ruta directa para cálculo de lote simplificado
$app->post('/calc-lote-directo', function (Request $request, Response $response) {
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
        $rawBody = $request->getBody()->getContents();
        error_log('🔍 Raw body recibido: ' . $rawBody);
        
        // Si el raw body está vacío, intentar con getParsedBody
        if (empty($rawBody)) {
            $data = $request->getParsedBody();
            error_log('🔍 Usando getParsedBody: ' . json_encode($data));
        } else {
            $data = json_decode($rawBody, true);
            error_log('🔍 Usando json_decode: ' . json_encode($data));
        }
        
        // Validar que data sea un array
        if (!is_array($data)) {
            $errorData = [
                'success' => false,
                'message' => 'Datos inválidos: se esperaba un array de pedidos',
                'received' => $data,
                'raw_body' => $rawBody,
                'parsed_body' => $request->getParsedBody()
            ];
            $response->getBody()->write(json_encode($errorData));
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withHeader('Access-Control-Allow-Origin', '*')
                ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                ->withHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization')
                ->withStatus(400);
        }
        
        error_log('🔍 Raw body recibido: ' . $rawBody);
        error_log('🔍 Datos decodificados: ' . json_encode($data));
        error_log('🔍 Número de pedidos: ' . count($data));
        
        $pedidosLotes = [];
        $totalCountPrePlaneados = 0;
        
        // Procesar cada pedido del array
        foreach ($data as $pedido) {
            $referencia = $pedido['referencia'] ?? 'M-20966';
            $granel = $pedido['granel'] ?? $referencia;
            $producto = $pedido['producto'] ?? 'Producto ' . $referencia;
            $cantidad_acumulada = $pedido['cantidad_acumulada'] ?? 500;
            
            // Consulta directa para obtener datos del producto
            $sql = "SELECT p.referencia, p.densidad_producto as densidad, linea.ajuste, pc.nombre as presentacion
                    FROM producto p
                    INNER JOIN linea ON p.id_linea = linea.id
                    INNER JOIN presentacion_comercial pc ON p.presentacion_comercial = pc.id
                    WHERE p.referencia = :referencia";
            
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['referencia' => $referencia]);
            $productData = $stmt->fetch();
            
            if (!$productData) {
                // Si no encuentra el producto, usar valores por defecto
                $densidad = 1.0;
                $ajuste = 1.0;
                $presentacion = 'ML';
            } else {
                $densidad = floatval($productData['densidad']);
                $ajuste = floatval($productData['ajuste']);
                $presentacion = $productData['presentacion'];
            }
            
            // Cálculo básico - CORREGIDO para usar cantidad y presentación
            $presentacion_valor = floatval(str_replace(['ML', 'G'], '', $presentacion));
            $tamanioLote = (($densidad * $presentacion_valor * $cantidad_acumulada) * (1 + $ajuste)) / 1000;
            
            error_log("🔍 calc-lote-directo - Cálculo para $referencia: densidad=$densidad, presentacion=$presentacion_valor, cantidad=$cantidad_acumulada, ajuste=$ajuste, resultado=$tamanioLote");
            
            // Agregar pedido procesado al array de resultados con estructura correcta para el DAO
            $pedidosLotes[] = [
                'numPedido' => $pedido['numPedido'] ?? 'PED-' . $referencia,
                'referencia' => $referencia,
                'granel' => $granel,
                'producto' => $producto,
                'tamanio_lote' => round($tamanioLote, 2),
                'cantidad_acumulada' => $cantidad_acumulada,
                'valor_pedido' => $pedido['valor_pedido'] ?? 0,
                'fecha_insumo' => $pedido['fecha_insumo'] ?? date('Y-m-d'),
                'estado' => 'calculado'
            ];
            
            $totalCountPrePlaneados++;
        }
        
        // Guardar datos en la sesión para que estén disponibles en addPrePlaneados
        session_start();
        $_SESSION['dataGranel'] = $pedidosLotes;
        error_log('✅ Datos guardados en sesión: ' . json_encode($_SESSION['dataGranel']));
        
        // Validar y actualizar estados de los productos
        require_once __DIR__ . '/src/utils/EstadoValidator.php';
        $estadoValidator = new \BatchRecord\utils\EstadoValidator($pdo);
        
        // Obtener referencias únicas de productos
        $referencias = array_unique(array_map(function($pedido) {
            return $pedido['referencia'];
        }, $pedidosLotes));
        
        error_log('🔍 Validando estados para referencias: ' . json_encode($referencias));
        
        // Validar y actualizar estados
        $estadosValidados = $estadoValidator->validateMultipleProducts($referencias);
        error_log('✅ Estados validados: ' . json_encode($estadosValidados));
        
        // Crear respuesta para el frontend (mantener estructura original)
        $pedidosLotesResponse = [];
        foreach ($pedidosLotes as $pedido) {
            $pedidosLotesResponse[] = [
                'pedido' => $pedido['numPedido'],
                'referencia' => $pedido['referencia'],
                'granel' => $pedido['granel'],
                'producto' => $pedido['producto'],
                'tamanio_lote' => $pedido['tamanio_lote'],
                'cantidad_acumulada' => $pedido['cantidad_acumulada']
            ];
        }
        
        // Respuesta
        $resultado = [
            'success' => true,
            'message' => 'Cálculo completado exitosamente',
            'pedidosLotes' => $pedidosLotesResponse,
            'countPrePlaneados' => $totalCountPrePlaneados,
            'estadosValidados' => $estadosValidados
        ];
        
        error_log('✅ Respuesta de API: ' . json_encode($resultado));
        
        $response->getBody()->write(json_encode($resultado));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->withHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization');
        
    } catch (PDOException $e) {
        $errorData = [
            'success' => false,
            'message' => 'Error de base de datos: ' . $e->getMessage(),
            'error_code' => $e->getCode()
        ];
        $response->getBody()->write(json_encode($errorData));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->withHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization')
            ->withStatus(500);
        
    } catch (Exception $e) {
        $errorData = [
            'success' => false,
            'message' => 'Error general: ' . $e->getMessage()
        ];
        $response->getBody()->write(json_encode($errorData));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->withHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization')
            ->withStatus(500);
    }
});

// Ruta para actualizar estado de un producto específico
$app->post('/update-estado-producto', function (Request $request, Response $response) {
    try {
        // Obtener datos del request
        $data = $request->getParsedBody();
        error_log('🔍 update-estado-producto - Datos recibidos: ' . json_encode($data));
        
        // Validar datos requeridos
        if (!isset($data['referencia'])) {
            $resp = ['error' => true, 'message' => 'Referencia del producto es requerida'];
            error_log('❌ update-estado-producto - Referencia faltante');
            $response->getBody()->write(json_encode($resp));
            return $response->withHeader('Content-Type', 'application/json');
        }
        
        // Conectar a la base de datos
        $host = '172.17.0.1';
        $port = '3307';
        $dbname = 'batch_record';
        $username = 'root';
        $password = 'S@m4r@_2025!';
        
        $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Usar la nueva clase EstadoValidator
        require_once __DIR__ . '/src/utils/EstadoValidator.php';
        $estadoValidator = new \BatchRecord\utils\EstadoValidator($pdo);
        
        $referencia = $data['referencia'];
        
        // Debug: Verificar estructura de tablas
        $estadoValidator->debugTablas($referencia);
        
        // Validar y actualizar estado
        $estado = $estadoValidator->checkFormulasAndInstructivos($referencia);
        $estadoValidator->updateEstadoPreplaneados($referencia, $estado);
        
        $descripcion = ($estado == 0) ? 'Falta Formula e Instructivo' : 'Inactivo';
        
        $resp = [
            'success' => true,
            'message' => 'Estado actualizado correctamente',
            'referencia' => $referencia,
            'estado' => $estado,
            'descripcion' => $descripcion
        ];
        
        error_log('✅ update-estado-producto - Estado actualizado para ' . $referencia . ': ' . $estado);
        
        $response->getBody()->write(json_encode($resp));
        return $response->withHeader('Content-Type', 'application/json');
        
    } catch (Exception $e) {
        $resp = [
            'error' => true, 
            'message' => 'Error actualizando estado: ' . $e->getMessage()
        ];
        error_log('❌ update-estado-producto - Error: ' . $e->getMessage());
        $response->getBody()->write(json_encode($resp));
        return $response->withHeader('Content-Type', 'application/json');
    }
});

// Nueva ruta simple para guardar pre-planeados
$app->post('/save-preplaneados', function (Request $request, Response $response) {
    try {
        // Obtener datos del request
        $data = $request->getParsedBody();
        error_log('🔍 save-preplaneados - Datos recibidos: ' . json_encode($data));
        
        // Validar datos requeridos
        if (!isset($data['date']) || !isset($data['pedidosLotes']) || !isset($data['simulacion'])) {
            $resp = ['error' => true, 'message' => 'Datos incompletos'];
            error_log('❌ save-preplaneados - Datos incompletos');
            $response->getBody()->write(json_encode($resp));
            return $response->withHeader('Content-Type', 'application/json');
        }
        
        // Conectar a la base de datos
        $host = '172.17.0.1';
        $port = '3307';
        $dbname = 'batch_record';
        $username = 'root';
        $password = 'S@m4r@_2025!';
        
        $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $date = $data['date'];
        $simulacion = $data['simulacion'];
        $pedidosLotes = $data['pedidosLotes'];
        
        error_log('🔍 save-preplaneados - Procesando ' . count($pedidosLotes) . ' pedidos');
        
        // Insertar cada pedido
        $stmt = $pdo->prepare("
            INSERT INTO plan_preplaneados 
            (pedido, fecha_programacion, tamano_lote, unidad_lote, valor_pedido, id_producto, estado, fecha_insumo, sim, planeado, fecha_registro) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 1, NOW())
        ");
        
        $insertados = 0;
        foreach ($pedidosLotes as $pedido) {
            // Obtener valor_pedido de la tabla plan_pedidos
            $valor_pedido = 0;
            try {
                $stmtValor = $pdo->prepare("
                    SELECT valor_pedido 
                    FROM plan_pedidos 
                    WHERE pedido = ? AND id_producto = ? 
                    LIMIT 1
                ");
                $stmtValor->execute([
                    $pedido['pedido'] ?? 'PED-' . ($pedido['referencia'] ?? 'UNKNOWN'),
                    $pedido['referencia'] ?? ''
                ]);
                $resultado = $stmtValor->fetch(PDO::FETCH_ASSOC);
                if ($resultado) {
                    $valor_pedido = $resultado['valor_pedido'];
                    error_log('✅ save-preplaneados - Valor pedido encontrado: ' . $valor_pedido . ' para pedido: ' . $pedido['pedido']);
                } else {
                    error_log('⚠️ save-preplaneados - No se encontró valor_pedido para pedido: ' . $pedido['pedido'] . ' y producto: ' . $pedido['referencia']);
                }
            } catch (Exception $e) {
                error_log('❌ save-preplaneados - Error al obtener valor_pedido: ' . $e->getMessage());
            }
            
            // Validar estado del producto
            $estadoValidator = new \BatchRecord\utils\EstadoValidator($pdo);
            $estado = $estadoValidator->checkFormulasAndInstructivos($pedido['referencia'] ?? '');
            error_log('✅ save-preplaneados - Estado calculado para ' . $pedido['referencia'] . ': ' . $estado);
            
            $params = [
                $pedido['pedido'] ?? 'PED-' . ($pedido['referencia'] ?? 'UNKNOWN'),
                $date,
                $pedido['tamanio_lote'] ?? 0,
                $pedido['cantidad_acumulada'] ?? 0,
                $valor_pedido, // valor_pedido obtenido de plan_pedidos
                $pedido['referencia'] ?? '',
                $estado, // estado calculado basado en fórmulas e instructivos
                $pedido['fecha_insumo'] ?? date('Y-m-d'),
                $simulacion
            ];
            
            $stmt->execute($params);
            $insertados++;
            error_log('✅ save-preplaneados - Pedido insertado: ' . json_encode($pedido));
        }
        
        $resp = [
            'success' => true, 
            'message' => "Se insertaron $insertados pedidos correctamente",
            'insertados' => $insertados
        ];
        
        error_log('✅ save-preplaneados - Proceso completado: ' . json_encode($resp));
        $response->getBody()->write(json_encode($resp));
        return $response->withHeader('Content-Type', 'application/json');
        
    } catch (Exception $e) {
        error_log('❌ save-preplaneados - Error: ' . $e->getMessage());
        $resp = ['error' => true, 'message' => 'Error al guardar: ' . $e->getMessage()];
        $response->getBody()->write(json_encode($resp));
        return $response->withHeader('Content-Type', 'application/json');
    }
});

// Ruta para actualizar pre-planeado
$app->post('/update-preplaneado', function (Request $request, Response $response) {
    try {
        // Obtener datos del request
        $data = $request->getParsedBody();
        error_log('🔍 update-preplaneado - Datos recibidos: ' . json_encode($data));
        
        // Validar datos requeridos
        if (!isset($data['id']) || !isset($data['tamano_lote']) || !isset($data['cantidad'])) {
            $resp = ['error' => true, 'message' => 'Datos incompletos: id, tamano_lote y cantidad son requeridos'];
            error_log('❌ update-preplaneado - Datos incompletos');
            $response->getBody()->write(json_encode($resp));
            return $response->withHeader('Content-Type', 'application/json');
        }
        
        // Conectar a la base de datos
        $host = '172.17.0.1';
        $port = '3307';
        $dbname = 'batch_record';
        $username = 'root';
        $password = 'S@m4r@_2025!';
        
        $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $id = $data['id'];
        $tamanoLote = floatval($data['tamano_lote']);
        $cantidad = intval($data['cantidad']);
        
        error_log('🔍 update-preplaneado - Actualizando registro ID: ' . $id . ' con tamano_lote: ' . $tamanoLote . ' y cantidad: ' . $cantidad);
        
        // Actualizar el registro
        $stmt = $pdo->prepare("
            UPDATE plan_preplaneados 
            SET tamano_lote = :tamano_lote, unidad_lote = :unidad_lote 
            WHERE id = :id
        ");
        
        $stmt->execute([
            'tamano_lote' => $tamanoLote,
            'unidad_lote' => $cantidad,
            'id' => $id
        ]);
        
        $affectedRows = $stmt->rowCount();
        
        if ($affectedRows > 0) {
            $resp = [
                'success' => true,
                'message' => 'Pre-planeado actualizado correctamente',
                'affected_rows' => $affectedRows
            ];
            error_log('✅ update-preplaneado - Registro actualizado exitosamente');
        } else {
            $resp = [
                'error' => true,
                'message' => 'No se encontró el registro a actualizar'
            ];
            error_log('⚠️ update-preplaneado - No se encontró registro con ID: ' . $id);
        }
        
        $response->getBody()->write(json_encode($resp));
        return $response->withHeader('Content-Type', 'application/json');
        
    } catch (Exception $e) {
        $resp = [
            'error' => true, 
            'message' => 'Error actualizando pre-planeado: ' . $e->getMessage()
        ];
        error_log('❌ update-preplaneado - Error: ' . $e->getMessage());
        $response->getBody()->write(json_encode($resp));
        return $response->withHeader('Content-Type', 'application/json');
    }
});

// Run app
$app->run();
