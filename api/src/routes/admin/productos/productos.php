<?php


use BatchRecord\dao\ProductosDao;
use Psr\Http\Client\RequestExceptionInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$productosDao = new ProductosDao();

$app->get('/getproducts', function (Request $request, Response $data, $args) use ($productosDao) {
  $productos = $productosDao->findAllProducts();
  $data->getBody()->write(json_encode($productos, JSON_NUMERIC_CHECK));
  return $data->withHeader('Content-Type', 'application/json');
});

$app->get('/getproduct/{id}', function (Request $request, Response $response, $args) use ($productosDao) {
  $producto = $productosDao->findProductById($args["id"]);
  $response->getBody()->write(json_encode($producto, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/saveProduct', function (Request $request, Response $response, $args) use ($productosDao) {
  $dataProducto = $request->getParsedBody();
  $producto = $productosDao->saveProduct($dataProducto);

  if ($producto == 1)
    $resp = array('info' => true, 'message' => 'referencia del Producto ya existe. Intente con una nueva referencia');

  else if ($producto == null)
    $resp = array('success' => true, 'message' => 'Producto creado correctamente');

  else
    $resp = array('error' => true, 'message' => 'Ocurrio un error, intente nuevamente');

  $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

$app->post('/updateProduct', function (Request $request, Response $response, $args) use ($productosDao) {
  $dataProducto = $request->getParsedBody();
  $producto = $productosDao->updateProduct($dataProducto);

  if ($producto == null)
    $resp = array('success' => true, 'message' => 'Producto actualizado correctamente');
  else
    $resp = array('error' => true, 'message' => 'Ocurrio un error, intente nuevamente');

  $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/deleteProduct/{id}', function (Request $request, Response $response, $args) use ($productosDao) {
  $producto = $productosDao->deleteProductById($args["id"]);

  if ($producto == null)
    $resp = array('success' => true, 'message' => 'Producto eliminado correctamente');
  if ($producto != null)
    $resp = array('error' => true, 'message' => 'No es posible eliminar el producto, existe información asociada a él');

  $response->getBody()->write(json_encode($resp, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/loadSelector/{selector}', function (Request $request, Response $response, $args) use ($productosDao) {
  $selector = $productosDao->findSelector($args['selector']);
  return $selector;

});

$app->get('/findBase', function (Request $request, Response $response, $args) use ($productosDao) {
  $base = $productosDao->findBase();
  $response->getBody()->write(json_encode($base, JSON_NUMERIC_CHECK));
  return $response->withHeader('Content-Type', 'application/json');
});
