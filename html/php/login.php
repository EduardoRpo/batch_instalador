<?php

if (!empty($_SESSION['active'])) {
    header('location: html/batch.php');
} else {

    if (!empty($_POST)) {
        $alert = '';
        if (empty($_POST['usuario']) or empty($_POST['pass'])) {
            $alert = "Ingrese su usuario y password";
        } else {
            require_once('./conexion.php');
            $tries = file_get_contents('tries.txt');
            settype($tries, 'integer');
            $max_intentos = 5;

            if ($tries <= $max_intentos) {
                $usuario = $_POST['usuario'];
                $pass = md5($_POST['pass']);

                $sql = "SELECT * FROM usuario, modulo WHERE user = :usuario AND clave=:pass AND modulo.id=usuario.id_modulo";
                $query = $conn->prepare($sql);
                $query->execute(['usuario' => $usuario, 'pass' => $pass]);
                $rows = $query->rowCount();

                if ($rows > 0) {
                    $new_trie = 0;
                    file_put_contents('tries.txt', $new_trie);

                    $data = $query->fetch(PDO::FETCH_ASSOC);
                    $_SESSION['active'] = true;
                    $_SESSION['idUser'] = $data['id'];
                    $_SESSION['nombre'] = $data['nombre'];
                    $_SESSION['apellido'] = $data['apellido'];
                    $_SESSION['email'] = $data['email'];
                    $_SESSION['idModulo'] = $data['id_modulo'];
                    $_SESSION['cargo'] = $data['id_cargo'];
                    $_SESSION['modulo'] = $data['modulo'];
                    $_SESSION['rol'] = $data['rol'];
                    $_SESSION["timeout"] = time();
                    $modulo = $data['modulo'];

                    if ($data['rol'] == 1 || $data['rol'] == 2) {
                        header('location: admin/sistema/index.php');
                    } else/* if ($data['rol'] == 5) { */
                        header('location: html/batch.php');
                    /* } elseif ($data['rol'] == 3) {
                        header("location: {$modulo}");
                    } */
                } else {
                    $new_trie = ++$tries;
                    file_put_contents('tries.txt', $new_trie);
                    //session_destroy();
                }
            }
        }
    }
}
