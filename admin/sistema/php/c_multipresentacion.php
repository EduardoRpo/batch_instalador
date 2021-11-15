<?php
if (!empty($_POST)) {
  require_once('../../../conexion.php');
  require_once('./crud.php');

  $op = $_POST['operacion'];

  switch ($op) {
    case 1: //listar Productos
      $query = "SELECT referencia, nombre_referencia FROM producto ORDER BY nombre_referencia ASC";
      ejecutarQuerySelect($conn, $query);
      break;

    case 2: //Almacenar multipresentacion

      $multi = $_POST['multi'];
      $sinFormulas = [];

      /* Crea multipresentacion en productos */

      $sql = "SELECT MAX(multi) + 1 FROM producto";
      foreach ($conn->query($sql) as $row) {
        //print($row[0]);
      }

      /* Crea la multipresentacion para cada referencia */

      foreach ($multi as $valor) {
        $sql = "UPDATE producto SET multi = $row[0] WHERE referencia = :valor";
        $query = $conn->prepare($sql);
        $result = $query->execute(['valor' => $valor]);
        ejecutarQuery($result, $conn);
      }

      /* Revisar si existe formula para todas la referencias */

      foreach ($multi as $ref) {

        $sql = "SELECT f.id_producto, f.id_materiaprima as referencia, cast(AES_DECRYPT(porcentaje, 'Wf[Ht^}2YL=D^DPD') as char)porcentaje 
                FROM formula f WHERE f.id_producto = :id_producto";
        $query = $conn->prepare($sql);
        $query->execute(['id_producto' => $ref]);

        $rows = $query->rowCount();
        if ($rows > 0) {
          $formulas = $query->fetchAll(PDO::FETCH_ASSOC);
        }
        $sinFormulas[$ref] =  $rows;
      }

      /* insertar la formula para las referencias sin formula */
      
      foreach ($sinFormulas as $sinFormula => $value) {
        if ($value == 0) {
          foreach ($formulas as $formula) {
            $sql = "INSERT INTO formula (id_producto, id_materiaprima, porcentaje) 
                  VALUES (:id_producto, :id_materiaprima, AES_ENCRYPT(:porcentaje,'Wf[Ht^}2YL=D^DPD') )";
            $query = $conn->prepare($sql);
            $result = $query->execute([
              'id_producto' => $sinFormula,
              'id_materiaprima' => $formula['referencia'],
              'porcentaje' => $formula['porcentaje']
            ]);
          }
        }
      }

      break;

    case 3: //Eliminar

      $multi = $_POST['multi'];

      foreach ($multi as &$valor) {
        $sql = "UPDATE producto SET multi = 0 WHERE referencia = :valor";
        $query = $conn->prepare($sql);
        $result = $query->execute(['valor' => $valor]);
        ejecutarQuery($result, $conn);
      }



      break;

    case 4: //Buscar Multipresentacion

      $referencia = $_POST['referencia'];

      $sql = "SELECT referencia, nombre_referencia FROM producto WHERE multi = (SELECT multi FROM producto WHERE referencia = :referencia ) AND multi > 0";
      $query = $conn->prepare($sql);
      $result = $query->execute(['referencia' => $referencia]);

      if ($result) {
        while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
          $arreglo["data"][] = $data;
        }

        if (empty($arreglo)) {
          echo '3';
          exit();
        }
      } else {
        echo '2';
      }

      echo json_encode($arreglo, JSON_UNESCAPED_UNICODE);

      break;
    case 5:
      $referencia = $_POST['referencia'];

      $sql = "UPDATE producto SET multi='' WHERE referencia=:referencia";
      $query = $conn->prepare($sql);
      $result = $query->execute(['referencia' => $referencia]);

      break;

    case 6: //listar Multipresentacion

      $query = "SELECT referencia, nombre_referencia, multi FROM producto WHERE multi>0 ORDER BY nombre_referencia ASC";
      ejecutarQuerySelect($conn, $query);

      break;
  }
}
