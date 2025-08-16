<?php
// Archivo de prueba simple para diagnosticar el problema
header('Content-Type: application/json');

// Respuesta simple que sabemos que funciona
$response = [
    'draw' => 1,
    'recordsTotal' => 5,
    'recordsFiltered' => 5,
    'data' => [
        [1, 'test1', 'ref1', 'pedido1', '', 'prop1', 'desc1', 'lote1', 100, 50],
        [2, 'test2', 'ref2', 'pedido2', '', 'prop2', 'desc2', 'lote2', 200, 100],
        [3, 'test3', 'ref3', 'pedido3', '', 'prop3', 'desc3', 'lote3', 300, 150],
        [4, 'test4', 'ref4', 'pedido4', '', 'prop4', 'desc4', 'lote4', 400, 200],
        [5, 'test5', 'ref5', 'pedido5', '', 'prop5', 'desc5', 'lote5', 500, 250]
    ]
];

echo json_encode($response);
?> 