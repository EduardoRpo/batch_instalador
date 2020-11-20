<?php

//obtener los instructivos

if (!empty($_POST)) {
    require_once('../../conexion.php');
    require_once('../../admin/sistema/php/crud.php');
      
    $referencia = $_POST['referencia'];
    
    $sql = "SELECT * FROM `instructivo_preparacion` WHERE id_producto = :referencia";
    $query = $conn->prepare($sql);
    $query->execute(['referencia' => $referencia]);
    $result = $query->rowCount();
  
    if ($result > 0) {
      $data = $query->fetch(PDO::FETCH_ASSOC);
      $arreglo[] = $data;
      echo json_encode($arreglo, JSON_UNESCAPED_UNICODE);
    }
  }
