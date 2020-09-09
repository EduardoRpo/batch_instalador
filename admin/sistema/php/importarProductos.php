<?php

require_once('../../../conexion.php');

//obtener datos

if (isset($_FILES['datosExcel1']))
	$datos = $_FILES['datosExcel1'];
else if (isset($_FILES['datosExcel2']))
	$datos = $_FILES['datosExcel2'];
else if (isset($_FILES['datosExcel3']))
	$datos = $_FILES['datosExcel3'];
else if (isset($_FILES['datosExcel4']))
	$datos = $_FILES['datosExcel4'];
else if (isset($_FILES['datosExcel5']))
	$datos = $_FILES['datosExcel5'];
else if (isset($_FILES['datosExcel6']))
	$datos = $_FILES['datosExcel6'];


$tabla = $_POST['tabla'];
print_r($tabla);
$datos = strtoupper(file_get_contents($datos['tmp_name']));

$datos = explode("\n", $datos);
$datos = array_filter($datos);

// preparar datos
foreach ($datos as $data) {
	$dataList[] = explode(";", $data);
}
print_r($dataList);

/* Elimina todos los datos */
$conn->query("DELETE FROM $tabla");

/* Restablece contador BD */
$conn->query("ALTER TABLE $tabla AUTO_INCREMENT = 1");

/* Insertar datos del archivo */

if ($tabla == 'densidad_gravedad' || $tabla == 'grado_alcohol' || $tabla == 'ph' || $tabla == 'viscosidad') {
	foreach ($dataList as $data) {
		$conn->query("INSERT INTO $tabla (limite_inferior, limite_superior) 
						  VALUES ('{$data[0]}', '{$data[1]}')");
	}
} else {
	foreach ($dataList as $data) {
		$conn->query("INSERT INTO $tabla (nombre) 
						  VALUES ('{$data[0]}')");
	}
}

$conn->close();
