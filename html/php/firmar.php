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


// obtener firma y huella documento

    $email = $_POST['email'];
    $clave = md5($_POST['password']);
    //echo $email;
    //echo $clave;    
    
    //$query_firma = mysqli_query($conn, "SELECT * FROM usuario WHERE email = '$email' AND clave = '$clave'");
    $query_firma = $conn -> query("SELECT firma FROM usuario WHERE email = '$email' AND clave = '$clave'");
      
      $result = mysqli_num_rows($query_firma);
      
      if($result > 0){
        $info = mysqli_fetch_assoc($query_firma);
        $data = implode($info);
        $arreglo = base64_encode($data);
        //var_dump($arreglo);
        //exit();

        //$arreglo = base64_encode($data);
        
        //echo json_encode(utf8ize($arreglo));
        echo json_encode(utf8ize($arreglo), JSON_UNESCAPED_UNICODE);
        //json_encode($data, JSON_UNESCAPED_UNICODE);
        

      }else{
        echo json_encode('');
      }
      mysqli_free_result($query_firma);
      mysqli_close($conn);

  
?>