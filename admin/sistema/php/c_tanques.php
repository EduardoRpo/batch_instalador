<?php
require_once('../../../conexion.php');
require_once('./crud.php');

$op = $_POST['operacion'];

switch ($op) {
    case 1: //listar Condiciones del medio
        $query = "SELECT * FROM tanques ORDER BY id";
        ejecutarQuerySelect($conn, $query);
        break;

    case 2: //Eliminar
        $id = $_POST['id'];

        $query_pregunta = "DELETE FROM tanques WHERE id = $id";
        $result = mysqli_query($conn, $query_pregunta);
        ejecutarQuery($conn, $query);
        break;

    case 3: // Guardar y Actualizar
        $id = $_POST['id'];
        $capacidad = $_POST['capacidad'];
        
        if ($id == '') {
            $query = "SELECT * FROM tanques WHERE capacidad='$capacidad'";
            $result = existeRegistro($conn, $query);

            if ($result > 0) {
                exit();
            } else
                $query = "INSERT INTO tanques (capacidad) VALUES('$capacidad')";
        } else
            $query = "UPDATE tanques SET capacidad = '$capacidad' WHERE id = $id";

        ejecutarQuery($conn, $query);


    

        break;
}
