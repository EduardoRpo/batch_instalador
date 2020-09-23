<?php 

    require_once('../../../conexion.php');
    
    if(isset($_GET['link-borrar'])){
        $id_usuario = $_GET['link-borrar'];

        $query_usuario = "DELETE FROM usuario WHERE id = $id_usuario";
        $result = mysqli_query($conn, $query_usuario);

        if($result){
            echo 'Eliminado con exito';
        }else{
            echo 'No eliminado';
        }
        //mysqli_free_result($query_pregunta);
        mysqli_close($conn);
    }

?>