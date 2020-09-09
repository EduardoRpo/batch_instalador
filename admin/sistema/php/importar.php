<?php

require_once('../../../conexion.php');

//obtener datos

$datos = $_FILES['datosExcel'];
$operacion = $_POST['operacion'];

$datos = file_get_contents($datos['tmp_name']);

$datos = explode("\n", $datos);
$datos = array_filter($datos);

// preparar datos
foreach ($datos as $data) {
	$dataList[] = explode(";", $data);
}

//Buscar operacion y ejecutar

switch ($operacion) {
	case '1': // insertar en la BD procesos

		$conn->query("DELETE FROM modulo");
		$conn->query("ALTER TABLE modulo AUTO_INCREMENT = 1");

		foreach ($dataList as $data) {
			$conn->query("INSERT INTO modulo (modulo) 
					  VALUES ('{$data[0]}')");
		}
		break;

	case '2': // insertar en la BD condiciones

		$conn->query("DELETE FROM condicionesmedio_tiempo");
		$conn->query("ALTER TABLE condicionesmedio_tiempo AUTO_INCREMENT = 1");

		foreach ($dataList as $data) {
			$conn->query("INSERT INTO condicionesmedio_tiempo (id_modulo, min, max) 
				  VALUES ('{$data[0]}', '{$data[1]}', '{$data[2]}')");
		}
		break;

	case '3': // insertar en la BD desinfectante

		$conn->query("DELETE FROM desinfectante");
		$conn->query("ALTER TABLE desinfectante AUTO_INCREMENT = 1");

		foreach ($dataList as $data) {
			$conn->query("INSERT INTO desinfectante (nombre, concentracion) 
				  VALUES ('{$data[0]}', '{$data[1]}')");
		}
		break;

	case '4': // insertar en la BD equipos

		$conn->query("DELETE FROM maquinaria");
		$conn->query("ALTER TABLE maquinaria AUTO_INCREMENT = 1");

		foreach ($dataList as $data) {
			$conn->query("INSERT INTO maquinaria (maquina, linea ) 
				  VALUES ('{$data[0]}', '{$data[1]}')");
		}
		break;

	case '5': // insertar en la BD preguntas

		$conn->query("DELETE FROM preguntas");
		$conn->query("ALTER TABLE preguntas AUTO_INCREMENT = 1");

		foreach ($dataList as $data) {
			$conn->query("INSERT INTO preguntas (pregunta ) 
					  VALUES ('{$data[0]}')");
		}
		break;

	case '6': // insertar en la BD despeje

		$conn->query("DELETE FROM modulo_pregunta");
		$conn->query("ALTER TABLE modulo_pregunta AUTO_INCREMENT = 1");

		foreach ($dataList as $data) {
			$conn->query("INSERT INTO modulo_pregunta (id_pregunta, resp, id_modulo ) 
						  VALUES ('{$data[0]}', '{$data[1]}', '{$data[2]}')");
		}
		break;

	case '7': // insertar en la BD tanques

		$conn->query("DELETE FROM tanques");
		$conn->query("ALTER TABLE tanques AUTO_INCREMENT = 1");

		foreach ($dataList as $data) {
			$conn->query("INSERT INTO tanques (capacidad) 
						  VALUES ('{$data[0]}')");
		}
		break;

	case '8': // insertar en la BD Materia Prima

		$conn->query("DELETE FROM materia_prima");
		$conn->query("ALTER TABLE materia_prima AUTO_INCREMENT = 1");

		foreach ($dataList as $data) {
			$conn->query("INSERT INTO materia_prima (referencia, nombre, alias) 
							  VALUES ('{$data[0]}', '{$data[1]}', '{$data[2]}')");
		}
		break;

		$conn->close();
}
