<?php
require_once('../../../conexion.php');
  
$op = $_POST['operacion'];

switch($op){
  case 1: //listar Equipos
    $query_lineas = mysqli_query($conn, "SELECT m.id, m.maquina, l.nombre_linea 
                                        FROM maquinaria m 
                                        INNER JOIN linea l ON l.id = m.linea 
                                        ORDER BY m.id ASC");
    
    $result = mysqli_num_rows($query_lineas);
    
    mysqli_close($conn);

    if($result > 0){
      while($data = mysqli_fetch_assoc($query_lineas)){
        $arreglo["data"][] =$data;
      }
      echo json_encode($arreglo, JSON_UNESCAPED_UNICODE);

    }else{
      echo false;
    }
    mysqli_free_result($query_lineas);
    
  break;

  case 2: //Eliminar
    $id_pregunta = $_POST['id'];

      $query_pregunta = "DELETE FROM preguntas WHERE id = $id_pregunta";
      $result = mysqli_query($conn, $query_pregunta);

      if($result){
          echo 'Eliminado';
      }else{
          echo 'No Eliminado';
      }
      //mysqli_free_result($query_pregunta);
      mysqli_close($conn);
  break;

  case 3: // obtener data
    $id_pregunta = $_POST['id'];

      $query = mysqli_query($conn,"SELECT * FROM preguntas WHERE id = $id_pregunta");
      $data = mysqli_fetch_assoc($query);
      echo json_encode($data, JSON_UNESCAPED_UNICODE);
      mysqli_close($conn);

  break;

  case 4: //listar lineas
    $query_lineas = mysqli_query($conn, "SELECT id, nombre_linea as linea FROM linea");
    
    $result = mysqli_num_rows($query_lineas);
    
    mysqli_close($conn);

    if($result > 0){
      while($data = mysqli_fetch_assoc($query_lineas)){
        //$arreglo["data"][] =$data;
        $arreglo[] = $data;
      }
      echo json_encode($arreglo, JSON_UNESCAPED_UNICODE);

    }else{
      echo false;
    }
    mysqli_free_result($query_lineas);
    
  break;

  case 5: //Eliminar
    $id_pregunta = $_POST['id'];

      $query_pregunta = "DELETE FROM preguntas WHERE id = $id_pregunta";
      $result = mysqli_query($conn, $query_pregunta);

      if($result){
          echo 'Eliminado';
      }else{
          echo 'No Eliminado';
      }
      //mysqli_free_result($query_pregunta);
      mysqli_close($conn);
  break;

  case 6: // obtener data
    $id_pregunta = $_POST['id'];

      $query = mysqli_query($conn,"SELECT * FROM preguntas WHERE id = $id_pregunta");
      $data = mysqli_fetch_assoc($query);
      echo json_encode($data, JSON_UNESCAPED_UNICODE);
      mysqli_close($conn);

  break;

}