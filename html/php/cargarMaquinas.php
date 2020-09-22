<?php

if (!empty($_POST)) {
  require_once('../../conexion.php');
  require_once('../../admin/sistema/php/crud.php');

  //listar equipos de acuerdo con la linea

  $linea = $_POST['linea'];

  $query = "SELECT maquina FROM maquinaria WHERE linea = $linea ORDER BY `maquinaria`.`maquina` ASC";
  ejecutarQuerySelect($conn, $query);
}
