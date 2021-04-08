<?php
require_once('../../conexion.php');
require_once('../../admin/sistema/php/crud.php');

$query = "SELECT * FROM batch WHERE estado = 0";
ejecutarQuerySelect($conn, $query);

