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


$op = $_POST['operacion'];

switch($op){
  case 1: // obtener el tiempo para mostrar modal
    $id_modulo = intval($_POST['modulo']);
    
    $query_tiempo = mysqli_query($conn, "SELECT t_min, t_max 
                                         FROM condicionesmedio_tiempo 
                                         WHERE id_modulo = $id_modulo");
    
    $result = mysqli_num_rows($query_tiempo);
    
    if($result > 0){
    $data = mysqli_fetch_assoc($query_tiempo);
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    else{
    echo json_encode('');
    }
    
    mysqli_free_result($query_tiempo);
    mysqli_close($conn);
  
  break;

  case 2: // guardar Condiciones del Medio
    $nombre_modulo = $_POST['modulo'];
    $temperatura = $_POST['temperatura'];
    $humedad =  $_POST['humedad'];
    $id_batch =  $_POST['id'];

    $query_condicioneMedio = "INSERT INTO condicionesmedio (fecha, temperatura, humedad, id_batch, id_modulo) 
                              VALUES( NOW() , '$temperatura', '$humedad', '$id_batch', (SELECT modulo.id FROM modulo WHERE modulo.modulo = '$nombre_modulo') )";

    $result = mysqli_query($conn, $query_condicioneMedio);
    
    if(!$result){
        die('Error');
        echo 'No guardado. Error: '.mysqli_error($conn);
      }else{
        echo 'Almacenado';
      } 
    
    mysqli_free_result($query_tiempo);
    mysqli_close($conn);
  break;

}

    

?>