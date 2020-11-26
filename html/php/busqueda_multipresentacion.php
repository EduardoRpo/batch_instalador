<?php
  require_once('../../conexion2.php');

  function utf8ize($d) {
    if (is_array($d)) 
        foreach ($d as $k => $v) 
            $d[$k] = utf8ize($v);

     else if(is_object($d))
        foreach ($d as $k => $v) 
            $d->$k = utf8ize($v);

     else 
        return utf8_encode($d);

    return $d;
    }

// Buscar mulipresentacion para cargar en observaciones

    $id_batch = $_POST['id'];

    $query_busq_multi = $conn -> query("SELECT m.id, m.id_batch, m.referencia, p.nombre_referencia, pc.nombre as presentacion, m.cantidad 
                                        FROM multipresentacion m INNER JOIN producto p INNER JOIN presentacion_comercial pc 
                                        ON m.referencia = p.referencia AND p.id_presentacion_comercial = pc.id 
                                        WHERE m.id_batch='$id_batch'");
    
    $result = mysqli_num_rows($query_busq_multi);
    mysqli_close($conn);
      
    if($result > 0){
        while($data = mysqli_fetch_assoc($query_busq_multi)){
          $arreglo[] = $data;
        }
        echo json_encode($arreglo, JSON_UNESCAPED_UNICODE);

      }else{
        echo json_encode('');
      }
