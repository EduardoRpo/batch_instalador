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

// obtener firma y huella del usuario

    $linea = $_POST['linea'];
    
    /* $query_linea = $conn -> query("SELECT envasadora.nombre AS envasadora, loteadora.nombre as loteadora, marmita.nombre AS marmita, agitador.nombre AS agitador 
                                  FROM linea_maquinaria, envasadora, loteadora, marmita, agitador 
                                  WHERE (SELECT id FROM linea WHERE nombre_linea = '$linea') = id_linea 
                                  AND id_envasadora = envasadora.id AND id_loteadora = loteadora.id AND id_marmita = marmita.id AND id_agitador = agitador.id"); */
    
    $query_linea = $conn -> query("SELECT maquina 
                                  FROM maquinaria 
                                  WHERE (SELECT id FROM linea WHERE nombre_linea = '$linea') = linea  
                                  ORDER BY `maquinaria`.`maquina`  ASC");

    $result = mysqli_num_rows($query_linea);
    
    mysqli_close($conn);

    if($result > 0){

        while($data = mysqli_fetch_assoc($query_linea)){
          $arreglo[] = $data;
     
        }
        echo json_encode(utf8ize($arreglo), JSON_UNESCAPED_UNICODE);

      }else{
        echo json_encode('');
      }  

  
?>