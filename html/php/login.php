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

            $query = mysqli_query($conn, "SELECT * FROM usuario WHERE user ='$usuario' AND clave='$pass'");
            mysqli_close($conn);

            $result = mysqli_num_rows($query);

            if ($result > 0) {
                $data = mysqli_fetch_array($query);
                $_SESSION['active'] = true;
                $_SESSION['idUser'] = $data['id'];
                $_SESSION['nombre'] = $data['nombre'];
                $_SESSION['apellido'] = $data['apellido'];
                $_SESSION['email'] = $data['email'];
                $_SESSION['idModulo'] = $data['id_modulo'];
                $_SESSION['cargo'] = $data['id_cargo'];

                switch ($_SESSION['idModulo']) {
                    case 1:
                        header('location: html/batch.php');
                        break;
                    case 2:
                        header('location: pesaje');
                        break;
                    case 3:
                        header('location: preparacion');
                        break;
                    case 4:
                        header('location: aprobacion');
                        break;
                }
            } else {
                $alert = "El usuario o la contraseña no son validos";
                echo '<script>alertify.set("notifier","position", "top-right"); alertify.error("El usuario o contraseña no son validos.");</script>';
                session_destroy();
            }
        }
    }
}
