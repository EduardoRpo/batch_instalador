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
                    $rol = $data['rol'];

                    if ($rol === 1 || $rol == 2)
                        $variable = 1;
                    else {
                        $modulo = $data['id_modulo'];
                        $variable = $rol . $modulo;
                    }

                    switch ($variable) {
                        case '1':
                            header('location: admin/sistema/index.php');
                            break;
                        case '31':
                            header('location: /html/batch.php');
                            break;
                        case '32':
                            header('location: /pesaje');
                            break;
                        case '33':
                            header('location: /preparacion');
                            break;
                        case '34':
                            header('location: /aprobacion');
                            break;
                        case '35':
                            header('location: /envasado');
                            break;
                        case '36':
                            header('location: /acondicionamiento');
                            break;
                        case '37':
                            header('location: /despachos');
                            break;
                        case '38':
                            header('location: /microbiologia');
                            break;
                        case '39':
                            header('location: /fisicoquimica');
                            break;
                        case '310':
                            header('location: /liberacionlote');
                            break;
                    }

                    /*  if ($data['rol'] == 1 || $data['rol'] == 2) {
                    } else
                        header('location: html/batch.php'); */
                } else {
                    $new_trie = ++$tries;
                    file_put_contents('tries.txt', $new_trie);
                    $alert = "Su usuario y/o password no son correctos";
                    //session_destroy();
                }
            } else
                $alert = "Número maximo de intentos superados. Vuelva a intentar en unos minutos";
        }
    }
}
