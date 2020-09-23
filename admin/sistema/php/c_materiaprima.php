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
            $editar = $_POST['editar'];
            $referencia = $_POST['referencia'];
            $materia_prima = $_POST['materiaprima'];
            $alias = $_POST['alias'];

            if ($editar == 0) {
                $sql = "SELECT * FROM materia_prima WHERE referencia=:referencia";
                $query = $conn->prepare($sql);
                $query->execute(['referencia' => $referencia]);
                $rows = $query->rowCount();

                if ($rows > 0) {
                    echo '2';
                    exit();
                } else {
                    $sql = "INSERT INTO materia_prima (referencia, nombre, alias) VALUES(:referencia, :materia_prima, :alias)";
                    $query = $conn->prepare($sql);
                    $result = $query->execute(['referencia' => $referencia, 'materia_prima' => $materia_prima, 'alias' => $alias]);
                    ejecutarQuery($result, $conn);
                }
            } else {
                $id = $_POST['id'];
                $sql = "UPDATE materia_prima SET referencia =:referencia, nombre=:materia_prima, alias=:alias WHERE referencia = :id";
                $query = $conn->prepare($sql);
                $result = $query->execute(['referencia' => $referencia, 'materia_prima' => $materia_prima, 'alias' => $alias, 'id' => $id]);

                if ($result) {
                    echo '3';
                    exit();
                }
            }
        }
        break;
}
