<?php
  require_once('../../conexion.php');

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

    $modulo = $_POST['proceso'];
    
    $query_modulo = $conn -> query("SELECT * FROM modulo WHERE modulo = '$modulo'");
    $result = mysqli_num_rows($query_modulo);
      
    if($result > 0){
        while($modulo = mysqli_fetch_assoc($query_modulo)){
            $empaque[] = $modulo;
        }
        
        //$info = mysqli_fetch_assoc($query_envase);
        echo json_encode($empaque, JSON_UNESCAPED_UNICODE);
      
    }
    else{
      echo json_encode('');
    }
    
    mysqli_free_result($query_modulo);
    mysqli_close($conn);