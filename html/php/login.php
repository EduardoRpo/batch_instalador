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
                    $data = $query->fetch(PDO::FETCH_ASSOC);

                    if ($data['estado'] == 0) {
                        $alert = "Usuario Inactivo, contacte al administrador";
                    } else {

                        $new_trie = 0;
                        file_put_contents('tries.txt', $new_trie);

                        $_SESSION['active'] = true;
                        $_SESSION['idUser'] = $data['id'];
                        $_SESSION['nombre'] = $data['nombre'];
                        $_SESSION['apellido'] = $data['apellido'];
                        $_SESSION['email'] = $data['email'];
                        $_SESSION['idModulo'] = $data['id_modulo'];
                        $_SESSION['cargo'] = $data['id_cargo'];
                        $_SESSION['modulo'] = $data['modulo'];
                        $_SESSION['rol'] = $data['rol'];
                        /* $_SESSION['activo'] = $data['activo']; */
                        $_SESSION["timeout"] = time();
                        $modulo = $data['modulo'];
                        $rol = $data['rol'];

                        /* Obtener fecha de ultimo importe */
                        $sql = "SELECT IF(importado = '0000-00-00 00:00:00', null, DATE_FORMAT(importado, '%d/%m/%Y')) AS fecha_importe, 
                                       IF(importado = '0000-00-00 00:00:00', null, TIME_FORMAT(importado, '%h:%i %p')) AS hora_importe
                                FROM plan_pedidos ORDER BY `plan_pedidos`.`importado` DESC";
                        $query = $conn->prepare($sql);
                        $query->execute();
                        $importOrders = $query->fetch($conn::FETCH_ASSOC);

                        if ($importOrders['fecha_importe'] != null) {
                            $_SESSION['fecha_importe'] = $importOrders['fecha_importe'];
                            $_SESSION['hora_importe'] = $importOrders['hora_importe'];
                        }


                        if ($rol === 1 || $rol == 2) {
                            header('location: admin/sistema/index.php');
                            exit();
                        } else if ($rol == 4) {
                            header('location: admin/sistema/calidad.php');
                            exit();
                        } else if ($rol == 5) {
                            header('location: admin/sistema/newformulas.php');
                            exit();
                        } else {
                            $modulo = $data['id_modulo'];
                            $variable = $rol . $modulo;
                        }

                        switch ($variable) {

                            case '31':
                                header('location: /html/batch.php');
                                break;
                            case '61':
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
                    }
                } else {
                    $new_trie = ++$tries;
                    file_put_contents('tries.txt', $new_trie);
                    $alert = "Su usuario y/o password no son correctos";
                }
            } else
                $alert = "Número máximo de intentos superados. Vuelva a intentar en unos minutos";
        }
    }
}
