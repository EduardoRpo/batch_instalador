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

    $id_batch = $_POST['id'];
    
    $query_envase = $conn -> query("SELECT * FROM envase WHERE id_producto='$id_batch'");
    $result = mysqli_num_rows($query_envase);
      
    if($result > 0){
        while($envase = mysqli_fetch_assoc($query_envase)){
            $empaque[] = $envase;
        }
        
        //$info = mysqli_fetch_assoc($query_envase);
        echo json_encode($empaque, JSON_UNESCAPED_UNICODE);
      
    }
    else{
      echo json_encode('');
    }
    
    mysqli_free_result($query_envase);
    mysqli_close($conn);

  
?>