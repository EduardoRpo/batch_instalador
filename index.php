<?php
session_start();
require_once('./html/php/login.php');
include('./html/modal/modal_recuperarClave.php');
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Batch Record">
	<meta name="author" content="Teenus SAS">
	<title>Samara Cosmetics</title>


	<!-- Bootstrap Core CSS -->
	<link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<!-- Custom CSS -->
	<link href="/html/css/sesion.css" rel="stylesheet">

	<!-- <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css"> -->
	<link rel="stylesheet" type="text/css" href="html/vendor/datatables/datatables.min.css">
	<link rel="stylesheet" href="html/vendor/jquery-confirm/jquery-confirm.min.css">
	<link rel="stylesheet" type="text/css" href="html/vendor/datatables/DataTables-1.10.20/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

	<!-- Alertify -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />

	<!-- icons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />

</head>

<body class="text-center">
	<form class="form-signin" action="" method="POST">
		<img class="mb-4" src="/assets/images/logo-light-text2.png" alt="" width="200" height="100">
		<h1 class="h3 mb-3 font-weight-normal" style="color:slategrey">Iniciar Sesión</h1><br>

		<input type="text" name="usuario" class="form-control mb-3" placeholder="Usuario" autocomplete="off" required autofocus>

		<div class="input-group">
			<input type="password" name="clave" id="clave" class="form-control" placeholder="Contraseña" required>
			<span class="input-group-btn" style="height:42px;">
				<button id="show_password" class="btn btn-success" type="button" onclick="mostrarPassword()">
					<span class="fa fa-eye-slash icon"></span>
				</button>
			</span>
		</div>


		<div class="mb-3">
			<!-- <div class="form-check">
    			<input type="checkbox" class="form-check-input" id="Adminchecked">
    				<label class="form-check-label" for="Adminchecked">Administrador</label>
			</div> -->
			<a href="" data-toggle="modal" data-target="#ModalRecuperarClave">Recuperar Contraseña</a>
		</div>

		<button class="btn btn-lg btn-success btn-block mb-3" type="submit">Iniciar</button><!-- onclick="window.location='/html/crear-batch.php'" -->
		<div class=""></div>
		<div class="alert alert-danger mb" role="alert"> <?php echo isset($alert) ? $alert : ''; ?> </div>
		<p class="mt-5 mb-3 text-muted">&copy; 2020</p>
	</form>

	<script src="html/vendor/jquery/jquery-3.2.1.min.js" type="text/javascript"></script>
	<script src="html/vendor/bootstrap/js/popper.js" type="text/javascript"></script>
	<script src="html/vendor/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

	<!-- Alertify -->
	<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
	<script src="html/js/login/login.js"></script>
</body>



</html>