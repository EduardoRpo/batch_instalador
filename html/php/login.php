<?php 

if(!empty($_SESSION['active'])){
    header('location: html/crear-batch.php');
}else{
    $alert = '';
    if(!empty($_POST)){
        if(empty($_POST['email']) or empty($_POST['clave'])){
            $alert="Ingrese su usuario y password";

        }else{
            require_once('./conexion.php');
            $email = mysqli_real_escape_string($conn,$_POST['email']); 
            $pass = md5(mysqli_real_escape_string($conn,$_POST['clave']));
            
            $query = mysqli_query($conn, "SELECT * FROM usuario WHERE email ='$email' AND clave='$pass'");
            $result = mysqli_num_rows($query);

            if($result>0){
                $data= mysqli_fetch_array($query);
                $_SESSION['active']=true;
                $_SESSION['idUser']=$data['id'];
                $_SESSION['nombre']=$data['nombre'];
                $_SESSION['apellido']=$data['apellido'];
                $_SESSION['email']=$data['email'];
                $_SESSION['idModulo']=$data['id_modulo'];
                $_SESSION['cargo']=$data['id_cargo'];
                
                header('location: html/batch.php');
            }else{
                $alert="El usuario o la contraseña no son validos";
                '<script>alertify.set("notifier","position", "top-right"); alertify.error("Para adicionar más tanques diligencia todos los campos vacios.");</script>';
                session_destroy();
            }
            
        }
    }
}

?>