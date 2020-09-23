<?php 

if (isset($_POST['name']) === true && empty($_POST['name']) === false) {
	
		require('../../conexion.php');

		  $query ="SELECT * FROM producto WHERE referencia = '".$_POST['name']."'";
		  $result=mysqli_query($conn, $query);

		  

while($row=mysqli_fetch_array($result)) {
echo $row['nombre_referencia'];

}
}


 ?>