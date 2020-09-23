
<?php
//fetch.php
include ("../conexion.php");

$query = "SELECT * FROM producto INNER JOIN batch ON batch.id_producto = producto.referencia INNER JOIN linea ON producto.id_linea = linea.id INNER JOIN propietario ON producto.id_propietario = propietario.id INNER JOIN presentacion_comercial ON producto.id_presentacion_comercial = presentacion_comercial.id;";
$resultado = mysqli_query($conn, $query);

if (!$resultado) {
	die ("Error");
}
else{
	while ($data =mysqli_fetch_assoc($resultado)) {
		$arreglo["data"][] = $data;
		}
		echo json_encode($arreglo);

}

?>
