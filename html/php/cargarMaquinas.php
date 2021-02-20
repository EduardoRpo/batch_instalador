<?php


require_once('../../conexion.php');
require_once('../../admin/sistema/php/crud.php');

//listar equipos de acuerdo con la linea


function finAll(){
    $query = "SELECT * FROM batch_equipos";
    return $query;
}

ejecutarQuerySelect($conn, $query);
