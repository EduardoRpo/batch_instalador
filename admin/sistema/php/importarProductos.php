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
	foreach ($datos as $dato) {
		if ($i !== 0)
			$dataList[] = explode(";", (mb_strtoupper($dato, 'utf-8')));
		$i++;
	}
} else {
	foreach ($datos as $dato) {
		if ($i !== 0)
			$dataList[] = explode(";", ucfirst(mb_strtolower($dato, 'utf-8')));
		$i++;
	}
}

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
		/* if ($array[$t] == 'presentacion_comercial') {
			$col++;
		} */
		/* if ($array[$t] != 'presentacion_comercial') { */
		$sql = "SELECT * FROM $array[$t]";
		$query = $conn->prepare($sql);
		$query->execute();
		$propiedad_producto = $query->fetchAll($conn::FETCH_ASSOC);
		findNombre($dataList, $propiedad_producto, $col, $array[$t]);
		$col++;
		/* } */
	}

	if ($e > 0) {
		$finalLog = array_unique($Log);
		echo json_encode($finalLog, JSON_UNESCAPED_UNICODE);
		exit();
	} else {
		/* Busca referencia en la tabla */
		foreach ($dataList as $data) {
			$sql = "SELECT * FROM producto WHERE referencia = :referencia";
			$query = $conn->prepare($sql);
			$query->execute(['referencia' => $data[0]]);
			$rows = $query->rowCount();

			if ($rows > 0) {
				$conn->query("UPDATE producto SET nombre_referencia = '{$data[1]}', unidad_empaque = '{$data[2]}', id_nombre_producto= '{$data[3]}', 
								id_notificacion_sanitaria= '{$data[4]}', id_linea= '{$data[5]}', id_marca= '{$data[6]}', id_propietario= '{$data[7]}', 
								presentacion_comercial= '{$data[8]}', id_color= '{$data[9]}', id_olor= '{$data[10]}', id_apariencia= '{$data[11]}', 
								id_untuosidad= '{$data[12]}', id_poder_espumoso= '{$data[13]}', id_recuento_mesofilos= '{$data[14]}', id_pseudomona= '{$data[15]}', 
								id_escherichia= '{$data[16]}', id_staphylococcus= '{$data[17]}', id_ph= '{$data[18]}', id_viscosidad= '{$data[19]}', 
								id_densidad_gravedad= '{$data[20]}', id_grado_alcohol= '{$data[21]}', id_tapa= '{$data[22]}', id_envase= '{$data[23]}', 
								id_etiqueta= '{$data[24]}', id_empaque= '{$data[25]}', id_otros= '{$data[26]}', multi= '{$data[27]}', base_instructivo= '{$data[28]}', 
								instructivo= '{$data[29]}' 
							WHERE referencia = '{$data[0]}'");
			} else {
				/* $conn->query("INSERT INTO producto (referencia, nombre_referencia, unidad_empaque, id_nombre_producto, id_notificacion_sanitaria, 
								id_linea, id_marca, id_propietario, presentacion_comercial, id_color, id_olor, id_apariencia, 
								id_untuosidad, id_poder_espumoso, id_recuento_mesofilos, id_pseudomona, id_escherichia, 
								id_staphylococcus, id_ph, id_viscosidad, id_densidad_gravedad, id_grado_alcohol, id_tapa, id_envase, 
								id_etiqueta, id_empaque, id_otros, multi, base_instructivo, instructivo) 
							VALUES (
								'{$data[0]}', '{$data[1]}', '{$data[2]}', '{$data[3]}', '{$data[4]}', '{$data[5]}', '{$data[6]}', '{$data[7]}', 
								'{$data[8]}', '{$data[9]}', '{$data[10]}', '{$data[11]}', '{$data[12]}', '{$data[13]}', '{$data[14]}', '{$data[15]}', 
								'{$data[16]}', '{$data[17]}', '{$data[18]}', '{$data[19]}', '{$data[20]}', '{$data[21]}', '{$data[22]}', '{$data[23]}', 
								'{$data[24]}', '{$data[25]}', '{$data[26]}', '{$data[27]}', '{$data[28]}', '{$data[29]}')"); */
				$sql = "INSERT INTO producto (referencia, nombre_referencia, unidad_empaque, id_nombre_producto, id_notificacion_sanitaria, 
										id_linea, id_marca, id_propietario, presentacion_comercial, id_color, id_olor, id_apariencia, 
										id_untuosidad, id_poder_espumoso, id_recuento_mesofilos, id_pseudomona, id_escherichia, 
										id_staphylococcus, id_ph, id_viscosidad, id_densidad_gravedad, id_grado_alcohol, id_tapa, id_envase, 
										id_etiqueta, id_empaque, id_otros, multi, base_instructivo, instructivo) 
						VALUE (:referencia, :nombre_referencia, :unidad_empaque, :id_nombre_producto, :id_notificacion_sanitaria, 
								:id_linea, :id_marca, :id_propietario, :presentacion_comercial, :id_color, :id_olor, :id_apariencia, 
								:id_untuosidad, :id_poder_espumoso, :id_recuento_mesofilos, :id_pseudomona, :id_escherichia, 
								:id_staphylococcus, :id_ph, :id_viscosidad, :id_densidad_gravedad, :id_grado_alcohol, :id_tapa, :id_envase, 
								:id_etiqueta, :id_empaque, :id_otros, :multi, :base_instructivo, :instructivo)";
				$query = $conn->prepare($sql);
				$result = $query->execute([
					'producto' => $data[0], 'referencia' => $data[1], 'nombre_referencia' => $data[2], 'unidad_empaque' => $data[3],
					'id_nombre_producto' => $data[4], 'id_notificacion_sanitaria' => $data[5], 'id_linea' => $data[6], 'id_marca' => $data[7],
					'id_propietario' => $data[8], 'presentacion_comercial' => $data[9], 'id_color' => $data[10], 'id_olor' => $data[11],
					'id_apariencia' => $data[12], 'id_untuosidad' => $data[13], 'id_poder_espumoso' => $data[14], 'id_recuento_mesofilos' => $data[15],
					'id_pseudomona' => $data[16], 'id_escherichia' => $data[17], 'id_staphylococcus' => $data[18], 'id_ph' => $data[19],
					'id_viscosidad' => $data[20], 'id_densidad_gravedad' => $data[21], 'id_grado_alcohol' => $data[22], 'id_tapa' => $data[23],
					'id_envase' => $data[24], 'id_etiqueta' => $data[25], 'id_empaque' => $data[26], 'id_otros' => $data[27], 'multi' => $data[28],
					'base_instructivo' => $data[29], 'instructivo' => $data[30]
				]);
			}
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

		$sql = "SELECT * FROM $tabla WHERE id = :referencia";
		$query = $conn->prepare($sql);
		$query->execute(['referencia' => $data[0]]);
		$rows = $query->rowCount();

		if ($rows > 0)
			$conn->query("UPDATE $tabla SET nombre = '{$data[1]}' WHERE id = '{$data[0]}' ");
		else
			$conn->query("INSERT INTO $tabla (id, nombre) VALUES ('{$data[0]}', '{$data[1]}')");
	}
} else if ($tabla == 'formula') {
	foreach ($dataList as $data) {

		$sql = "SELECT * FROM formula WHERE id_producto = :referencia AND id_materiaprima = :materiaprima";
		$query = $conn->prepare($sql);
		$query->execute(['referencia' => $data[0], 'materiaprima' => $data[1]]);
		$rows = $query->rowCount();

		if ($rows > 0)
			$conn->query("UPDATE $tabla SET porcentaje = '{$data[2]}' WHERE id_producto = '{$data[0]}' AND id_materiaprima = '{$data[1]}' ");
		else {
			$sql = "INSERT INTO $tabla (id_producto, id_materiaprima, porcentaje) VALUES (:referencia, :materiaprima, AES_ENCRYPT(:porcentaje,'Wf[Ht^}2YL=D^DPD'))";
			$query = $conn->prepare($sql);
			$query->execute(['referencia' => $data[0], 'materiaprima' => $data[1], 'porcentaje' => $data[2]]);
		}
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
