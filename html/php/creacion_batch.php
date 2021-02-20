<?php

$data = file_get_contents('../../pedidos.txt');
$pedidos = json_decode($data, true);
$i = 0;
foreach ($pedidos as $pedido) {
    echo '<pre>';
    echo ++$i;
    echo '<pre>';
    print_r($pedido['Nro_Pedido']);
    echo '</pre>';
}
