<?php

require_once('../../../conexion.php');

$datos = $_FILES['datosExcel'];
$operacion = $_POST['operacion'];

$datos = file_get_contents($datos['tmp_name']);

$datos = explode("\n", $datos);
$datos = array_filter($datos);

// preparar datos
foreach ($datos as $data) {
	$dataList[] = explode(";", $data);
}

print_r($dataList);

switch ($operacion) {
	case '1': // insertar en la BD procesos
		foreach ($dataList as $data) {
			$conn->query("INSERT INTO modulo (modulo) 
					  VALUES ('{$data[0]}')");
		}
		break;

	case '2': // insertar en la BD condiciones
		foreach ($dataList as $data) {
			$conn->query("INSERT INTO condicionesmedio_tiempo (id_modulo, min, max) 
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
			$conn->query("INSERT INTO maquinaria (maquina, linea ) 
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
}
