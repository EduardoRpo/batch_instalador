<?php
require_once('../../../conexion.php');
require_once('./crud.php');

$op = $_POST['operacion'];

switch ($op) {
    case 1: //listar Condiciones del medio
        $query = "SELECT cm.id, m.modulo, cm.min, cm.max FROM condicionesmedio_tiempo cm INNER JOIN modulo m ON cm.id_modulo= m.id";
        ejecutarQuerySelect($conn, $query);
        break;

    case 2: //Eliminar
        $id = $_POST['id'];
        $sql = "DELETE FROM condicionesmedio_tiempo WHERE id = :id";
        ejecutarEliminar($conn, $sql, $id);
        break;

    case 3: // Actualizar y Guardar data 
        $id_modulo = $_POST['id'];
        $t_min = $_POST['t_min'];
        $t_max =  $_POST['t_max'];
        
        $query = "SELECT * FROM condicionesmedio_tiempo WHERE id_modulo = $id_modulo";
        $result = existeRegistro($conn, $query);

        if ($result > 0)
            $query = "UPDATE condicionesmedio_tiempo SET min=$t_min, max=$t_max WHERE id_modulo = $id_modulo";
        else
            $query = "INSERT INTO condicionesmedio_tiempo (id_modulo, min, max) VALUES('$id_modulo', '$t_min', '$t_max')";

        ejecutarQuery($conn, $query);

        break;

    case 4: // Cargar Selector Procesos

        $query = "SELECT * FROM modulo";
        ejecutarQuerySelect($conn, $query);
        break;

    case 5: // Cargar datos para actualizar
        $id = $_POST['id'];

        $query = "SELECT c.id, c.id_modulo, c.min, c.max, m.modulo FROM condicionesmedio_tiempo c INNER JOIN modulo m ON c.id_modulo = m.id WHERE c.id = $id";
        ejecutarQuerySelect($conn, $query);
        break;
}
