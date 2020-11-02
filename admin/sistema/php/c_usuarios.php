<?php
require_once('../../../conexion.php');
require_once('./crud.php');

$op = $_POST['operacion'];

switch ($op) {
    case 1: //listar Usuarios
        $query = "SELECT u.id, u.nombre, u.apellido, u.email, c.cargo, m.modulo, u.user, u.rol FROM usuario u INNER JOIN cargo c INNER JOIN modulo m ON u.id_cargo = c.id AND u.id_modulo = m.id";
        ejecutarQuerySelect($conn, $query);
        break;

    case 2: //Eliminar
        $id = $_POST['id'];
        $sql = "DELETE FROM usuario WHERE id = :id";
        ejecutarEliminar($conn, $sql, $id);
        break;

    case 3: // Actualizar y Guardar data
        if (!empty($_POST)) {
            $editar = $_POST['editar'];
            $nombres = ucfirst(strtolower($_POST['nombres']));
            $apellidos = ucfirst(strtolower($_POST['apellidos']));
            $email = $_POST['email'];
            $cargo = $_POST['cargo'];
            $modulo = $_POST['modulo'];
            $rol = $_POST['rol'];
            $usuario = $_POST['usuario'];
            $clave = $_POST['clave'];
            $firma = $_FILES['firma'];

            $nombre_temp = $_FILES['firma']['tmp_name'];
            $nombre = $_FILES['firma']['name'];

            $destino = '../../../admin/assets/img/firmas/' . $nombre;
            move_uploaded_file($nombre_temp, $destino);


            if ($editar == 0) {
                $sql = "SELECT * FROM usuario WHERE user= :usuario";
                $query = $conn->prepare($sql);
                $query->execute(['usuario' => $usuario]);
                $rows = $query->rowCount();

                if ($rows > 0) {
                    echo '2';
                    exit();
                } else {
                    $sql = "INSERT INTO usuario (nombre, apellido, email, user, clave, urlfirma, rol, id_modulo, id_cargo) 
                            VALUES(:nombre, :apellido, :email, :user, :clave, :urlfirma, :rol, :id_modulo, :id_cargo)";
                    $query = $conn->prepare($sql);
                    $result = $query->execute([
                        'nombre' => $nombres,
                        'apellido' => $apellidos,
                        'email' => $email,
                        'user' => $usuario,
                        'clave' => md5($clave),
                        'urlfirma' => $destino,
                        'rol' => $rol,
                        'id_modulo' => $modulo,
                        'id_cargo' => $cargo
                    ]);
                    ejecutarQuery($result, $conn);
                }
            } else {
                $id = $_POST['id'];
                
                
                if (empty($clave) && empty($firma)) {
                    $sql = "UPDATE usuario SET nombre =:nombre, apellido =:apellido, email =:email, user =:user, rol =:rol, id_modulo =:modulo, id_cargo =:cargo WHERE id = :id";
                    $query = $conn->prepare($sql);
                    $result = $query->execute([
                        'nombre' => $nombres,
                        'apellido' => $apellidos,
                        'email' => $email,
                        'user' => $usuario,
                        'rol' => $rol,
                        'modulo' => $modulo,
                        'cargo' => $cargo,
                        'id' => $id
                    ]);
                } else if (empty($clave)) {
                    $sql = "UPDATE usuario SET nombre =:nombre, apellido =:apellido, email =:email, user =:user, urlfirma =:urlfirma, rol =:rol, id_modulo =:modulo, id_cargo =:cargo WHERE id = :id";
                    $query = $conn->prepare($sql);
                    $result = $query->execute([
                        'nombre' => $nombres,
                        'apellido' => $apellidos,
                        'email' => $email,
                        'user' => $usuario,
                        'urlfirma' => $destino,
                        'rol' => $rol,
                        'modulo' => $modulo,
                        'cargo' => $cargo,
                        'id' => $id
                    ]);
                } else if (empty($firma)) {
                    $sql = "UPDATE usuario SET nombre =:nombre, apellido =:apellido, email =:email, user =:user, clave =:clave, rol =:rol, id_modulo =:modulo, id_cargo =:cargo WHERE id = :id";
                    $query = $conn->prepare($sql);
                    $result = $query->execute([
                        'nombre' => $nombres,
                        'apellido' => $apellidos,
                        'email' => $email,
                        'user' => $usuario,
                        'clave' => md5($clave),
                        'rol' => $rol,
                        'modulo' => $modulo,
                        'cargo' => $cargo,
                        'id' => $id
                    ]);
                } else {
                    $sql = "UPDATE usuario SET nombre =:nombre, apellido =:apellido, email =:email, user =:user, clave =:clave, urlfirma =:urlfirma, rol=:rol, id_modulo =:modulo, id_cargo =:cargo WHERE id = :id";
                    $query = $conn->prepare($sql);
                    $result = $query->execute([
                        'nombre' => $nombres,
                        'apellido' => $apellidos,
                        'email' => $email,
                        'user' => $usuario,
                        'clave' => md5($clave),
                        'urlfirma' => $destino,
                        'rol' => $rol,
                        'modulo' => $modulo,
                        'cargo' => $cargo,
                        'id' => $id
                    ]);
                }

                if ($result) {
                    echo '3';
                    exit();
                }
            }
        }
        break;
    case 4: //Cargar selectores
        $tabla = $_POST['tabla'];
        $query = "SELECT * FROM $tabla";
        ejecutarQuerySelect($conn, $query);
        break;
}
