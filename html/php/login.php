<?php

if (!empty($_SESSION['active'])) {
    header('location: html/batch.php');
} else {
    $alert = '';
    if (!empty($_POST)) {
        if (empty($_POST['usuario']) or empty($_POST['clave'])) {
            $alert = "Ingrese su usuario y password";
        } else {
            require_once('./conexion.php');
            $usuario = mysqli_real_escape_string($conn, $_POST['usuario']);
            $pass = md5(mysqli_real_escape_string($conn, $_POST['clave']));

            $query = mysqli_query($conn, "SELECT * 
                                          FROM usuario, modulo 
                                          WHERE user ='$usuario' AND clave='$pass' AND modulo.id=usuario.id_modulo");

            $result = mysqli_num_rows($query);
            mysqli_close($conn);

            if ($result > 0) {
                $data = mysqli_fetch_array($query);
                $_SESSION['active'] = true;
                $_SESSION['idUser'] = $data['id'];
                $_SESSION['nombre'] = $data['nombre'];
                $_SESSION['apellido'] = $data['apellido'];
                $_SESSION['email'] = $data['email'];
                $_SESSION['idModulo'] = $data['id_modulo'];
                $_SESSION['cargo'] = $data['id_cargo'];
                $_SESSION['modulo'] = $data['modulo'];
                $modulo = $data['modulo'];
                
                if ($data['id_modulo'] == 1) {
                    header('location: html/batch.php');
                } else {
                    header("location: {$modulo}");
                }
            } else {
                //$alert = "El usuario o la contraseña no son validos";
                echo '<script>alertify.set("notifier","position", "top-right"); alertify.error("El usuario o contraseña no son validos.");</script>';
                session_destroy();
            }
        }
    }
}
