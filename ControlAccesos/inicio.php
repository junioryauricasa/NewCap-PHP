<?php
session_start ();
if ($_SESSION['usuario']) {
	include 'Modelo/Usuario.class.php';
	include 'Modelo/Fondo.class.php';

	$usuario = new Usuario();
	$Fondo = new Fondo();
	?>
	<!DOCTYPE html>
	<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6 lt8"> <![endif]-->
	<!--[if IE 7 ]>    <html lang="en" class="no-js ie7 lt8"> <![endif]-->
	<!--[if IE 8 ]>    <html lang="en" class="no-js ie8 lt8"> <![endif]-->
	<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
	<!--[if (gt IE 9)|!(IE)]><!-->
	<html lang="en" class="no-js">
	<!--<![endif]-->
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<script src="static/scripts/jquery-1.8.2.min.js"></script>
	<link href="static/styles/main.css" rel="stylesheet">
	<script src="static/scripts/jquery-1.7.1.min.js"></script>
	<title>New Capital</title>
	</head>
	<body>
		<div class="container">
	<?php include('Cabecera.php'); ?>
	<div class="row">
	<?php include('Menu.php');?>
	<div class="col-md-10" id="contenedorprincipal">
					<div class="panel panel-default" id="importacion">
						<div class="panel-heading">
							<strong><span id="omenu" class="fa fa-chevron-circle-left"></span>
								Bienvenido </strong><span class="pull-right"><span
								id="oprincipal" class="fa fa-chevron-circle-up"></span>		

						</div>
						<div class="panel-body">
							<div class="panel panel-default text-center h u-filter-loader">
								<p>Buscando resultados:</p>
								<div class="progress progress-striped active"
									style="width: 50%; margin: auto;">
									<div class="progress-bar" role="progressbar" aria-valuenow="100"
										aria-valuemin="0" aria-valuemax="100" style="width: 100%">
										<span class="sr-only">45% Complete</span>
									</div>
								</div>
								&nbsp;
							</div>
							<h3>Sr(a) <?php echo$_SESSION['nombre']." ".$_SESSION['Apellido']?></h3>
							<h5>Usuario  : <?php echo$_SESSION['usuario']?></h5>		
							<h5>DNI      : <?php echo$_SESSION['DNI']?></h5>	
							<h5>Direccion: <?php echo$_SESSION['Direccion']?></h5>		
							<h5>Correo: <?php echo$_SESSION['Correo']?></h5>	
							<h5>Telefono: <?php echo$_SESSION['Telefono']?></h5>
							<br>
							<div class="nav">
								<div class="pull-right">
									<ul class="pagination">
									
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
					<script src="static/scripts/jquery.doubletap.js"></script>
	<script src="static/scripts/bootstrap.js"></script>
	<script src="static/scripts/main.js"></script>
	<script>
<?php }else {
    header("Location: index.php");
}
?>