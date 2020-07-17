<?php
  //include('/Desarrollo/BatchRecord/htdocs/conexion.php');
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


    $op = $_POST['operacion'];

   switch($op){
    case 1: //Cargar Select Multipresentacion
        $id_batch = $_POST['id'];
    
        $query_nref = mysqli_query($conn, "SELECT @curRow := @curRow + 1 AS id, nombre_referencia FROM producto JOIN (SELECT @curRow := 0) r WHERE multi = 
                                          (SELECT multi FROM producto WHERE producto.referencia = 
                                          (SELECT batch.id_producto FROM batch WHERE batch.id_batch = $id_batch)) AND multi>0");
      
        $result = mysqli_num_rows($query_nref);
        
        if($result > 0){
  
          while($data = mysqli_fetch_assoc($query_nref)){
            $arreglo[] = $data;
       
          }
          
          echo json_encode(utf8ize($arreglo), JSON_UNESCAPED_UNICODE);
          //echo json_encode($arreglo, JSON_UNESCAPED_UNICODE);
          //exit();
  
        }else{
          echo json_encode('');
        }  
     
    
    break;

    case 2: //seleccionar ID para Cargar datos de acuerdo con la selección de multipresentación
      $nombre_referencia = $_POST['nombre_referencia'];
      
      $query_producto = mysqli_query($conn, "SELECT referencia FROM `producto` WHERE nombre_referencia='$nombre_referencia'");
                                             
      $result = mysqli_num_rows($query_producto);

      if($result > 0){

        while($data = mysqli_fetch_assoc($query_producto)){
          $arreglo[] = $data;}
        
        echo json_encode($arreglo, JSON_UNESCAPED_UNICODE);

      }else{
        echo json_encode('');
      }  


    break;

    case 3: //recargar datos de acuerdo con seleccion de referencia
        $id_referencia = $_POST['id'];
        
        $query_producto = mysqli_query($conn, "SELECT p.referencia, p.nombre_referencia as nombre, m.nombre as marca, ns.notificacion_sanitaria, pp.nombre as propietario, np.nombre_producto as producto, pc.presentacion, l.nombre_linea as linea, l.densidad 
                                               FROM producto p INNER JOIN marca m INNER JOIN notificacion_sanitaria ns INNER JOIN propietario pp INNER JOIN nombre_producto np INNER JOIN presentacion_comercial pc INNER JOIN linea l 
                                               ON p.id_marca = m.id AND p.id_notificacion_sanitaria = ns.id AND p.id_propietario=pp.id AND p.id_nombre_producto= np.id AND p.id_presentacion_comercial=pc.id AND p.id_linea=l.id 
                                               WHERE p.referencia = $id_referencia");
                                               
        $result = mysqli_num_rows($query_producto);
  
        if($result > 0){
  
          while($data = mysqli_fetch_assoc($query_producto)){
            $arreglo[] = $data;}
          
          echo json_encode($arreglo, JSON_UNESCAPED_UNICODE);
  
        }else{
          echo json_encode('');
        }  
                                         
    break;

    case 4: // Guardar Multipresentacion
        $nom_referencia = $_POST['ref'];
        $cantidad       = $_POST['cant'];
        $id_batch       = $_POST['id'];

        $tmn = sizeof($nom_referencia);

        for($i=0; $i <= $tmn; ++$i){
          //$query_tanque = "INSERT INTO batch_tanques (tanque, cantidad, id_batch) VALUES('$tanque[$i]' , '$tamanotqn[$i]', '$id')";
          
            $query_id_referencia = "INSERT INTO multipresentacion (id_batch, referencia, cantidad) 
                                    SELECT '$id_batch', referencia, '$cantidad[$i]' 
                                    FROM producto 
                                    WHERE nombre_referencia = '$nom_referencia[$i]'";                                
          
          $result = mysqli_query($conn, $query_id_referencia);
          
        }

        $query_batch_multi = "  UPDATE batch 
                                  SET multi = '1' 
                                  WHERE id_batch='$id_batch'";
        
        $result1 = mysqli_query($conn, $query_batch_multi);      
        
        if(!$result){
          die('Error');
          echo 'No guardado. Error: '.mysqli_error($conn);
        }else{
          echo 'Almacenado';
        } 
  
    break;
  
    case 5: //Guardar Actualizacion
    break;

    case 6: // Cargar datos para actualizar Multipresentacion
      $id_batch = $_POST['id'];
    
        $query_multi = mysqli_query($conn, "SELECT multipresentacion.id, multipresentacion.id_batch, multipresentacion.referencia, producto.nombre_referencia, multipresentacion.cantidad, densidad, presentacion_comercial.presentacion 
                                            FROM multipresentacion INNER JOIN producto INNER JOIN linea INNER JOIN presentacion_comercial
                                            ON multipresentacion.referencia = producto.referencia AND producto.id_linea = linea.id AND producto.id_presentacion_comercial=presentacion_comercial.id
                                            WHERE id_batch='$id_batch'");
      
        $result = mysqli_num_rows($query_multi);
        
        if($result > 0){
  
          while($data = mysqli_fetch_assoc($query_multi)){
            $arreglo[] = $data;
       
          }
          
          echo json_encode(utf8ize($arreglo), JSON_UNESCAPED_UNICODE);
          //echo json_encode($arreglo, JSON_UNESCAPED_UNICODE);
          //exit();
  
        }/* else{
          echo json_encode('');
        }  
 */

    break;
}
?>