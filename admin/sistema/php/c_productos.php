<?php
require_once('../../../conexion.php');
require_once('./crud.php');

$op = $_POST['operacion'];

switch ($op) {
    case 1: //listar productos


        break;

    case 2: //Eliminar
        $id = $_POST['id'];

        $query = "DELETE FROM condicionesmedio_tiempo WHERE id = $id";
        ejecutarQuery($conn, $query);
        break;

    case 3: // Guardar data
        $modulo = $_POST['modulo'];
        $t_min = $_POST['t_min'];
        $t_max =  $_POST['t_max'];

        $query = "SELECT COUNT(id) from condicionesmedio_tiempo where id_modulo = $modulo";
        $row = existeRegistro($conn, $query);

        if ($row > 0)
            $query = "UPDATE condicionesmedio_tiempo SET min=$t_min, max=$t_max WHERE id_modulo = $modulo";
        else
            $query = "INSERT INTO condicionesmedio_tiempo (id_modulo, min, max) VALUES('$modulo', '$t_min', '$t_max')";

        ejecutarQuery($conn, $query);

        break;



    case 4: // Cargar datos para actualizar
        $id = $_POST['id'];

        $query = "SELECT c.id, c.id_modulo, c.min, c.max, m.modulo FROM condicionesmedio_tiempo c INNER JOIN modulo m ON c.id_modulo = m.id WHERE c.id = $id";
        ejecutarQuerySelect($conn, $query);
        break;
    case 5: // Cargar Selectores
        $tabla = $_POST['tabla'];

        if ($tabla == 'ph' || $tabla == 'viscosidad' || $tabla == 'densidad_gravedad' || $tabla == 'grado_alcohol' )
            $query = "SELECT id, CONCAT(limite_inferior, ' - ', limite_superior) as nombre FROM $tabla";
        else
            $query = "SELECT * FROM $tabla";

        ejecutarQuerySelect($conn, $query);
        break;
}
