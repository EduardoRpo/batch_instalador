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

	/* print_r($dataList);
	exit(); */
	//Buscar operacion y ejecutar

	switch ($operacion) {
		case '1': // insertar en la BD procesos

			//$conn->query("DELETE FROM modulo");
			//$conn->query("ALTER TABLE modulo AUTO_INCREMENT = 1");

			foreach ($dataList as $data) {
				$conn->query("INSERT INTO modulo (modulo) 
					  VALUES ('{$data[0]}')");
			}
			break;

		case '2': // insertar en la BD condiciones

			//$conn->query("DELETE FROM condicionesmedio_tiempo");
			//$conn->query("ALTER TABLE condicionesmedio_tiempo AUTO_INCREMENT = 1");

			foreach ($dataList as $data) {
				$conn->query("INSERT INTO condicionesmedio_tiempo (id_modulo, t_min, t_max) 
				  VALUES ('{$data[0]}', '{$data[1]}', '{$data[2]}')");
			}
			break;

		case '3': // insertar en la BD desinfectante

			//$conn->query("DELETE FROM desinfectante");
			//$conn->query("ALTER TABLE desinfectante AUTO_INCREMENT = 1");

			foreach ($dataList as $data) {
				$conn->query("INSERT INTO desinfectante (nombre, concentracion) 
				  VALUES ('{$data[0]}', '{$data[1]}')");
			}
			break;

		case '4': // insertar en la BD equipos

			//$conn->query("DELETE FROM maquinaria");
			//$conn->query("ALTER TABLE maquinaria AUTO_INCREMENT = 1");

			foreach ($dataList as $data) {
				$conn->query("INSERT INTO equipos (descripcion, tipo ) 
				  VALUES ('{$data[0]}', '{$data[1]}')");
			}
			break;

		case '5': // insertar en la BD preguntas

			//$conn->query("DELETE FROM preguntas");
			//$conn->query("ALTER TABLE preguntas AUTO_INCREMENT = 1");

			foreach ($dataList as $data) {
				$conn->query("INSERT INTO preguntas (pregunta ) 
					  VALUES ('{$data[0]}')");
			}
			break;

		case '6': // insertar en la BD despeje

			//$conn->query("DELETE FROM modulo_pregunta");
			//$conn->query("ALTER TABLE modulo_pregunta AUTO_INCREMENT = 1");

			foreach ($dataList as $data) {
				$conn->query("INSERT INTO modulo_pregunta (id_pregunta, resp, id_modulo ) 
						  VALUES ('{$data[0]}', '{$data[1]}', '{$data[2]}')");
			}
			break;

		case '7': // insertar en la BD tanques

			//$conn->query("DELETE FROM tanques");
			//$conn->query("ALTER TABLE tanques AUTO_INCREMENT = 1");

			foreach ($dataList as $data) {
				$conn->query("INSERT INTO tanques (capacidad) 
						  VALUES ('{$data[0]}')");
			}
			break;

		case '8': // insertar en la BD Materia Prima

			//$conn->query("DELETE FROM materia_prima");
			//$conn->query("ALTER TABLE materia_prima AUTO_INCREMENT = 1");

			foreach ($dataList as $data) {
				$referencia = $data[0];
				$nombre = ucfirst(mb_strtolower($data[1], "utf-8"));
				$alias = ucfirst(mb_strtolower($data[2], "utf-8"));

				$conn->query("INSERT INTO materia_prima (referencia, nombre, alias) 
							  VALUES ('{$referencia}', '{$nombre}', '{$alias}')");
			}
			break;

		case '9': // insertar en la BD instructivo

			//$conn->query("DELETE FROM instructivo_preparacion");
			//$conn->query("ALTER TABLE instructivo_preparacion AUTO_INCREMENT = 1");

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

			//$conn->query("DELETE FROM instructivos_base");
			//$conn->query("ALTER TABLE instructivos_base AUTO_INCREMENT = 0");

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
