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
else if (isset($_FILES['datosExcel7']))
	$datos = $_FILES['datosExcel7'];

$tabla = $_POST['tabla'];

if ($tabla == 'notificacion_sanitaria')
	$datos = strtoupper(file_get_contents($datos['tmp_name']));
else
	$datos = ucfirst(mb_strtolower(file_get_contents($datos['tmp_name'])));

$datos = explode("\n", $datos);
$datos = array_filter($datos);

// preparar datos
foreach ($datos as $data) {
	$dataList[] = explode(";", ucfirst(mb_strtolower($data, 'utf-8')));
}

/* Elimina todos los datos */
$conn->query("DELETE FROM $tabla");

/* Restablece contador BD */
$conn->query("ALTER TABLE $tabla AUTO_INCREMENT = 1");

/* Insertar datos del archivo */

if ($tabla == 'producto') {
	foreach ($dataList as $data) {
		$conn->query("INSERT INTO producto (referencia, nombre_referencia, unidad_empaque, id_nombre_producto, 
									id_notificacion_sanitaria, id_linea, id_marca, id_propietario, 
									id_presentacion_comercial, id_color, id_olor, id_apariencia, id_untuosidad, 
									id_poder_espumoso, id_recuento_mesofilos, id_pseudomona, id_escherichia, 
									id_staphylococcus, id_ph, id_viscosidad, id_densidad_gravedad, id_grado_alcohol) 
							  VALUES ('{$data[0]}', '{$data[1]}', '{$data[2]}', '{$data[3]}', '{$data[4]}',
									  '{$data[5]}', '{$data[6]}', '{$data[7]}', '{$data[8]}', '{$data[9]}',
									  '{$data[10]}', '{$data[11]}', '{$data[12]}', '{$data[13]}', '{$data[14]}',
									  '{$data[15]}', '{$data[16]}', '{$data[17]}', '{$data[18]}', '{$data[19]}',
									  '{$data[20]}', '{$data[21]}')");
	}
} else if ($tabla == 'densidad_gravedad' || $tabla == 'grado_alcohol' || $tabla == 'ph' || $tabla == 'viscosidad') {
	foreach ($dataList as $data) {
		$conn->query("INSERT INTO $tabla (limite_inferior, limite_superior) 
						  VALUES ('{$data[0]}', '{$data[1]}')");
	}
} else if ($tabla == 'notificacion_sanitaria') {
	foreach ($dataList as $data) {
		$conn->query("INSERT INTO $tabla (nombre, vencimiento) 
						  VALUES ('{$data[0]}', '{$data[1]}')");
	}
} else if ($tabla == 'tapa') {
	foreach ($dataList as $data) {
		print_r($data[0]);
		print_r(' ');
		$nombre = ucfirst(mb_strtolower($data[1]));
		print_r($nombre);
		
		$conn->query("INSERT INTO $tabla (id, nombre) 
						  VALUES ('{$data[0]}', '{$data[1]}')");
	}
} else {
	foreach ($dataList as $data) {
		$conn->query("INSERT INTO $tabla (nombre) 
						  VALUES ('{$data[0]}')");
	}
}
