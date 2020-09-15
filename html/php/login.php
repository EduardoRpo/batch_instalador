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
            
            $usuario = $_POST['usuario'];
            $pass = md5($_POST['clave']);

            $sql = "SELECT * FROM usuario, modulo WHERE user = :usuario AND clave=:pass AND modulo.id=usuario.id_modulo";
            $query = $conn->prepare($sql);
            $query->execute(['usuario' => $usuario,'pass' => $pass]);
            $rows = $query->rowCount();

            if ($rows > 0) {
                $data = $query->fetch(PDO::FETCH_ASSOC);
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
                $alert = "El usuario o la contraseña no son validos";
                echo '<script>alertify.set("notifier","position", "top-right"); alertify.error("El usuario o contraseña no son validos.");</script>';
                session_destroy();
            }


        }
        
    }
}
