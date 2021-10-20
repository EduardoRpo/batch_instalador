<?php
function explosion($conn, $referencia, $tamanototallote)
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

        $query_mp = mysqli_query($conn, "SELECT * FROM batch_explosion_materiales WHERE id_materiaprima = '$id_materiaprima'");
        $result = mysqli_num_rows($query_mp);

        if ($result > 0) {
            while ($tnq = mysqli_fetch_assoc($query_mp))
                $materia_prima = $tnq;

            $cantidadOld = floatval($materia_prima['cantidad']);
            $cantidadNueva = $cantidad + $cantidadOld;

            $query_explosion = "UPDATE `batch_explosion_materiales` SET `cantidad` = '$cantidadNueva' WHERE `batch_explosion_materiales`.`id_materiaprima` =  '$id_materiaprima'";
            mysqli_query($conn, $query_explosion);
        } else {
            $query_explosion = "INSERT INTO batch_explosion_materiales (id_materiaprima, cantidad) 
                                VALUES('$id_materiaprima' , '$cantidad')";
            mysqli_query($conn, $query_explosion);
        }
    }
}
