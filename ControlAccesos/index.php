<?php
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 'On');
include 'Util/Seguridad.class.php';
if ($_POST) {
	$usuario = $_POST['txtUsuario'];
	$pass = $_POST['txtPass'];
	$util = new Seguridad(); 
	
	$url = $util->validarUsuario($usuario, $pass);
	if ($url) {
		$urlPrueba='inicio.php';
		echo "<script>
			location.href='".$urlPrueba."';
			</script>";
	}
	else {
		echo "<script>
			  alert('Lo sentimos, su usuario y/o contrase\u00f1a son incorrectos');
			  location.href='index.php';
			  </script>";
	}
}
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
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>New Capital</title>
<link rel="shortcut icon" type="image/x-icon" href="#">
<link href="static/styles/bootstrap.css" rel="stylesheet">
<link href="static/styles/login.css" rel="stylesheet">
</head>

<body>

	<div id="login" class="container">
		<div class="card card-container">
			<div class="fech">
				<center>
					Lima,
					<script>
		            var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		            var f=new Date();
		            document.write(f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear());
		            </script>
				</center>
			</div>
			<img id="profile-img" class="img-responsive profile-img-card"
				src="static/images/newcaplogo.png" style="width:150px" />

			<form class="form-signin" method='post'>
				<input type="text" value="" id="txtUsuario" name="txtUsuario" class="form-control"
					placeholder="Ingrese usuario" required autofocus> 
				<input type="password" value="" id="txtPass" name="txtPass" class="form-control"
					placeholder="Ingrese contraseña" required /> <br>
				<button class="btn btn-lg btn-primary btn-block btn-signin"
					type="submit">Iniciar sesion</button>
			</form>
			<!-- /form -->
		</div>
	</div>
	<script src="static/scripts/jquery-1.8.2.min.js"></script>
	<script src="static/scripts/bootstrap.js"></script>
	<script src="static/scripts/main.js"></script>

</body>

</html>