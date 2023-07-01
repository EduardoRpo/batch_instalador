<?php

use BatchRecord\dao\AuditoriaFormulasDao;

$auditoriaFormulasDao = new AuditoriaFormulasDao();

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->get('/auditoriaFirmas', function (Request $request, Response $response, $args) use ($auditoriaFormulasDao) {
    $formula = $auditoriaFormulasDao->findAllFormulas();
    $response->getBody()->write(json_encode($formula, JSON_NUMERIC_CHECK));
    return $response->withHeader('Content-Type', 'application/json');
});
