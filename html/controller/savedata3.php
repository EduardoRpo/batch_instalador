<?php 

if (isset($_POST['name']) === true && empty($_POST['name']) === false) {
	
		require('../../conexion.php');

		  $query ="SELECT * FROM producto INNER JOIN notificacion_sanitaria ON producto.id_notificacion_sanitaria = notificacion_sanitaria.id WHERE referencia = '".$_POST['name']."'";
		  $result=mysqli_query($conn, $query);

		  

while($row=mysqli_fetch_array($result)) {
echo $row['notificacion_sanitaria'];

}
}


 ?>