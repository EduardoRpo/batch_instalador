<?php 	

require('../../conexion.php');

$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];
		 $query ="SELECT * FROM usuario WHERE email = '".$_POST['usuario']."' AND password = '".$_POST['contrasena']."'";
		 $result=mysqli_query($conn, $query);

while($row=mysqli_fetch_array($result)) {
echo $row['firma'];
}

 ?>