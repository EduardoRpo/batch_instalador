<?php

require_once('../../../conexion.php');

//obtener datos

for ($i = 1; $i < 10; $i++) {
	if (isset($_FILES["datosExcel$i"])) {
		$datos = $_FILES["datosExcel$i"];
		break;
	}
}

$tabla = $_POST['tabla'];
$datos = utf8_encode(file_get_contents($datos['tmp_name']));

$datos = explode("\n", $datos);
$datos = array_filter($datos);
$i = 0;

// preparar datos

if ($tabla == 'notificacion_sanitaria' || $tabla == 'nombre_producto' || $tabla == 'propietario' || $tabla == 'marca') {
	foreach ($datos as $data) {
		if ($i !== 0)
			$dataList[] = explode(";", (mb_strtoupper($data, 'utf-8')));
		$i++;
	}
} else {
	foreach ($datos as $data) {
		if ($i !== 0)
			$dataList[] = explode(";", ucfirst(mb_strtolower($data, 'utf-8')));
		$i++;
	}
}

/* Elimina todos los datos */
//$conn->query("DELETE FROM $tabla");

/* Restablece contador BD */
//$conn->query("ALTER TABLE $tabla AUTO_INCREMENT = 1");

/* Insertar datos del archivo */

if ($tabla == 'producto') {
	$e = 0;
	$Log = [];
	$array = [
		'nombre_producto', 'notificacion_sanitaria', 'linea', 'marca', 'propietario', 'presentacion_comercial', 'color', 'olor', 'apariencia',
		'untuosidad', 'poder_espumoso', 'recuento_mesofilos', 'pseudomona', 'escherichia', 'staphylococcus', 'ph', 'viscosidad', 'densidad_gravedad',
		'grado_alcohol', 'tapa', 'envase', 'etiqueta', 'empaque', 'otros'
	];
	$col = 3;
	for ($t = 0; $t < sizeof($array); $t++) {
		$sql = "SELECT * FROM $array[$t]";
		$query = $conn->prepare($sql);
		$query->execute();
		$propiedad_producto = $query->fetchAll($conn::FETCH_ASSOC);
		findNombre($dataList, $propiedad_producto, $col, $array[$t]);
		$col++;
	}

	if ($e > 0) {
		$finalLog = array_unique($Log);
		echo json_encode($finalLog, JSON_UNESCAPED_UNICODE);
		//echo 'error';
		exit();
	} else {
		foreach ($dataList as $data) {
			$conn->query("INSERT INTO producto (referencia, nombre_referencia, unidad_empaque, id_nombre_producto, 
										id_notificacion_sanitaria, id_linea, id_marca, id_propietario, 
										presentacion_comercial, id_color, id_olor, id_apariencia, id_untuosidad, 
										id_poder_espumoso, id_recuento_mesofilos, id_pseudomona, id_escherichia, 
										id_staphylococcus, id_ph, id_viscosidad, id_densidad_gravedad, id_grado_alcohol) 
						VALUES ('{$data[0]}', '{$data[1]}', '{$data[2]}', '{$data[3]}', '{$data[4]}',
						'{$data[5]}', '{$data[6]}', '{$data[7]}', '{$data[8]}', '{$data[9]}', '{$data[10]}', '{$data[11]}', '{$data[12]}', 
						'{$data[13]}', '{$data[14]}', '{$data[15]}', '{$data[16]}', '{$data[17]}', '{$data[18]}', '{$data[19]}', '{$data[20]}', 
						'{$data[21]}')");
		}
	}
} else if ($tabla == 'densidad_gravedad' || $tabla == 'grado_alcohol' || $tabla == 'ph' || $tabla == 'viscosidad') {
	foreach ($dataList as $data) {
		$conn->query("INSERT INTO $tabla (limite_inferior, limite_superior) VALUES ('{$data[0]}', '{$data[1]}')");
	}
} else if ($tabla == 'notificacion_sanitaria') {
	foreach ($dataList as $data) {
		$conn->query("INSERT INTO $tabla (nombre, vencimiento) VALUES ('{$data[0]}', '{$data[1]}')");
	}
} else if ($tabla == 'tapa' || $tabla == 'envase' || $tabla == 'etiqueta' || $tabla == 'empaque' || $tabla == 'otros') {
	foreach ($dataList as $data) {
		$conn->query("INSERT INTO $tabla (id, nombre) VALUES ('{$data[0]}', '{$data[1]}')");
	}
} else {
	foreach ($dataList as $data) {
		$conn->query("INSERT INTO $tabla (nombre) VALUES ('{$data[0]}')");
	}
}


function findNombre($importFile, $consulta, $col, $tabla)
{
	global $e;
	global $Log;

	for ($i = 0; $i < sizeof($importFile); $i++) {
		$idImport = $importFile[$i][$col];
		for ($j = 0; $j < sizeof($consulta); $j++) {
			$consultaDato = $consulta[$j];
			$idConsulta = array_values($consultaDato)[0];
			$fin = $j + 1;
			if ($idImport == $idConsulta)
				break;
			else if ($fin == sizeof($consulta)) {
				/* $file = "../../../html/logs/log_errores.txt";
				$notificacion = date("d-m-Y") . " " . date("H:i:s") . " No Encontró el id  " . $tabla . " en la tabla " . $idImport . "\n";
				file_put_contents($file, $notificacion, FILE_APPEND | LOCK_EX); */
				$e++;
				array_push($Log, ($tabla . ' ' . $idImport));
			}
		}
	}
}
