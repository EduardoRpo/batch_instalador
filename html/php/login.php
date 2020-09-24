<?php

if (!empty($_SESSION['active'])) {
    header('location: html/batch.php');
} else {
<<<<<<< HEAD

    if (!empty($_POST)) {
        $alert = '';
=======
    $alert = '';
    if (!empty($_POST)) {
>>>>>>> bdcf3eded27049ef6a38761b92ec5a19772fac9b
        if (empty($_POST['usuario']) or empty($_POST['clave'])) {
            $alert = "Ingrese su usuario y password";
        } else {
            require_once('./conexion.php');

            $usuario = $_POST['usuario'];
            $pass = md5($_POST['clave']);

<<<<<<< HEAD
            print_r($usuario);

=======
>>>>>>> bdcf3eded27049ef6a38761b92ec5a19772fac9b
            $sql = "SELECT * FROM usuario, modulo WHERE user = :usuario AND clave=:pass AND modulo.id=usuario.id_modulo";
            $query = $conn->prepare($sql);
            $query->execute(['usuario' => $usuario, 'pass' => $pass]);
            $rows = $query->rowCount();

            if ($rows > 0) {
                $data = $query->fetch(PDO::FETCH_ASSOC);
<<<<<<< HEAD
                $_SESSION['estado'] = true;
=======
                $_SESSION['active'] = true;
>>>>>>> bdcf3eded27049ef6a38761b92ec5a19772fac9b
                $_SESSION['idUser'] = $data['id'];
                $_SESSION['nombre'] = $data['nombre'];
                $_SESSION['apellido'] = $data['apellido'];
                $_SESSION['email'] = $data['email'];
                $_SESSION['idModulo'] = $data['id_modulo'];
                $_SESSION['cargo'] = $data['id_cargo'];
                $_SESSION['modulo'] = $data['modulo'];
<<<<<<< HEAD
                $_SESSION['rol'] = $data['rol'];
                //$_SESSION['actividad'] = time();
                $modulo = $data['modulo'];

                if ($data['rol'] == 1) {
                    header('location: admin/sistema/index.php');
                } else if ($data['rol'] == 2) {
                    header('location: html/batch.php');
                } else if ($data['rol'] == 3) {
                    header("location: {$modulo}");
                } else {
                    header('location: admin/sistema/index.php');
=======
                $modulo = $data['modulo'];

                if ($data['id_modulo'] == 0) {
                    header('location: admin/sistema/index.php');
                } else if ($data['id_modulo'] == 1) {
                    header('location: html/batch.php');
                } else {
                    header("location: {$modulo}");
>>>>>>> bdcf3eded27049ef6a38761b92ec5a19772fac9b
                }
            } else {
                $alert = "El usuario o la contraseña no son validos";
                echo '<script>alertify.set("notifier","position", "top-right"); alertify.error("El usuario o contraseña no son validos.");</script>';
                session_destroy();
            }
        }
    }
}
