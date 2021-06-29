<?php
require_once('../../../conexion.php');
require_once('./crud.php');

$op = $_POST['operacion'];

switch ($op) {
    case 1: //listar Materia Prima
        $query = "SELECT * FROM materia_prima";
        ejecutarQuerySelect($conn, $query);
        break;

    case 2: //Eliminar
        $id = $_POST['id'];
        $tb = $_POST['tbmateriaPrima'];

        if ($tb == 0)
            $tbl = 'materia_prima_f';
        else
            $tbl = 'materia_prima';


        $sql = "DELETE FROM $tbl WHERE referencia = :id";
        ejecutarEliminar($conn, $sql, $id);
        break;

    case 3: // Almacenar o actualizar data
        if (!empty($_POST)) {

            $referencia = $_POST['ref'];
            $materia_prima = $_POST['materiaprima'];
            $alias = $_POST['alias'];
            $tb = $_POST['tbmateriaPrima'];

            if ($tb == 0)
                $tbl = 'materia_prima_f';
            else
                $tbl = 'materia_prima';


            $sql = "SELECT * FROM $tbl WHERE referencia = :referencia";
            $query = $conn->prepare($sql);
            $query->execute(['referencia' => $referencia]);
            $rows = $query->rowCount();

            if ($rows > 0) {
                $sql = "UPDATE $tbl SET nombre = :materia_prima, alias = :alias WHERE referencia = :referencia";
                $query = $conn->prepare($sql);
                $result = $query->execute(['referencia' => $referencia, 'materia_prima' => $materia_prima, 'alias' => $alias]);

                if ($result)
                    echo '3';
            } else {
                $sql = "INSERT INTO $tbl (referencia, nombre, alias) VALUES(:referencia, :materia_prima, :alias)";
                $query = $conn->prepare($sql);
                $result = $query->execute(['referencia' => $referencia, 'materia_prima' => $materia_prima, 'alias' => $alias]);

                if ($result)
                    echo '1';
            }
        }
        break;
    case '4':
        $query = "SELECT * FROM materia_prima_f";
        ejecutarQuerySelect($conn, $query);
        break;
}
