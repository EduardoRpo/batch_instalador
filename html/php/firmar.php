<?php
require_once('../../conexion.php');
require_once('../../admin/sistema/php/crud.php');

// obtener firma y huella del usuario

if (!empty($_POST)) {
  $user = $_POST['user'];
  $clave = md5($_POST['password']);

  $sql = "SELECT urlfirma FROM usuario WHERE user = :user AND clave = :clave";
  $query = $conn->prepare($sql);
  $query->execute(['clave' => $clave, 'user' => $user]);
  $result = $query->rowCount();

  if ($result > 0) {
    $data = $query->fetch(PDO::FETCH_ASSOC);
    $arreglo[] = $data;
    echo json_encode(utf8ize($arreglo), JSON_UNESCAPED_UNICODE);
  }
}
