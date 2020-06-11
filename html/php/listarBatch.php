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
    case 1: //listar Batch

      $proceso = $_POST['proceso'];
      //echo $proceso;
      //exit();

      if($proceso==2){
        $query_batch = mysqli_query($conn, 'SELECT batch.id_batch, batch.numero_orden, producto.referencia, producto.nombre_referencia, presentacion_comercial.presentacion,batch.numero_lote, batch.tamano_lote, propietario.nombre,batch.fecha_creacion, batch.fecha_programacion, batch.estado
                                            FROM batch INNER JOIN producto INNER JOIN presentacion_comercial INNER JOIN propietario
                                            ON batch.id_producto = producto.referencia AND producto.id_presentacion_comercial = presentacion_comercial.id AND producto.id_propietario = propietario.id
                                            WHERE estado=1
                                            ORDER BY batch.id_batch desc; ');
      }else{ 
      $query_batch = mysqli_query($conn, 'SELECT batch.id_batch, batch.numero_orden, producto.referencia, producto.nombre_referencia, presentacion_comercial.presentacion,batch.numero_lote, batch.tamano_lote, propietario.nombre,batch.fecha_creacion, batch.fecha_programacion, batch.estado
                                            FROM batch INNER JOIN producto INNER JOIN presentacion_comercial INNER JOIN propietario
                                            ON batch.id_producto = producto.referencia AND producto.id_presentacion_comercial = presentacion_comercial.id AND producto.id_propietario = propietario.id
                                            ORDER BY batch.id_batch desc;');
      }

      $result = mysqli_num_rows($query_batch);
      
      if($result > 0){
        while($data = mysqli_fetch_assoc($query_batch)){
          $arreglo["data"][] =$data;
        }
        
        echo json_encode(utf8ize($arreglo), JSON_UNESCAPED_UNICODE);

        exit();

      }else{
        echo json_encode('');
      }
      mysqli_free_result($query_batch);
      mysqli_close($conn);
    
    break;

    case 2: //Eliminar
      $id_batch = $_POST['id'];
      
        $query_batch = "DELETE FROM batch WHERE id_batch = $id_batch";
        $result = mysqli_query($conn, $query_batch);

        if($result){
            echo 'Eliminado';
        }else{
            echo 'No Eliminado';
        }
        mysqli_free_result($query_batch);
        mysqli_close($conn);
    break;

    case 3: //cargar selector de referencias
      
      $query_referencia = mysqli_query($conn, "SELECT @curRow := @curRow + 1 AS id, referencia FROM producto JOIN (SELECT @curRow := 0) r");
    
      $result = mysqli_num_rows($query_referencia);
      
      if($result > 0){
        while($data = mysqli_fetch_assoc($query_referencia)){
          $arreglo[] = $data;}
        
          echo json_encode(utf8ize($arreglo), JSON_UNESCAPED_UNICODE);
          //echo json_encode($arreglo, JSON_UNESCAPED_UNICODE);
      }else{
        echo json_encode('');
      }
      mysqli_free_result($query_referencia);
      mysqli_close($conn);
    break;

    case 4: //recargar datos de acuerdo con seleccion de referencia
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
  
    case 5: // Guardar
      $cantidad = $_POST['cantidad'];
      $id = $_POST['ref'];
      //$nombreReferencia = $_POST['nref'];
      $unidadesxlote = $_POST['unidades'];
      $tamanototallote = $_POST['lote'];
      $fechaprogramacion = $_POST['programacion'];
      $fechahoy = $_POST['fecha'];
      $tamanolotepresentacion = $_POST['presentacion'];

      if ($fechaPrograma = "") {
       $estado = 'null';
      } else {
        $estado = '1';
      }
      $i = 1;
      
      $query = "INSERT INTO batch (fecha_creacion, fecha_programacion, fecha_actual, numero_orden, numero_lote, tamano_lote, lote_presentacion, unidad_lote, estado, id_producto) 
			VALUES ('$fechahoy',";
      $query .= $fechaprogramacion != null ? "'$fechaprogramacion'" : "NULL";
      $query .= ",'$fechahoy', 'OP012020',' X0010320', '$tamanototallote', '$tamanolotepresentacion', '$unidadesxlote', '$estado', '$id')";


      if(isset($cantidad)){
                
        while($i <= $cantidad){
          $result = mysqli_query($conn, $query); //or die ("Problemas al insertar" . mysqli_error($conn));    
          $i++;
        }
      }
     

      if(!$result){
        die('Error');
      }else{
        echo 'Almacenado';
      } 
    break;

    case 6: //Cargar datos para Actualizar
      $id_batch = $_POST['id'];

        $query_buscar = mysqli_query($conn,"SELECT bt.id_batch, p.referencia, p.nombre_referencia, m.nombre as marca, pp.nombre as propietario, np.nombre_producto, pc.presentacion, linea.nombre_linea as linea, linea.densidad, ns.notificacion_sanitaria, bt.unidad_lote, bt.tamano_lote, bt.fecha_programacion 
                                          FROM producto p INNER JOIN marca m INNER JOIN propietario pp INNER JOIN nombre_producto np INNER JOIN presentacion_comercial pc INNER JOIN linea INNER JOIN notificacion_sanitaria ns INNER JOIN batch bt 
                                          ON p.id_marca=m.id AND p.id_propietario=pp.id AND p.id_nombre_producto=np.id AND p.id_presentacion_comercial=pc.id AND p.id_linea=linea.id AND p.id_notificacion_sanitaria=ns.id AND bt.id_producto=p.referencia 
                                          WHERE bt.id_batch= $id_batch");

        $data = mysqli_fetch_assoc($query_buscar);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        mysqli_close($conn);
    break;

    case 7: //Actualiza datos
      $id_batch = $_POST['ref'];
      $unidades = $_POST['unidades'];
      $lote = $_POST['lote'];
      $programacion = $_POST['programacion'];

      $query_actualizar = "UPDATE batch SET unidad_lote = '$unidades', tamano_lote = '$lote', fecha_programacion = '$programacion'
                           WHERE id_batch ='$id_batch'";
    
      $result = mysqli_query($conn, $query_actualizar);

      if($result){
        echo "Exitoso";
      }else{
        echo "Error";  
      }

      mysqli_free_result($query_actualizar);
      mysqli_close($conn); 
  
    break;
    
    case 8: //carga modal Multipresentacion
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

    case 9: // cargar selector de Tanques
      $query_tanque = mysqli_query($conn, 'SELECT capacidad FROM tanques');
    
      $result = mysqli_num_rows($query_tanque);
      
      if($result > 0){
        while($data = mysqli_fetch_assoc($query_tanque)){
          $arreglo[] = $data;}
        
          echo json_encode(utf8ize($arreglo), JSON_UNESCAPED_UNICODE);
          //echo json_encode($arreglo, JSON_UNESCAPED_UNICODE);
      }else{
        echo json_encode('');
      }
      mysqli_free_result($query_tanque);
      mysqli_close($conn);
    
    break;

    case 10: // Clonar Batch
      $id_batch = $_POST['id'];
      //echo $id_batch;
      
      $query_clonar = mysqli_query($conn, "SELECT * FROM batch WHERE id_batch = $id_batch");
      $result = mysqli_num_rows($query_clonar);

      if($result > 0){
        //while(){
          $data = mysqli_fetch_assoc($query_clonar);
          $arreglo[] = $data;
        //}
          echo json_encode(utf8ize($arreglo), JSON_UNESCAPED_UNICODE);
          //echo $arreglo[0];           
      }else{
        echo json_encode('');
      }
      exit();
      

      

      /* if ($fechaPrograma = "") {
       $estado = 'null';
      } else {
        $estado = '1';
      }

      $query = "INSERT INTO batch (fecha_creacion, fecha_programacion, fecha_actual, numero_orden, numero_lote, tamano_lote, lote_presentacion, unidad_lote, estado, id_producto) 
			VALUES ('$fechahoy',";
      $query .= $fechaprogramacion != null ? "'$fechaprogramacion'" : "NULL";
      $query .= ",'$fechahoy', 'OP012020',' X0010320', '$tamanototallote', '$tamanolotepresentacion', '$unidadesxlote', '$estado', '$id')";

      $result = mysqli_query($conn, $query); //or die ("Problemas al insertar" . mysqli_error($conn));

      if(!$result){
        die('Error');
      }else{
        echo 'Almacenado';
      }   */     

    break;

  }
?>

  