<?php
  require_once('../../conexion.php');
  require_once('../../admin/sistema/php/crud.php');

  //listar Condiciones del medio

  $query = "SELECT id, nombre as linea FROM linea";
  ejecutarQuerySelect($conn, $query);

