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

$new_arr = array_map('trim', explode('"\n"', $datos));
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
} else if ($tabla == 'producto') {
	foreach ($datos as $dato) {
		if ($i !== 0)
			$dataList[] = explode(";", $dato);
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
		'nombre_producto', 'notificacion_sanitaria', 'linea', 'marca', 'propietario', 'presentacion_comercial', 'densidad_producto', 'color', 'olor', 'apariencia',
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
								presentacion_comercial= '{$data[8]}', densidad_producto= '{$data[9]}', id_color= '{$data[10]}', id_olor= '{$data[11]}', id_apariencia= '{$data[12]}', 
								id_untuosidad= '{$data[13]}', id_poder_espumoso= '{$data[14]}', id_recuento_mesofilos= '{$data[15]}', id_pseudomona= '{$data[16]}', 
								id_escherichia= '{$data[17]}', id_staphylococcus= '{$data[18]}', id_ph= '{$data[19]}', id_viscosidad= '{$data[20]}', 
								id_densidad_gravedad= '{$data[21]}', id_grado_alcohol= '{$data[22]}', id_tapa= '{$data[23]}', id_envase= '{$data[24]}', 
								id_etiqueta= '{$data[25]}', id_empaque= '{$data[26]}', id_otros= '{$data[27]}', multi= '{$data[28]}', base_instructivo= '{$data[29]}', 
								instructivo= '{$data[30]}' 
							WHERE referencia = '{$data[0]}'");
			} else {
				$sql = "INSERT INTO producto (referencia, nombre_referencia, unidad_empaque, id_nombre_producto, id_notificacion_sanitaria, 
										id_linea, id_marca, id_propietario, presentacion_comercial, densidad_producto, id_color, id_olor, id_apariencia, 
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
					'referencia' => $data[0], 'nombre_referencia' => $data[1], 'unidad_empaque' => $data[2],
					'id_nombre_producto' => $data[3], 'id_notificacion_sanitaria' => $data[4], 'id_linea' => $data[5], 'id_marca' => $data[6],
					'id_propietario' => $data[7], 'presentacion_comercial' => $data[8], 'densidad_producto' => $data[9] ,'id_color' => $data[10], 'id_olor' => $data[11],
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

		$sql = "SELECT * FROM $tabla WHERE id_producto = :referencia AND id_materiaprima = :materiaprima";
		$query = $conn->prepare($sql);
		$query->execute(['referencia' => $data[0], 'materiaprima' => $data[1]]);
		$rows = $query->rowCount();

		$data[0] = preg_replace("[\n|\r|\n\r]", "", $data[0]);
		$data[1] = preg_replace("[\n|\r|\n\r]", "", $data[1]);
		$data[2] = preg_replace("[\n|\r|\n\r]", "", $data[2]);
		$data[2] = floatval(str_replace(",", ".", $data[2]));

		if ($rows > 0) {
			//$conn->query("UPDATE formula SET porcentaje = AES_ENCRYPT('{$data[2]}','Wf[Ht^}2YL=D^DPD') WHERE id_producto = '{$data[0]}' AND id_materiaprima = '{$data[1]}' ");
			$sql = "UPDATE $tabla SET porcentaje = AES_ENCRYPT(:porcentaje,'Wf[Ht^}2YL=D^DPD') 
					WHERE id_materiaprima = :id_materiaprima AND id_producto = :id_producto";
			$query = $conn->prepare($sql);
			$result = $query->execute([
				'id_producto' => $data[0],
				'id_materiaprima' => $data[1],
				'porcentaje' => $data[2],
			]);
		} else {
			$sql = "INSERT INTO $tabla (id_producto, id_materiaprima, porcentaje) 
					VALUES (:referencia, :materiaprima, AES_ENCRYPT(:porcentaje,'Wf[Ht^}2YL=D^DPD'))";
			$query = $conn->prepare($sql);
			$query->execute(['referencia' => $data[0], 'materiaprima' => $data[1], 'porcentaje' => $data[2]]);
		}
	}
} else if ($tabla == 'formula_f') {
	foreach ($dataList as $data) {
		$sql = "SELECT * FROM $tabla WHERE notif_sanitaria = :notif_sanitaria AND id_materiaprima = :materiaprima";
		$query = $conn->prepare($sql);
		$query->execute(['notif_sanitaria' => $data[0], 'materiaprima' => $data[1]]);
		$rows = $query->rowCount();

		$data[0] = preg_replace("[\n|\r|\n\r]", "", $data[0]);
		$data[1] = preg_replace("[\n|\r|\n\r]", "", $data[1]);
		$data[2] = preg_replace("[\n|\r|\n\r]", "", $data[2]);
		$data[2] = floatval(str_replace(",", ".", $data[2]));

		if ($rows > 0) {
			$sql = "UPDATE $tabla SET porcentaje = AES_ENCRYPT(:porcentaje,'Wf[Ht^}2YL=D^DPD') 
				WHERE id_materiaprima = :id_materiaprima AND notif_sanitaria = :notif_sanitaria";
			$query = $conn->prepare($sql);
			$result = $query->execute([
				'notif_sanitaria' => $data[0],
				'id_materiaprima' => $data[1],
				'porcentaje' => $data[2],
			]);
		} else {
			$sql = "INSERT INTO $tabla (notif_sanitaria, id_materiaprima, porcentaje) 
				VALUES (:notif_sanitaria, :materiaprima, AES_ENCRYPT(:porcentaje,'Wf[Ht^}2YL=D^DPD'))";
			$query = $conn->prepare($sql);
			$query->execute(['notif_sanitaria' => $data[0], 'materiaprima' => $data[1], 'porcentaje' => $data[2]]);
		}
	}
} else if ($tabla == 'presentacion_comercial') {
	foreach ($dataList as $data) {
		$sql = "SELECT * FROM presentacion_comercial WHERE id = :id";
		$query = $conn->prepare($sql);
		$query->execute(['id' => $data[0]]);
		$rows = $query->rowCount();

		if ($rows > 0) {
			$sql = "UPDATE $tabla SET nombre = :nombre WHERE id = :id";
			$query = $conn->prepare($sql);
			$query->execute(['id' => $data[0], 'nombre' => $data[1]]);
		} else {
			$sql = "INSERT INTO $tabla (id, nombre) VALUES(:id, :nombre)";
			$query = $conn->prepare($sql);
			$query->execute(['id' => $data[0], 'nombre' => $data[1]]);
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
			$consultaId = $consulta[$j]['id'];
			if ($idImport == $consultaId) {
				break;
			} else if ($j == sizeof($consulta)) {
				$e++;
				array_push($Log, ($tabla . ' ' . $idImport));
			}
		}
	}
}
