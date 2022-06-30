<?php
require_once('../../../conexion.php');
require_once('./crud.php');

$op = $_POST['operacion'];

switch ($op) {
    case 1: //listar Condiciones del medio
       /*  $query = "SELECT cm.id, m.modulo, cm.t_min, cm.t_max FROM condicionesmedio_tiempo cm INNER JOIN modulo m ON cm.id_modulo= m.id";
        ejecutarQuerySelect($conn, $query); */
        break;

    case 2: //Eliminar
        $id = $_POST['id'];
        $sql = "DELETE FROM condicionesmedio_tiempo WHERE id = :id";
        ejecutarEliminar($conn, $sql, $id);
        break;

    case 3: // Actualizar y Guardar data 
        if (!empty($_POST)) {
            $editar = $_POST['editar'];
            $id = $_POST['id'];

            $t_min = $_POST['t_min'];
            $t_max =  $_POST['t_max'];

            if ($editar == 0) {
                $sql = "SELECT * FROM condicionesmedio_tiempo WHERE id_modulo = :id";
                $query = $conn->prepare($sql);
                $query->execute(['id' => $id]);
                $rows = $query->rowCount();

                if ($rows > 0) {
                    echo '2';
                    exit();
                } else {
                    $sql = "INSERT INTO condicionesmedio_tiempo (id_modulo, t_min, t_max) VALUES(:id_modulo, :t_min, :t_max)";
                    $query = $conn->prepare($sql);
                    $result = $query->execute(['id_modulo' => $id, 't_min' => $t_min, 't_max' => $t_max]);
                    ejecutarQuery($result, $conn);
                }
            } else {
                $id = $_POST['id'];
                $sql = "UPDATE condicionesmedio_tiempo SET t_min =:t_min, t_max=:t_max WHERE id_modulo = :id";
                $query = $conn->prepare($sql);
                $result = $query->execute(['t_min' => $t_min, 't_max' => $t_max, 'id' => $id]);

                if ($result) {
                    echo '3';
                    exit();
                }
            }
        }
        break;

    case 4: // Cargar Selector Procesos
        /* $query = "SELECT * FROM modulo";
        ejecutarQuerySelect($conn, $query); */
        break;
}
