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
        $sql = "DELETE FROM materia_prima WHERE referencia = :id";
        ejecutarEliminar($conn, $sql, $id);
        break;

    case 3: // Almacenar o actualizar data
        if (!empty($_POST)) {

            $referencia = $_POST['ref'];
            $materia_prima = $_POST['materiaprima'];
            $alias = $_POST['alias'];

            $sql = "SELECT * FROM materia_prima WHERE referencia = :referencia";
            $query = $conn->prepare($sql);
            $query->execute(['referencia' => $referencia]);
            $rows = $query->rowCount();

            if ($rows > 0) {
                $sql = "UPDATE materia_prima SET nombre = :materia_prima, alias = :alias WHERE referencia = :referencia";
                $query = $conn->prepare($sql);
                $result = $query->execute(['referencia' => $referencia, 'materia_prima' => $materia_prima, 'alias' => $alias]);

                if ($result)
                    echo '3';
            } else {
                $sql = "INSERT INTO materia_prima (referencia, nombre, alias) VALUES(:referencia, :materia_prima, :alias)";
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
