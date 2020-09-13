<?php
require_once('../../../conexion.php');
require_once('./crud.php');

$op = $_POST['operacion'];

switch ($op) {

    case 1: //listar tablas Generales
        $tabla = $_POST['tabla'];
        $query = "SELECT * FROM $tabla";
        ejecutarQuerySelect($conn, $query);
        break;

    case 2: //Eliminar
        $id = $_POST['id'];
        $tabla = $_POST['tabla'];

        $sql = "DELETE FROM $tabla WHERE id = :id";
        ejecutarEliminar($conn, $sql, $id);
        break;

    case 3: // Guardar o actualizar data

        $editar = $_POST['editar'];
        $tabla = $_POST['nombre'];
        $codigo =  $_POST['codigo'];
        $descripcion =  strtoupper($_POST['descripcion']);

        if ($editar > 0) {
            $id = $_POST['id'];
            $query = "UPDATE $tabla SET id = $codigo, nombre = '$descripcion' WHERE id = $id";
        } else {
            $id = $_POST['id'];
            $query = "SELECT * FROM $tabla WHERE id = $codigo";
            $result = existeRegistro($conn, $query);

            if ($result > 0) {
                echo '2';
                exit();
            }else{
                $query = "INSERT INTO $tabla (id, nombre) VALUES($codigo, '$descripcion')";
            }

        }

        ejecutarQuery($conn, $query);
        break;
}
