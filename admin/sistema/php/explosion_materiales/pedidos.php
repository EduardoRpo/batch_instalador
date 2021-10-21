<?php

if (!empty($_POST)) {

	$pedidos = $_POST['data'];

	foreach ($pedidos as $pedido) {

		/* Busca si el pedido ya fue registrado */
		$query = "SELECT * FROM pedidos WHERE pedido = :pedido AND id_producto = :id_producto";
		$query = $conn->prepare($query);
		$query->execute(['pedido' => $pedido['Documento'], 'id_producto' => $pedido['Producto']]);
		$rows = $query->rowCount();

		/* si existe el pedido, carga la materia prima de acuerdo con la referencia del pedido */
		if ($rows > 0) {

			$query = "UPDATE FROM pedidos SET cantidad = :cantidad WHERE pedido = :pedido AND id_producto = :id_producto ";
			$query = $conn->prepare($query);
			$query->execute(['cantidad' => $pedido['Cant_Original'], 'pedido' => $pedido['Documento'], 'id_producto' => $pedido['Producto']]);

			/* Busca la materia prima de acuerdo con la referencia */
			$query = "SELECT f.id, f.id_materiaprima, cast(AES_DECRYPT(porcentaje, 'Wf[Ht^}2YL=D^DPD') as char)porcentaje 
					  FROM formula f WHERE f.id_producto = :id_producto";
			$query = $conn->prepare($query);
			$query->execute(['id_producto' => $pedido['Producto']]);
			$materiales = $query->fetchAll(PDO::FETCH_ASSOC);

			/* Validar si no hay formula guardar referencia y pedido y generar alerta */

			foreach ($materiales as $material) {
				$cantidad = ($material['porcentaje'] / 100) * $pedido['Cant_Original'] /* presentacion * densidad * 3 % */

				$query = "SELECT * FROM batch_explosion_materiales WHERE id_materiaprima = :id_materiaprima";
				$query = $conn->prepare($query);
				$query->execute(['id_materiaprima' => $ $material['id_materiaprima']]);
				$rows = $query->rowCount();

				if ($rows > 0) {
					$materia_prima = $query->fetchAll(PDO::FETCH_ASSOC);

					$cantidadOld = floatval($materia_prima['cantidad']);
					$cantidadNueva = $cantidad + $cantidadOld;

					$query = "UPDATE `batch_explosion_materiales` SET `cantidad` = :cantidadNueva 
							WHERE `batch_explosion_materiales`.`id_materiaprima` =  :id_materiaprima";
					$query = $conn->prepare($query);
					$query->execute(['cantidadNueva' => $cantidadNueva, 'id_materiaprima' => $id_materiaprima]);
				} else {

					$query = "INSERT INTO batch_explosion_materiales (id_materiaprima, cantidad) 
							  VALUES(:id_materiaprima , :cantidad)";
					$query = $conn->prepare($query);
					$query->execute(['cantidad' => $cantidad, 'id_materiaprima' => $id_materiaprima]);
				}
			}
		} else {
			$query = "INSERT INTO pedidos (pedido, id_producto, cantidad, fecha_pedido) 
					  VALUES(:pedido, :id_producto, :cantidad, :fecha_pedido)";
			$query = $conn->prepare($query);
			$query->execute([
				'pedido' => $pedido['Documento'],
				'id_producto' => $pedido['Producto'],
				'cantidad' => $pedido['Cant_Original'],
				'fecha_pedido' => $pedido['Fecha_Dcto'],
			]);
		}
	}
}
