<?php 

    require_once('../../conexion.php');

    $id_batch = $_POST['id'];

    $query_tanques = mysqli_query($conn, " SELECT tanque, cantidad
                                    FROM batch_tanques
                                    WHERE id_batch = '$id_batch'");
                                        

    $result = mysqli_num_rows($query_tanques);

    if($result > 0){
    while($data = mysqli_fetch_assoc($query_tanques)){
        $arreglo[] = $data;
    }
    
    echo json_encode($arreglo, JSON_UNESCAPED_UNICODE);

    }else{

        echo json_encode('');
    }
    
    mysqli_free_result($query_tanques);
    mysqli_close($conn);

?>
