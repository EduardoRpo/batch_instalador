<?php

/* Validar si el registro existe */

function existeRegistro($conn, $query)
{
    $result = $conn->query($query);
    $row = $result->mysqli_fetch_row();
    return $row;
}


/* Guardar y actualizar */

function ejecutarQuery($conn, $query)
{
    //$result = mysqli_query($conn, $query);
    $result = $conn->query($query);

    if ($result) {
        echo '1';
    } else {
        die('Error');
        echo 'No guardado. Error: ' . mysqli_error($conn);
    }
    //mysqli_free_result($query);
    //mysqli_close($conn);
    $conn->close();
}

/* Consultas SQL */

function ejecutarQuerySelect($conn, $query)
{
    $query = $conn->query($query);
    $result = mysqli_num_rows($query);

    if ($result > 0) {
        while ($data = mysqli_fetch_assoc($query)) {
            //$arreglo[] = $data;
            $arreglo["data"][] = $data;
        }
        echo json_encode($arreglo, JSON_UNESCAPED_UNICODE);
    } else {
        echo mysqli_error($conn);
    }
    //mysqli_free_result($query);
    mysqli_close($conn);
}
