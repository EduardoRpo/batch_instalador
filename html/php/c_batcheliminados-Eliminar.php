<?php
require_once('../../conexion.php');
require_once('../../admin/sistema/php/crud.php');

$query = "SELECT * FROM batch 
          LEFT JOIN batch_eliminados be ON batch.id_batch = be.batch 
          WHERE estado = 0 ORDER BY `batch`.`id_batch` ASC";
ejecutarQuerySelect($conn, $query);

