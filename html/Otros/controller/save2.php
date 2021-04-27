<?php 	

require('../../conexion.php');

$usuario2 = $_POST['usuario2'];
$contrasena2 = $_POST['contrasena2'];
echo $contrasena2;
		 $query ="SELECT * FROM usuario WHERE email = '".$_POST['usuario2']."' AND password = '".$_POST['contrasena2']."'";
		 $result=mysqli_query($conn, $query);

while($row=mysqli_fetch_array($result)) {
echo $row['firma'];
}

 ?>