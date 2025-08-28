<?php

//librerias
use BatchRecord\dao\BatchDao;
use BatchRecord\dao\UltimoBatchCreadoDao;
use BatchRecord\dao\TanquesDao;
use BatchRecord\dao\ControlFirmasDao;
use BatchRecord\dao\MultiDao;
use BatchRecord\dao\PlanPedidosDao;
use BatchRecord\dao\ObservacionesInactivosDao;
use BatchRecord\dao\PlanPrePlaneadosDao;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
// use Dompdf\Dompdf;
// use Dompdf\Options;

// $options = new Options();
// $options->set('isHtml5ParserEnabled', true);
// $options->set('isRemoteEnabled', TRUE);

// $dompdf = new Dompdf($options);

$batchDao = new BatchDao();
$ultimoBatchDao = new UltimoBatchCreadoDao();
$tanquesDao = new TanquesDao();
$controlFirmasDao = new ControlFirmasDao();
$multiDao = new MultiDao();
$EMPedidosRegistroDao = new PlanPedidosDao();
$planPrePlaneadosDao = new PlanPrePlaneadosDao();
$observacionesDao = new ObservacionesInactivosDao();

$app->get('/batch', function (Request $request, Response $data, $args) use ($batchDao) {
  try {
    $batch = $batchDao->findActive();
    $data->getBody()->write(json_encode($batch, JSON_NUMERIC_CHECK));
    return $data->withHeader('Content-Type', 'application/json');
  } catch (Exception $e) {
    // En caso de error, devolver array vacío
    $errorResponse = [
      'error' => true,
      'message' => 'Error al obtener datos de batch: ' . $e->getMessage(),
      'data' => []
    ];
    $data->getBody()->write(json_encode($errorResponse, JSON_NUMERIC_CHECK));
    return $data->withHeader('Content-Type', 'application/json')->withStatus(500);
  }
});

