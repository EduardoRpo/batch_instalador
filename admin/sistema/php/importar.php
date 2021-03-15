<?php

if (!empty($_POST)) {
	require_once('../../../conexion.php');

	//obtener datos
	$datos = $_FILES['datosExcel'];
	$operacion = $_POST['operacion'];

	$datos = utf8_encode(file_get_contents($datos['tmp_name']));
	$datos = explode("\n", $datos);
	$datos = array_filter($datos);
	$i = 0;

	// preparar datos
	foreach ($datos as $data) {
		if ($i !== 0)
			$dataList[] = explode(";", ucfirst(mb_strtolower($data, 'utf-8')));
		$i++;
	}

	//Buscar operacion y ejecutar

	switch ($operacion) {
		case '1': // insertar en la BD procesos

			foreach ($dataList as $data) {
				$conn->query("INSERT INTO modulo (modulo) 
					  VALUES ('{$data[0]}')");
			}
			break;

		case '2': // insertar en la BD condiciones

			foreach ($dataList as $data) {
				$conn->query("INSERT INTO condicionesmedio_tiempo (id_modulo, t_min, t_max) 
				  VALUES ('{$data[0]}', '{$data[1]}', '{$data[2]}')");
			}
			break;

		case '3': // insertar en la BD desinfectante

			foreach ($dataList as $data) {
				$conn->query("INSERT INTO desinfectante (nombre, concentracion) 
				  VALUES ('{$data[0]}', '{$data[1]}')");
			}
			break;

		case '4': // insertar en la BD equipos

			foreach ($dataList as $data) {
				$conn->query("INSERT INTO equipos (descripcion, tipo ) 
				  VALUES ('{$data[0]}', '{$data[1]}')");
			}
			break;

		case '5': // insertar en la BD preguntas

			foreach ($dataList as $data) {
				$conn->query("INSERT INTO preguntas (pregunta ) 
					  VALUES ('{$data[0]}')");
			}
			break;

		case '6': // insertar en la BD despeje

			foreach ($dataList as $data) {
				$conn->query("INSERT INTO modulo_pregunta (id_pregunta, resp, id_modulo ) 
						  VALUES ('{$data[0]}', '{$data[1]}', '{$data[2]}')");
			}
			break;

		case '7': // insertar en la BD tanques

			foreach ($dataList as $data) {
				$conn->query("INSERT INTO tanques (capacidad) 
						  VALUES ('{$data[0]}')");
			}
			break;

		case '8': // insertar en la BD Materia Prima

			foreach ($dataList as $data) {

				$sql = "SELECT * FROM materia_prima WHERE referencia = :referencia";
				$query = $conn->prepare($sql);
				$query->execute(['referencia' => $data[0]]);
				$rows = $query->rowCount();

				$referencia = $data[0];
				$nombre = ucfirst(mb_strtolower($data[1], "utf-8"));
				$alias = ucfirst(mb_strtolower($data[2], "utf-8"));

				if ($rows > 0)
					$conn->query("UPDATE materia_prima SET nombre = '{$nombre}', alias = '{$alias}' WHERE id = '{$referencia}' ");
				else
					$conn->query("INSERT INTO materia_prima (referencia, nombre, alias) VALUES ('{$referencia}', '{$nombre}', '{$alias}')");
			}
			break;

		case '9': // insertar en la BD instructivo

			foreach ($dataList as $data) {
				$conn->query("INSERT INTO instructivo_preparacion (pasos, tiempo, id_producto) 
								  VALUES ('{$data[0]}', '{$data[1]}', '{$data[2]}')");
			}
			break;
		case '10': // importar multipresentacion

			/* Eliminar todos los productos con multipresentacion */
			$sql = "UPDATE producto SET multi =:multi";
			$query = $conn->prepare($sql);
			$result = $query->execute([
				'multi' => '',
			]);

			/* Cargar todas las multipresentaciones */
			foreach ($dataList as $data) {

				$sql = "UPDATE producto SET multi =:multi WHERE referencia = :ref";
				$query = $conn->prepare($sql);
				$result = $query->execute([
					'ref' => $data[0],
					'multi' => $data[1],
				]);
			}
			echo ('multi');

			break;
		case '11': // insertar en la BD instructivo

			foreach ($dataList as $data) {
				$sql = "SELECT id FROM instructivos_base WHERE producto =:referencia AND pasos = :pasos";
				$query = $conn->prepare($sql);
				$query->execute([
					'referencia' => $data[0],
					'pasos' => $data[1]
				]);

				$info = $query->fetch(PDO::FETCH_ASSOC);
				$id = $info["id"];

				$rows = $query->rowCount();

				if ($rows > 0) {
					$sql = "UPDATE instructivos_base SET producto =:producto, pasos =:pasos, tiempo =:tiempo WHERE id =:id";
					$query = $conn->prepare($sql);
					$result = $query->execute([
						'producto' => $data[0],
						'pasos' => $data[1],
						'tiempo' => $data[2],
						'id' => $id,
					]);
				} else {
					$sql = "INSERT INTO instructivos_base (producto, pasos, tiempo) VALUE (:producto, :pasos, :tiempo)";
					$query = $conn->prepare($sql);
					$result = $query->execute([
						'producto' => $data[0],
						'pasos' => $data[1],
						'tiempo' => $data[2],
					]);
				}
			}

			if ($result)
				echo 'multi';
			else
				echo '0';

			break;
	}
}
