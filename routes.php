<?php

  require 'Router.php';
  require 'Route.php';


  $router = new Router($_SERVER['REQUEST_URI']);

  $router->setRequestUri($_SERVER['REQUEST_URI']);

  $router->setBasePath('');
  $router->add('/', function () {
    return file_get_contents('index.php');
  });

  $router->add('/pesaje', function () {
    return Router::getRenderedHTML('html/pesaje.php');
  });
  $router->add('/pesajeinfo/:idBatch/:referencia', function ($idBatch, $referencia) {
    return Router::getRenderedHTML('html/pesajeinfo.php');
  });
  
  $router->add('/preparacion', function () {
    return Router::getRenderedHTML('html/preparacion.php');
  });
  $router->add('/preparacioninfo/:idBatch/:referencia', function ($idBatch, $referencia) {
    return Router::getRenderedHTML('html/preparacioninfo.php');
  });

  $router->add('/aprobacion', function () {
    return Router::getRenderedHTML('html/aprobacion.php');
  });
  $router->add('/aprobacioninfo/:idBatch/:referencia', function ($idBatch, $referencia) {
    return Router::getRenderedHTML('html/aprobacioninfo.php');
  });
  
  $router->add('/envasado', function () {
    return Router::getRenderedHTML('html/envasado.php');
  });
  $router->add('/envasadoinfo/:idBatch/:referencia', function ($idBatch, $referencia) {
    return Router::getRenderedHTML('html/envasadoinfo.php');
  });

  /* $router->add('/loteado', function () {
    return Router::getRenderedHTML('html/loteado.php');
  });
  $router->add('/loteadoinfo/:idBatch/:referencia', function ($idBatch, $referencia) {
    return Router::getRenderedHTML('html/loteadoinfo.php');
  }); */

  $router->add('/acondicionamiento', function () {
    return Router::getRenderedHTML('html/acondicionamiento.php');
  });
  $router->add('/acondicionamientoinfo/:idBatch/:referencia', function ($idBatch, $referencia) {
    return Router::getRenderedHTML('html/acondicionamientoinfo.php');
  });

  $router->add('/despachos', function () {
    return Router::getRenderedHTML('html/despachos.php');
  });
  $router->add('/despachosinfo/:idBatch/:referencia', function ($idBatch, $referencia) {
    return Router::getRenderedHTML('html/despachosinfo.php');
  });

  $router->add('/liberacionproducto', function () {
    return Router::getRenderedHTML('html/liberacionproducto.php');
  });
  $router->add('/liberacionproductoinfo/:idBatch/:referencia', function ($idBatch, $referencia) {
    return Router::getRenderedHTML('html/liberacionproductoinfo.php');
  });

  $router->add('/controlfisico', function () {
    return Router::getRenderedHTML('html/controlfisico.php');
  });
  $router->add('/controlfisicoinfo/:idBatch/:referencia', function ($idBatch, $referencia) {
    return Router::getRenderedHTML('html/controlfisicoinfo.php');
  });
  
  $router->add('/liberacionlote', function () {
    return Router::getRenderedHTML('html/liberacionlote.php');
  });
  $router->add('/liberacionloteinfo/:idBatch/:referencia', function ($idBatch, $referencia) {
    return Router::getRenderedHTML('html/liberacionloteinfo.php');
  });

  $router->run();
