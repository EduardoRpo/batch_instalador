<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;

return function (App $app) {
    $app->post('/api/calcTamanioLoteSimple', function (Request $request, Response $response) {
        try {
            // Configuración directa de base de datos
            $host = '10.1.200.16';
            $port = '3307';
            $dbname = 'batch_record';
            $username = 'root';
            $password = 'S@m4r@_2025!';
            
            // Conexión directa sin usar la clase Connection
            $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8";
            $pdo = new PDO($dsn, $username, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);
            
            // Obtener datos del request
            $data = $request->getParsedBody();
            $referencia = $data['referencia'] ?? 'M-20966'; // Valor por defecto para testing
            
            // Función para obtener datos del producto
            function getProductData($pdo, $referencia) {
                $sql = "SELECT p.referencia, p.densidad_producto as densidad, linea.ajuste, pc.nombre as presentacion
                        FROM producto p
                        INNER JOIN linea ON p.id_linea = linea.id
                        INNER JOIN presentacion_comercial pc ON p.presentacion_comercial = pc.id
                        WHERE p.referencia = :referencia";
                
                $stmt = $pdo->prepare($sql);
                $stmt->execute(['referencia' => $referencia]);
                return $stmt->fetch();
            }
            
            // Obtener datos del producto
            $productData = getProductData($pdo, $referencia);
            
            if (!$productData) {
                return $response->withJson([
                    'success' => false,
                    'message' => 'Producto no encontrado',
                    'referencia' => $referencia
                ], 404);
            }
            
            // Simular cálculo de lote (lógica simplificada)
            $densidad = floatval($productData['densidad']);
            $ajuste = floatval($productData['ajuste']);
            $presentacion = $productData['presentacion'];
            
            // Cálculo básico
            $tamanioLote = $densidad * $ajuste * 1000; // Factor de conversión
            
            // Preparar respuesta
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
}; 