<?php
require_once('../../../conexion.php');
require_once('./crud.php');

$op = $_POST['operacion'];

switch ($op) {
    case 1: //listar Usuarios
        $query = "SELECT u.id, u.nombre, u.apellido, u.email, c.cargo, m.modulo FROM usuario u INNER JOIN cargo c INNER JOIN modulo m ON u.id_cargo = c.id AND u.id_modulo = m.id";
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
            $nombres = strtoupper($_POST['nombres']);
            $apellidos = strtoupper($_POST['apellidos']);
            $email = $_POST['email'];
            $cargo = $_POST['cargo'];
            $modulo = $_POST['modulo'];
            $usuario = $_POST['usuario'];
            $clave = $_POST['clave'];

            /* var_dump($nombres);
            var_dump($apellidos);
            var_dump($email);
            var_dump($cargo);
            var_dump($modulo);
            var_dump($editar);
            var_dump($clave);

            exit(); */

            if ($editar == 0) {
                $sql = "SELECT * FROM usuario WHERE user= :usuario";
                $query = $conn->prepare($sql);
                $query->execute(['usuario' => $usuario]);
                $rows = $query->rowCount();

                if ($rows > 0) {
                    echo '2';
                    exit();
                } else {
                    $sql = "INSERT INTO usuario (nombre, apellido, email, user, clave, id_modulo, id_cargo) 
                            VALUES(:nombre, :apellido, :email, :user, :clave, :id_modulo, :id_cargo)";
                    $query = $conn->prepare($sql);
                    $result = $query->execute([
                        'nombre' => $nombres,
                        'apellido' => $apellidos,
                        'email' => $email,
                        'user' => $usuario,
                        'clave' => md5($clave),
                        'id_modulo' => $modulo,
                        'id_cargo' => $cargo
                    ]);
                    ejecutarQuery($result, $conn);
                }
            } else {
                $id = $_POST['id'];
                $sql = "UPDATE cargo SET cargo = :cargo WHERE id = :id";
                $query = $conn->prepare($sql);
                $result = $query->execute(['cargo' => $cargo, 'id' => $id]);

                if ($result) {
                    echo '3';
                    exit();
                }
            }
        }
        break;
    case 4: //Cargar selectores
        $tabla = $_POST['$tabla'];
        $query = "SELECT * FROM $tabla";
        ejecutarQuerySelect($conn, $query);
        break;
}
