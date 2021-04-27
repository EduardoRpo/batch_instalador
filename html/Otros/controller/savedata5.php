<?php 

if (isset($_POST['name']) === true && empty($_POST['name']) === false) {
	
		require('../../conexion.php');

		  $query ="SELECT * FROM producto INNER JOIN nombre_producto ON producto.id_nombre_producto = nombre_producto.id WHERE referencia = '".$_POST['name']."'";
		  $result=mysqli_query($conn, $query);

		  

while($row=mysqli_fetch_array($result)) {
echo $row['nombre_producto'];

}
}


 ?>