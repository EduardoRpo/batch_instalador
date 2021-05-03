<?php

// obtener firma y huella del usuario

if (!empty($_POST)) {
  require_once('../../conexion.php');

  $user = $_POST['user'];
  $clave = md5($_POST['password']);
  $btn = $_POST['btn_id'];

  $sql = "SELECT id, CONCAT(nombre, ' ', apellido) as usuario, rol, urlfirma FROM usuario WHERE user = :user AND clave = :clave";
  $query = $conn->prepare($sql);
  $query->execute(['clave' => $clave, 'user' => $user]);
  $result = $query->rowCount();

  if ($result === 0) {
    echo '0';
  }

  if ($result > 0) {
    $data[] = $query->fetch(PDO::FETCH_ASSOC);

    if ($data[0]['rol'] !== 3 && $data[0]['rol'] !== 4) {
      echo '1';
      exit();
    }

    if ($btn === 'firma1' && $btn === 'firma3' && $data[0]['rol'] !== 3) {
      echo '1';
      exit();
    }

    if ($btn === 'firma2' && $btn === 'firma4' && $data[0]['rol'] !== 4) {
      echo '1';
      exit();
    }

    echo json_encode($data, JSON_UNESCAPED_UNICODE);
  }
}
