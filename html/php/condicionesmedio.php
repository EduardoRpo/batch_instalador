<?php
if (!empty($_POST)) {
  require_once('../../conexion.php');
  require_once('../../admin/sistema/php/crud.php');


  $op = $_POST['operacion'];

  switch ($op) {
    case 1: // obtener el tiempo para mostrar modal
      $id_modulo = intval($_POST['modulo']);

      $query = "SELECT t_min, t_max 
              FROM condicionesmedio_tiempo 
              WHERE id_modulo = $id_modulo";

      ejecutarQuerySelect($conn, $query);
      break;

    case 2: // guardar Condiciones del Medio
      if (!empty($_POST)) {
        $temperatura = $_POST['temperatura'];
        $humedad =  $_POST['humedad'];  
        $modulo = $_POST['modulo'];
        $id_batch =  $_POST['id'];

        $sql = "INSERT INTO batch_condicionesmedio (fecha, temperatura, humedad, id_batch, id_modulo) 
                  VALUES( NOW() , :temperatura, :humedad, :id_batch, :modulo)";
        $query = $conn->prepare($sql);
        $result = $query->execute([
          'temperatura' => $temperatura,
          'humedad' => $humedad,
          'id_batch' => $id_batch,
          'modulo' => $modulo,
        ]);
        if ($result) 
          echo '1';
        else
          echo '2';

      }
      break;
  }
}
