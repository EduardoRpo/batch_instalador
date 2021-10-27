<?php
function explosion($conn, $id, $referencia, $tamanototallote)
{

    $query_mp = mysqli_query(
        $conn,
        "SELECT f.id, f.id_materiaprima, cast(AES_DECRYPT(porcentaje, 'Wf[Ht^}2YL=D^DPD') as char)porcentaje 
        FROM formula f WHERE f.id_producto = '$referencia'"
    );

    $result = mysqli_num_rows($query_mp);

    if ($result > 0)
        while ($mp = mysqli_fetch_assoc($query_mp))
            $materiales[] = $mp;

    foreach ($materiales as $material) {
        $cantidad = ($material['porcentaje'] / 100) * $tamanototallote;
        $id_materiaprima = $material['id_materiaprima'];

        $query_explosion = "INSERT INTO explosion_materiales_batch (batch, id_producto, id_materiaprima, cantidad) 
                                VALUES('$id', '$referencia', '$id_materiaprima' , '$cantidad')";
        mysqli_query($conn, $query_explosion);
    }
}
