<?php 
  require_once('../../../conexion.php');
  
  $op = $_POST['operacion'];

  switch($op){
    case 1: //listar parametros
      $query_parametros = mysqli_query($conn, "SELECT * FROM preguntas INNER JOIN modulo");

    /* SELECT p.id, p.pregunta, (m.id) as id_proceso, m.modulo 
    FROM preguntas p INNER JOIN modulo m INNER JOIN modulo_pregunta mp 
    ON p.id = mp.id_pregunta AND m.id = mp.id_modulo */
      
      $result = mysqli_num_rows($query_parametros);
      
      if($result > 0){
        while($data = mysqli_fetch_assoc($query_parametros)){
          $arreglo["data"][] =$data;
        }
        echo json_encode($arreglo, JSON_UNESCAPED_UNICODE);

      }else{
        echo false;
      }
      mysqli_free_result($query_parametros);
      mysqli_close($conn);
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

  }
  
  
?> 