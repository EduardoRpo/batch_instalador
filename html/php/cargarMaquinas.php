<?php


require_once('../../conexion.php');
require_once('../../admin/sistema/php/crud.php');

//listar equipos de acuerdo con la linea

$query = "SELECT * FROM batch_equipos";
ejecutarQuerySelect($conn, $query);
