<?php
//include('/Desarrollo/BatchRecord/htdocs/conexion.php');
require_once('../../conexion2.php');
require_once('../../conexion.php');

function utf8ize($d)
{
  if (is_array($d))
    foreach ($d as $k => $v)
      $d[$k] = utf8ize($v);

  else if (is_object($d))
    foreach ($d as $k => $v)
      $d->$k = utf8ize($v);

  else
    return utf8_encode($d);

  return $d;
}


$op = $_POST['operacion'];

switch ($op) {
  case 1: //Cargar Select Multipresentacion
    $referencia = $_POST['id'];

    $sql = "SELECT multi FROM producto WHERE referencia = :referencia";
    $query = $conn->prepare($sql);
    $query->execute(['referencia' => $referencia]);
    $ids = $query->fetchAll($conn::FETCH_ASSOC);
    foreach ($ids as $id)
      $multi = $id['multi'];

    $rows = $query->rowCount();

    if ($rows > 0 && $multi != 0) {
      $sql = "SELECT p.referencia, p.nombre_referencia FROM producto p WHERE multi = :multi";
      $query = $conn->prepare($sql);
      $query->execute(['multi' => $multi]);
      $id_multi = $query->fetchAll($conn::FETCH_ASSOC);
      echo json_encode($id_multi, JSON_UNESCAPED_UNICODE);
    } else {
      echo '3';
    }

    break;

  case 2: //seleccionar ID para Cargar datos de acuerdo con la selección de multipresentación
    $nombre_referencia = $_POST['nombre_referencia'];

    $sql = "SELECT referencia FROM `producto` WHERE nombre_referencia = :nombre_referencia";
    $query = $conn->prepare($sql);
    $query->execute(['multi' => $nombre_referencia]);
    $nombres_ref = $query->fetchAll($conn::FETCH_ASSOC);
    echo json_encode($nombres_ref, JSON_UNESCAPED_UNICODE);

    break;

  case 3: //recargar datos de acuerdo con seleccion de referencia
    $referencia = $_POST['referencia'];

    $sql = "SELECT p.referencia, p.nombre_referencia as nombre, m.nombre as marca, ns.nombre as notificacion, pp.nombre as propietario, np.nombre as producto, pc.nombre as presentacion, l.nombre as linea, l.densidad 
            FROM producto p INNER JOIN marca m INNER JOIN notificacion_sanitaria ns INNER JOIN propietario pp INNER JOIN nombre_producto np INNER JOIN linea l INNER JOIN presentacion_comercial pc
            ON p.id_marca = m.id AND p.id_notificacion_sanitaria = ns.id AND p.id_propietario=pp.id AND p.id_nombre_producto= np.id AND p.id_linea=l.id AND pc.id = p.presentacion_comercial
            WHERE p.referencia = :referencia";
    $query = $conn->prepare($sql);
    $query->execute(['referencia' => $referencia]);
    $nombres_ref = $query->fetchAll($conn::FETCH_ASSOC);
    echo json_encode($nombres_ref, JSON_UNESCAPED_UNICODE);

    break;

  case 4: // Guardar Multipresentacion
    $nom_referencia = $_POST['ref'];
    $cantidad       = $_POST['cant'];
    $total          = $_POST['tot'];
    $id_batch       = $_POST['id'];

    $tmn = sizeof($nom_referencia);

    for ($i = 0; $i < $tmn; ++$i) {

      $sql = "INSERT INTO multipresentacion (id_batch, referencia, cantidad, total) 
              SELECT :id_batch, referencia, :cantidad, :total 
              FROM producto 
              WHERE nombre_referencia = :nombre_referencia";
      $query = $conn->prepare($sql);
      $query->execute([
        'nombre_referencia' => $nom_referencia[$i],
        'id_batch' => $id_batch,
        'cantidad' => $cantidad[$i],
        'total' => $total[$i]
      ]);
    }

    $sql = "UPDATE batch SET multi = '1' WHERE id_batch= :id_batch";
    $query = $conn->prepare($sql);
    $result = $query->execute(['id_batch' => $id_batch,]);

    if (!$result) {
      die('Error');
      echo 'No guardado. Error: ' . mysqli_error($conn);
    } else {
      echo 'Almacenado';
    }

    break;

  case 5: //Guardar Actualizacion
    break;

  case 6: // Cargar datos para actualizar Multipresentacion
    $batch = $_POST['id'];

    $sql = "SELECT * FROM multipresentacion WHERE id_batch = :batch";
    $query = $conn->prepare($sql);
    $query->execute(['batch' => $batch]);
    $multi = $query->fetchAll($conn::FETCH_ASSOC);
    echo json_encode($multi, JSON_UNESCAPED_UNICODE);

    break;
}
