<?php
require_once('../../../conexion.php');
require_once('./crud.php');

$op = $_POST['operacion'];

switch ($op) {
  case 1: //listar Productos
    $query = "SELECT referencia, nombre_referencia FROM producto ORDER BY nombre_referencia ASC";
    ejecutarQuerySelect($conn, $query);
    break;

  case 2: //Almacenar multipresentacion

    if (!empty($_POST)) {
      $multi = $_POST['multi'];

      $sql = "SELECT MAX(multi) + 1 FROM producto";
      foreach ($conn->query($sql) as $row) {
        //print($row[0]);
      }

      foreach ($multi as &$valor) {
        $sql = "UPDATE producto SET multi = $row[0] WHERE referencia = :valor";
        $query = $conn->prepare($sql);
        $result = $query->execute(['valor' => $valor]);
        ejecutarQuery($result, $conn);
      }
    }
    break;

  case 3: //Eliminar
    if (!empty($_POST)) {
      $multi = $_POST['multi'];


      foreach ($multi as &$valor) {
        $sql = "UPDATE producto SET multi = 0 WHERE referencia = :valor";
        $query = $conn->prepare($sql);
        $result = $query->execute(['valor' => $valor]);
        ejecutarQuery($result, $conn);
      }
    }
    break;

  case 4: //Buscar Multipresentacion
    if (!empty($_POST)) {
      $referencia = $_POST['referencia'];

      $sql = "SELECT referencia, nombre_referencia FROM producto WHERE multi = (SELECT multi FROM producto WHERE referencia = :referencia ) AND multi > 0";
      $query = $conn->prepare($sql);
      $result = $query->execute(['referencia' => $referencia]);

      if ($result) {
        while ($data = $query->fetch(PDO::FETCH_ASSOC))
          $arreglo["data"][] = $data;

        if (empty($arreglo)) {
          echo '3';
          exit();
        }
      } else
        echo '2';

      echo json_encode(utf8ize($arreglo), JSON_UNESCAPED_UNICODE);
    }
    break;
}
