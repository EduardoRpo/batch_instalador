<?php 

require('../conexion.php');
if (isset($_POST['checkboxvar'])) 
{
	$checkboxvar =$_POST['checkboxvar'];
	$desinfectante =$_POST['desinfectante'];
	$observaciones =$_POST['observaciones'];
	$idbatch =$_POST['idbatch'];
	$fechaprogramacion =$_POST['fechaprogramacion'];
	$usuario1form =$_POST['usuario1form'];
	$contrasena1form =$_POST['contrasena1form'];
	$usuario2form =$_POST['usuario2form'];
	$contrasena2form =$_POST['contrasena2form'];


    $array1 = array_slice($checkboxvar, 0, 3);
    $array2 = array_slice($checkboxvar, 3, 3);
	$array3 = array_slice($checkboxvar, 6, 3);
	$array4 = array_slice($checkboxvar, 9, 3);
	$array5 = array_slice($checkboxvar, 12, 3);
	$array6 = array_slice($checkboxvar, 15, 3);
	$array7 = array_slice($checkboxvar, 18, 3);
	$array8 = array_slice($checkboxvar, 21, 3);
	$array9 = array_slice($checkboxvar, 24, 3);
	$array10 = array_slice($checkboxvar, 27, 3);


    $create = mysqli_query($conn, "INSERT INTO solucion_pregunta (solucion, id_pregunta, id_modulo, id_batch) 
			VALUES  ('".$array1[0]."', '".$array1[1]."', '1', '".$array1[2]."'),
					('".$array2[0]."', '".$array2[1]."', '1', '".$array2[2]."'),
					('".$array3[0]."', '".$array3[1]."', '1', '".$array3[2]."'),
					('".$array4[0]."', '".$array4[1]."', '1', '".$array4[2]."'),
					('".$array5[0]."', '".$array5[1]."', '1', '".$array5[2]."'),
					('".$array6[0]."', '".$array6[1]."', '1', '".$array6[2]."'),
					('".$array7[0]."', '".$array7[1]."', '1', '".$array7[2]."'),
					('".$array8[0]."', '".$array8[1]."', '1', '".$array8[2]."'),
					('".$array9[0]."', '".$array9[1]."', '1', '".$array9[2]."'),
					('".$array10[0]."', '".$array10[1]."', '1', '".$array10[2]."'
					)");


    $create2 = mysqli_query($conn, "INSERT INTO observaciones_desinfectante (observaciones, id_desinfectante, id_modulo, id_batch) 
			VALUES  ('$observaciones', '$desinfectante', '1', '$idbatch')");

    $create3 = mysqli_query($conn, "UPDATE batch SET fecha_actual='$fechaprogramacion' WHERE id_batch=$idbatch");

    $create4 = mysqli_query($conn, "SELECT * FROM usuario WHERE email='$usuario1form' AND password='$contrasena1form'");

    while($row=mysqli_fetch_array($create4)) {
$idus1 = $row['id'];
}

	$create5 = mysqli_query($conn, "SELECT * FROM usuario WHERE email='$usuario2form' AND password='$contrasena2form'");

    while($rows=mysqli_fetch_array($create5)) {
$idus2 = $rows['id'];
}

	$create6 = mysqli_query($conn, "INSERT INTO firma (fecha, id_primerfirma, id_segundafirma, id_area, id_batch) 
			VALUES  ('$fechaprogramacion', '$idus1', '$idus2', '1', '$idbatch')");
	header('location: aprobacion.php');
}
?>
