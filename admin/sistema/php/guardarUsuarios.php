<?php 
    require_once('../../conexion.php');

    if(!empty($_POST)){
        $alert='';

        if(empty($_POST['nombre']) or empty($_POST['apellido']) or empty($_POST['email']) or empty($_POST['clave']) or      
            empty($_POST['modulo']) or empty($_POST['cargo'])){ 
               $alert = 'Todos los campos deben ser diligenciados.';
                //echo '<script>alertify.set("notifier","position", "top-right"); alertify.error("Todos los campos deben ser diligenciados.");</script>';
                
        }else{
            
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $email = $_POST['email'];
            $clave = md5($_POST['clave']);
            $modulo = $_POST['modulo'];
            $cargo = $_POST['cargo'];

            $query = mysqli_query($conn, "SELECT * FROM usuario WHERE email ='$email'");    
            $result = mysqli_fetch_array($query);

            if($result > 0){
               $alert ='El usuario ya existe';     
            }else{
                echo $query_insert = mysqli_query($conn,"INSERT INTO usuario (nombre, apellido, email, clave, id_modulo, id_cargo)
                                                    VALUES('$nombre', '$apellido', '$email', '$clave', '$modulo', '$cargo')");

                }
        }
    }   

?>
