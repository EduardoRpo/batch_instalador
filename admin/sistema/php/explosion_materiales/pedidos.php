<?php

if (!empty($_POST)) {
	require_once '../../../../conexion.php';
	$pedidos = $_POST['data'];

	/* Eliminar las referencias sin formula */
	$query = "DELETE FROM explosion_materiales_referencias";
	$query = $conn->prepare($query);
	$query->execute();

	$c = 0;
	foreach ($pedidos as $pedido) {
		$c = $c + 1;
		/* Busca la materia prima de acuerdo con la referencia */

		$query = "SELECT * FROM formula WHERE id_producto = :id_producto";
		$query = $conn->prepare($query);
		$query->execute(['id_producto' => trim($pedido['Producto'])]);
		$rows = $query->rowCount();

		/* Guardar las referencias sin formulas*/

		if ($rows == 0) {

			$query = "SELECT * FROM explosion_materiales_referencias 
			WHERE referencia = :id_producto";
			$query = $conn->prepare($query);
			$query->execute(['id_producto' => $pedido['Producto']]);
			$rows = $query->rowCount();

			if ($rows == 0) {
				$query = "INSERT INTO explosion_materiales_referencias (referencia) 
				VALUES(:id_producto)";
				$query = $conn->prepare($query);
				$query->execute(['id_producto' => trim($pedido['Producto'])]);
			}
		} else {

			/* Busca si el pedido ya fue registrado */

			$query = "SELECT * FROM pedidos 
			WHERE pedido = :pedido AND id_producto = :id_producto";
			$query = $conn->prepare($query);
			$query->execute(['pedido' => trim($pedido['Documento']), 'id_producto' => trim($pedido['Producto'])]);
			$rows = $query->rowCount();

			/* si existe el pedido, carga la materia prima de acuerdo con la referencia del pedido */

			if ($rows > 0) {
				$query = "UPDATE pedidos SET unidades = :unidades 
				WHERE pedido = :pedido AND id_producto = :id_producto";
				$query = $conn->prepare($query);
				$query->execute([
					'unidades' => trim($pedido['Cantidad']),
					'pedido' => trim($pedido['Documento']),
					'id_producto' => trim($pedido['Producto'])
				]);
			} else {
				$query = "INSERT INTO pedidos (pedido, id_producto, unidades, fecha_pedido) 
						VALUES(:pedido, :id_producto, :unidades, :fecha_pedido)";
				$query = $conn->prepare($query);
				$query->execute([
					'pedido' => trim($pedido['Documento']),
					'id_producto' => trim($pedido['Producto']),
					'unidades' => trim($pedido['Cantidad']),
					'fecha_pedido' => trim($pedido['Fecha_Dcto']),
				]);
			}
			explosionMateriales($conn, $pedido);
		}
	}

	/* Validar las refencias vs formulas */
	referenciasSinFormula($conn);

	//echo json_encode($referenciaSinFormula, JSON_UNESCAPED_UNICODE);
}


function referenciasSinFormula($conn)
{

	/* Busca la referencias */

	$query = "SELECT * FROM explosion_materiales_referencias";
	$query = $conn->prepare($query);
	$query->execute();
	$referencias = $query->fetchAll(PDO::FETCH_ASSOC);

	foreach ($referencias as $id_producto) {

		/* Busca la materia prima de acuerdo con la referencia */

		$query = "SELECT * FROM formula WHERE id_producto = :id_producto";
		$query = $conn->prepare($query);
		$query->execute(['id_producto' => $id_producto['referencia']]);
		$rows = $query->rowCount();

		if ($rows != 0) {
			$query = "DELETE FROM explosion_materiales_referencias WHERE referencia = :id_producto";
			$query = $conn->prepare($query);
			$query->execute(['id_producto' => $id_producto['referencia']]);
			$rows = $query->rowCount();
		}
	}
}



function explosionMateriales($conn, $pedido)
{
	/* Busca la materia prima de acuerdo con la referencia */
	$id_producto = trim($pedido['Producto']);
	$query = "SELECT f.id, f.id_materiaprima, cast(AES_DECRYPT(porcentaje, 'Wf[Ht^}2YL=D^DPD') as char)porcentaje, pc.nombre as presentacion_comercial, l.densidad 
			FROM formula f 
			INNER JOIN producto p ON f.id_producto = p.referencia 
			INNER JOIN linea l ON l.id = p.id_linea 
			INNER JOIN presentacion_comercial pc ON pc.id = p.presentacion_comercial WHERE f.id_producto = :id_producto";
	$query = $conn->prepare($query);
	$query->execute(['id_producto' => $id_producto]);
	$materiales = $query->fetchAll(PDO::FETCH_ASSOC);

	/* Carga la materia prima de la referencia */

	foreach ($materiales as $material) {
		$tamanioLote = ((trim($pedido['Cantidad']) * trim($material['densidad'])) * trim($material['presentacion_comercial']) / 1000) * (1 + 0.005);
		$cantidad = (($material['porcentaje'] / 100) * $tamanioLote);

		$query = "SELECT * FROM explosion_materiales_pedidos WHERE id_pedido = :pedido AND id_producto = :id_producto AND id_materiaprima = :id_materiaprima";
		$query = $conn->prepare($query);
		$query->execute([
			'pedido' => trim($pedido['Documento']),
			'id_producto' => trim($pedido['Producto']),
			'id_materiaprima' => trim($material['id_materiaprima'])
		]);
		$rows = $query->rowCount();

		if ($rows > 0) {
			$query = "UPDATE explosion_materiales_pedidos SET cantidad = :cantidad 
					  WHERE id_pedido = :pedido AND id_producto = :id_producto AND id_materiaprima = :id_materiaprima";
			$query = $conn->prepare($query);
			$query->execute([
				'cantidad' => trim($cantidad),
				'pedido' => trim($pedido['Documento']),
				'id_producto' => trim($pedido['Producto']),
				'id_materiaprima' => trim($material['id_materiaprima'])
			]);
		} else {
			$query = "INSERT INTO explosion_materiales_pedidos (id_pedido, id_producto, id_materiaprima, cantidad) VALUES(:id_pedido, :id_producto, :id_materiaprima , :cantidad)";
			$query = $conn->prepare($query);
			$query->execute([
				'id_pedido' => trim($pedido['Documento']),
				'id_producto' => trim($pedido['Producto']),
				'id_materiaprima' => trim($material['id_materiaprima']),
				'cantidad' => trim($cantidad)
			]);
		}
	}
}
