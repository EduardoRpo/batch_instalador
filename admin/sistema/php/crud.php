<?php

//require_once('utils/utf8.php');

function utf8ize($d)
{
    if (is_array($d))
        foreach ($d as $k => $v)
            $d[$k] = utf8ize($v);

    else if (is_object($d))
        foreach ($d as $k => $v)
            $d->$k = utf8ize($v);

    else
        return utf8_encode($d);

    return $d;
}


/* Validar si el registro existe */

function existeRegistro($conn, $query)
{
    $query = $conn->query($query);
    $result = $query->rowCount();
    return $result;
}

/* Eliminar  */

function ejecutarEliminar($conn, $sql, $id)
{
    $query = $conn->prepare($sql);
    $result = $query->execute(['id' => $id]);

    if ($result) {
        echo '1';
    } else {
        die('Error');
        print_r('Error: ' . mysqli_error($conn));
    }
}


/* Guardar y actualizar */

//function ejecutarQuery($conn, $query)
function ejecutarQuery($result, $conn)
{
    //$result = $conn->query($query);

    if ($result) {
        echo '1';
    } else {
        die('Error');
        print_r('Error: ' . mysqli_error($conn));
    }
}

/* Consultas SQL */

function ejecutarQuerySelect($conn, $query)
{
    //Ejecuta la sentencia
    $result = $conn->query($query);

    //Almacena la data en array
    while ($data = $result->fetch(PDO::FETCH_ASSOC)) {
        $arreglo[] = $data;
    }
    if (empty($arreglo)) {
        echo '3';
        exit();
    }

    echo json_encode(utf8ize($arreglo), JSON_UNESCAPED_UNICODE);
}


function ejecutarSelect($conn, $query)
{
    //Almacena la data en array
    while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
        $arreglo["data"][] = $data;
    }
    if (empty($arreglo)) {
        echo '3';
        exit();
    }

    echo json_encode(utf8ize($arreglo), JSON_UNESCAPED_UNICODE);
}