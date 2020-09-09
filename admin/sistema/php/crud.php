<?php

//require_once('utils/utf8.php');

function utf8ize($d) {
    if (is_array($d)) 
        foreach ($d as $k => $v) 
            $d[$k] = utf8ize($v);
  
     else if(is_object($d))
        foreach ($d as $k => $v) 
            $d->$k = utf8ize($v);
  
     else 
        return utf8_encode($d);
  
    return $d;
    }


/* Validar si el registro existe */

function existeRegistro($conn, $query)
{
    $query = mysqli_query($conn, $query);
    $result = mysqli_num_rows($query);
    return $result;
    
}


/* Guardar y actualizar */

function ejecutarQuery($conn, $query)
{
    $result = $conn->query($query);

    if ($result) {
        echo '1';
    } else {
        die('Error');
        print_r('Error: ' . mysqli_error($conn));
    }

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
        echo json_encode(utf8ize($arreglo), JSON_UNESCAPED_UNICODE);
    } else {
        echo mysqli_error($conn);
    }
    //mysqli_free_result($query);
    mysqli_close($conn);
}
