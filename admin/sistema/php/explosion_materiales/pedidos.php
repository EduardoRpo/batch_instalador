<?php

if (!empty($_POST)) {

	$pedidos = $_POST['data'];

	foreach ($pedidos as $pedido) {

		/* Busca si el pedido ya fue registrado */
		$query = "SELECT * FROM pedidos WHERE pedido = :pedido";
		$query = $conn->prepare($query);
		$query->execute(['pedido' => $pedido['Documento']]);
		$rows = $query->rowCount();

		/* carga la materia prima de acuerdo con la referencia del pedido */
		if ($rows > 0) {

			$query = "UPDATE FROM pedidos p WHERE f.id_producto = :referencia";
			$query = $conn->prepare($query);
			$query->execute(['referencia' => $pedidos['Documento']]);
			$data = $query->fetchAll(PDO::FETCH_ASSOC);


			$query = "SELECT f.id, f.id_materiaprima, cast(AES_DECRYPT(porcentaje, 'Wf[Ht^}2YL=D^DPD') as char)porcentaje 
					  FROM formula f WHERE f.id_producto = :referencia";
			$query = $conn->prepare($query);
			$query->execute(['referencia' => $pedidos['Documento']]);
			$data = $query->fetchAll(PDO::FETCH_ASSOC);
		} else {
			$sql = "INSERT INTO $tbl (id_producto, id_materiaprima, porcentaje) VALUES (:id_producto, :id_materiaprima, AES_ENCRYPT(:porcentaje,'Wf[Ht^}2YL=D^DPD') )";
			$query = $conn->prepare($sql);
			$result = $query->execute(['id_materiaprima' => $id_materiaprima, 'id_producto' => $id_producto, 'porcentaje' => $porcentaje]);
		}
	}
}
