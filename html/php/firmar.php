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

    $user = $_POST['user'];
    $clave = md5($_POST['password']);

    $query_firma = $conn -> query("SELECT urlfirma FROM usuario WHERE user = '$user' AND clave = '$clave'");
    $result = mysqli_num_rows($query_firma);
      
    if($result > 0){
      $info = mysqli_fetch_assoc($query_firma);
      echo json_encode($info, JSON_UNESCAPED_UNICODE);
    }
    else{
      echo json_encode('');
    }
    
    mysqli_free_result($query_firma);
    mysqli_close($conn);

  
?>