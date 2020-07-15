<?php 

    require_once('../../conexion.php');

    $fecha_busqueda = $_POST['busqueda'];
    $fecha_inicio = $_POST['inicio'];
    $fecha_final = $_POST['final'];

    /* echo $fecha_busqueda;
    echo $fecha_inicio;
    echo $fecha_final; */

    $query_filtro = mysqli_query($conn, "SELECT batch.id_batch, batch.numero_orden, producto.referencia, producto.nombre_referencia, presentacion_comercial.presentacion,batch.numero_lote, batch.tamano_lote, propietario.nombre,batch.fecha_creacion, batch.fecha_programacion, batch.estado, batch.multi
                                        FROM batch INNER JOIN producto INNER JOIN presentacion_comercial INNER JOIN propietario
                                        ON batch.id_producto = producto.referencia AND producto.id_presentacion_comercial = presentacion_comercial.id AND producto.id_propietario = propietario.id
                                        WHERE $fecha_busqueda BETWEEN '$fecha_inicio' AND '$fecha_final'
                                        ORDER BY batch.id_batch desc");
                                        

    $result = mysqli_num_rows($query_filtro);

    if($result > 0){
    while($data = mysqli_fetch_assoc($query_filtro)){
        $arreglo[] = $data;
    }
    
    echo json_encode($arreglo, JSON_UNESCAPED_UNICODE);

    }else{

        echo json_encode('');
    }
    
    mysqli_free_result($query_filtro);
    mysqli_close($conn);

?>