$app->get('/batch/{id}', function (Request $request, Response $response, $args) use ($batchDao, $tanquesDao) {
  $dataBatch = $batchDao->findBatchById($args["id"]);

  if ($dataBatch != false) {
    $tanques = $tanquesDao->findTanquesById($args["id"]);
    if ($tanques != false)
      $batch = array_merge($dataBatch, $tanques);
    else
      $batch = $dataBatch;
  }

  $response->getBody()->write(json_encode($batch, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/batchInactivos', function (Request $request, Response $data, $args) use ($batchDao) {
  $batch = $batchDao->findInactive();
  $data->getBody()->write(json_encode($batch, JSON_NUMERIC_CHECK));
  return $data->withHeader('Content-Type', 'application/json');
});

$app->get('/batchcerrados', function (Request $request, Response $response, $args) use ($batchDao) {
  $batchcerrados = $batchDao->findAllClosed();
  $response->getBody()->write(json_encode($batchcerrados, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/saveBatch', function (Request $request, Response $response, $args) use ($batchDao, $ultimoBatchDao, $tanquesDao, $controlFirmasDao, $multiDao, $EMPedidosRegistroDao, $observacionesDao, $planPrePlaneadosDao) {
  session_start();
  $dataBatch = $request->getParsedBody();
  // $flag_tanques = 1;


  if ($dataBatch['data']) {
    $pedidos = $dataBatch['data'];
    $dataBatch = $_SESSION['dataGranel'];

    for ($i = 0; $i < sizeof($dataBatch); $i++) {
      if ($dataBatch[$i]['granel'] == $pedidos[$i]['granel']) {
        $dataBatch[$i]['date'] = $pedidos[sizeof($pedidos) - 1]['date'];
        $dataBatch[$i]['tanque'] = $pedidos[$i]['tanque'];
        $dataBatch[$i]['cantidades'] = $pedidos[$i]['cantidades'];
      }
    }
  }

  /* Crear el batch */
  for ($i = 0; $i < sizeof($dataBatch); $i++) {

    //validar si el multi es de planeacion o es creado manualmente
    $array = is_array($dataBatch[$i]['multi']);

    if ($array) // planeacion
      $multi = $dataBatch[$i]['multi'];
    else // batch manual
      $multi = json_decode($dataBatch[$i]['multi'], true);

    //Guarda Batch
    $resp = $batchDao->saveBatch($dataBatch[$i], $multi);

    /* Identifica el ultimo Batch ingresado */
    if ($resp == null)
      $id_batch = $ultimoBatchDao->ultimoBatchCreado();

    /* Crea los tanques */
    if ($resp == null)
      $resp = $tanquesDao->saveTanques($id_batch['id'], $dataBatch[$i]);

    /* Crea el control de formulas */
    if ($resp == null)
      $resp = $controlFirmasDao->saveControlFirmas($id_batch['id']);

    /* Crea la multipresentacion */
    if ($resp == null)
      $resp = $multiDao->saveMulti($id_batch['id'], $dataBatch[$i], $multi);

    /* Actualizar pedido batch */
    if ($resp == null) {

      // Almacena los pedidos en los batch creados
      for ($j = 0; $j < sizeof($multi); $j++) {
        if ($multi[$j]['numPedido']) {
          $resp = $batchDao->updateBatchPedido($id_batch['id'], $multi[$j]);
          // Agregar batch a observacion de planeacion
          $observaciones = $observacionesDao->findObservaciones($multi[$j]);
          if ($observaciones)
            $resp = $observacionesDao->updateObservacion($id_batch['id'], $multi[$j]);

          // Eliminar campos de preplaneados
          $resp = $planPrePlaneadosDao->deletePlaneado($multi[$j]['id']);
        } else {
          //$resp = $batchDao->updateBatchPedido($id_batch['id'], $dataBatch[0]);
          $_SESSION['dataPedidos'] = $multi;
        }
      }
    }
  }
  $resp = $EMPedidosRegistroDao->checkEMPedidosRegistro();

  /* Notificaciones*/
  if ($resp == null && $dataBatch[0]['ref'])
    $resp = array('success' => true, 'message' => 'Batch creado correctamente');
  else if ($resp == null)
    $resp = array('success' => true, 'message' => sizeof($dataBatch) . ' ' . 'Batchs creados correctamente');
  else
    $resp = array('error' => true, 'message' => 'Ocurrio un error mientras creaba el Batch. Intentelo nuevamente');

  $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/saveBatchFromPlaneacion', function (Request $request, Response $response, $args) use ($batchDao, $ultimoBatchDao, $tanquesDao, $controlFirmasDao, $multiDao, $EMPedidosRegistroDao, $observacionesDao, $planPrePlaneadosDao) {
  session_start();
  
  // Log para debugging
  error_log('🔍 saveBatchFromPlaneacion - Iniciando');
  error_log('🔍 saveBatchFromPlaneacion - Raw POST data: ' . file_get_contents('php://input'));
  
  $dataBatch = $request->getParsedBody();
  error_log('🔍 saveBatchFromPlaneacion - Datos recibidos (parsed): ' . json_encode($dataBatch));
  
  if (!isset($dataBatch['data']) || empty($dataBatch['data'])) {
    $resp = array('error' => true, 'message' => 'No hay datos para procesar');
    error_log('❌ saveBatchFromPlaneacion - Error: No hay datos');
    $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
  }
  
  $pedidos = $dataBatch['data'];
  error_log('🔍 saveBatchFromPlaneacion - Array de pedidos extraído: ' . json_encode($pedidos));
  $fechaProgramacion = null;
  
  // Extraer la fecha de programación del último elemento
  foreach ($pedidos as $pedido) {
    if (isset($pedido['date'])) {
      $fechaProgramacion = $pedido['date'];
      break;
    }
  }
  
  error_log('🔍 saveBatchFromPlaneacion - Fecha de programación: ' . $fechaProgramacion);
  
  // Procesar cada pedido y crear el batch
  $batchesCreados = 0;
  $errores = [];
  
  for ($i = 0; $i < sizeof($pedidos); $i++) {
    $pedido = $pedidos[$i];
    error_log('🔍 saveBatchFromPlaneacion - Procesando elemento ' . $i . ': ' . json_encode($pedido));
    
    // Saltar elementos que solo contienen fecha
    if (isset($pedido['date']) && count($pedido) == 1) {
      error_log('🔍 saveBatchFromPlaneacion - Saltando elemento con fecha: ' . json_encode($pedido));
      continue;
    }
    
    // Verificar que tenga los campos necesarios
    if (!isset($pedido['granel'])) {
      $errores[] = 'Campo granel no encontrado en pedido ' . $i . ': ' . json_encode($pedido);
      error_log('❌ saveBatchFromPlaneacion - Campo granel no encontrado en pedido ' . $i . ': ' . json_encode($pedido));
      continue;
    }
    
    // Obtener información del producto desde la base de datos
    try {
      $conn = new PDO("mysql:dbname=batch_record;host=mariadb_pro", "root", "S@m4r@_2025!");
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
      // Buscar el producto por referencia
      $sql = "SELECT referencia, nombre_referencia FROM producto WHERE referencia = :granel";
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(':granel', $pedido['granel'], PDO::PARAM_STR);
      $stmt->execute();
      $producto = $stmt->fetch(PDO::FETCH_ASSOC);
      
      if (!$producto) {
        $errores[] = 'Producto no encontrado para granel: ' . $pedido['granel'];
        error_log('❌ saveBatchFromPlaneacion - Producto no encontrado para granel: ' . $pedido['granel']);
        continue;
      }
      
      // Usar directamente los valores del modal
      $cantidad = isset($pedido['cantidad_acumulada']) ? intval($pedido['cantidad_acumulada']) : 0;
      $tamanio_lote = isset($pedido['tamanio_lote']) ? floatval($pedido['tamanio_lote']) : 0;
      
      error_log('🔍 saveBatchFromPlaneacion - Producto encontrado: ' . json_encode($producto));
      error_log('🔍 saveBatchFromPlaneacion - Valores del modal - Cantidad: ' . $cantidad . ', Tamaño: ' . $tamanio_lote);
      error_log('🔍 saveBatchFromPlaneacion - Datos completos del pedido: ' . json_encode($pedido));
      
      // Preparar datos del batch en el formato que espera el BatchDao
      $batchData = [
        'granel' => $pedido['granel'],
        'ref' => $pedido['granel'],
        'tamanio_lote' => $tamanio_lote,
        'lote' => $tamanio_lote,
        'presentacion' => 1,
        'programacion' => $fechaProgramacion,
        'date' => $fechaProgramacion,
        'fecha_planeacion' => date('Y-m-d'),
        'cantidad_acumulada' => $cantidad,
        'pedido' => 1
      ];
      
      error_log('🔍 saveBatchFromPlaneacion - Datos preparados para BatchDao: ' . json_encode($batchData));
      
      // Crear el batch usando el DAO
      $multi = [['cantidadunidades' => null]]; // Estructura esperada por el DAO
      $resp = $batchDao->saveBatch($batchData, $multi);
      
      if ($resp === null) {
        // Obtener el ID del batch creado
        $id_batch = $ultimoBatchDao->ultimoBatchCreado();
        
        if ($id_batch) {
          // Crear control de firmas
          $resp = $controlFirmasDao->saveControlFirmas($id_batch['id']);
          
          if ($resp === null) {
            $batchesCreados++;
            error_log('✅ saveBatchFromPlaneacion - Batch creado exitosamente: ' . $id_batch['id']);
          } else {
            $errores[] = 'Error al crear control de firmas para batch ' . $id_batch['id'];
            error_log('❌ saveBatchFromPlaneacion - Error al crear control de firmas para batch ' . $id_batch['id'] . ': ' . json_encode($resp));
          }
        } else {
          $errores[] = 'Error al obtener ID del batch creado';
          error_log('❌ saveBatchFromPlaneacion - Error al obtener ID del batch creado');
        }
      } else {
        $errores[] = 'Error al crear batch: ' . json_encode($resp);
        error_log('❌ saveBatchFromPlaneacion - Error al crear batch: ' . json_encode($resp));
      }
      
    } catch (PDOException $e) {
      $errores[] = 'Error de base de datos: ' . $e->getMessage();
      error_log('❌ saveBatchFromPlaneacion - Error de base de datos: ' . $e->getMessage());
    }
  }
  
  // Preparar respuesta
  if (empty($errores) && $batchesCreados > 0) {
    $resp = array('success' => true, 'message' => $batchesCreados . ' batch(s) creado(s) correctamente');
    error_log('✅ saveBatchFromPlaneacion - Respuesta de éxito: ' . json_encode($resp));
  } else {
    $resp = array('error' => true, 'message' => 'Errores al crear batches: ' . implode(', ', $errores));
    error_log('❌ saveBatchFromPlaneacion - Respuesta de error: ' . json_encode($resp));
  }
  
  $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

// Función auxiliar para generar número de lote
function generarNumeroLote($granel) {
  $prefijo = '';
  if (strpos($granel, 'Granel-') === 0) {
    $numero = substr($granel, 7);
    if (is_numeric($numero)) {
      if ($numero < 100) {
        $prefijo = 'LQ';
      } elseif ($numero < 500) {
        $prefijo = 'SM';
      } else {
        $prefijo = 'VT';
      }
    }
  }
  
  $fecha = date('dmy');
  $sufijo = str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT);
  
  return $prefijo . $fecha . $sufijo;
}

$app->post('/updateBatch', function (Request $request, Response $response, $args) use ($batchDao, $tanquesDao) {
  $dataBatch = $request->getParsedBody();

  $resp = $batchDao->updateBatch($dataBatch);

  /* Crea o modifica los tanques */
  if ($resp == null)
    $resp = $tanquesDao->saveTanques($dataBatch['id_batch'], $dataBatch);

  /* Notificaciones*/
  if ($resp == null)
    $resp = array('success' => true, 'message' => 'Batch actualizado correctamente');
  else
    $resp = array('error' => true, 'message' => 'Ocurrio un error mientras actualizaba el Batch. Intentelo nuevamente');

  $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/deleteBatch/{id_batch}/{motivo}', function (Request $request, Response $response, $args) use ($batchDao) {

  $resp = $batchDao->deleteBatch($args['id_batch'], $args['motivo']);

  /* Notificaciones*/
  if ($resp == null)
    $resp = array('success' => true, 'message' => 'Batch Record Eliminado correctamente');
  else if (isset($resp['info']))
    $resp = array('info' => true, 'message' => $resp['message']);
  else
    $resp = array('error' => true, 'message' => 'Ocurrio un error mientras eliminaba el Batch. Intentelo nuevamente');

  $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/savePdf', function (Request $request, Response $response, $args) use ($batchDao) {
  $pdf = $batchDao->loadImagePdf();

  if ($pdf == null)
    $resp = array('success' => true, 'message' => 'Documento pdf descargado correctamente');
  else if (isset($pdf['info']))
    $resp = array('info' => true, 'message' => $pdf['message']);
  else
    $resp = array('error' => true, 'message' => 'Ocurrio un error mientras descargaba el Batch. Intentelo nuevamente');

  $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

/*
$app->post('/generate-pdf', function (Request $request, Response $response, $args) use ($dompdf, $batchDao) {
  $data = $request->getParsedBody();
  $batchId = $data['batch_id'];

  // Obtener datos del batch
  $batchData = $batchDao->findBatchById($batchId);

  // Generar HTML para el PDF
  $html = '<html><body><h1>Batch Report</h1><p>Batch ID: ' . $batchId . '</p></body></html>';

  // Carga el HTML en Dompdf
  $dompdf->loadHtml($html);

  $customPaper = array(0, 0, 612, 792);
  $dompdf->set_paper($customPaper);

  // Renderiza el PDF
  $dompdf->render();

  $output = $dompdf->output();

  $response->getBody()->write($output);
  return $response->withHeader('Content-Type', 'application/pdf');
});
*/
