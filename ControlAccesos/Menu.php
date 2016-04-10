<?php 
include 'Modelo/Constantes.class.php';
require_once 'Util/Util.class.php';
$util = new Util();
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
<meta charset="utf-8">
<title>New Capital</title>
</head>
<body>
	<div id="menuprincipal" class="col-md-2">
		<div id="MainMenu">
			<div class="list-group panel">
				<?php if($_SESSION['TipoUsuario'] == 1) 
				{?>
				<a href="Usuarios.php" id="divimportacion" class="list-group-item">
					<span class="fa fa-user"></span>Usuarios
				</a>
				
				<a href="Custodios.php" id="divimportacion" class="list-group-item">
					<span class="fa fa-user"></span>Custodios
				</a>
				<a href="Ejecutivos.php" id="divimportacion" class="list-group-item">
					<span class="fa fa-user"></span>Ejecutivos
				</a>
				<a href="Fondos.php" id="divimportacion" class="list-group-item">
					<span class="fa fa-th-list"></span>Fondos
				</a>
				<a href="Activos.php" id="divimportacion" class="list-group-item">
					<span class="fa fa-th-list"></span>Activos
				</a>
				<li><a href="" id="divimportacion" class="list-group-item">
						<span class="fa fa-support"></span>Fondos</a>
					<ul>
						<li><a href="Aportes.php" id="divimportacion" class="list-group-item">
						<span class="fa fa"></span>Aportes</a></li>
					</ul>
					<ul>
						<li><a href="Rescate.php" id="divimportacion" class="list-group-item">
						<span class="fa fa"></span>Rescate</a></li>
					</ul>
				</li>	
				<li><a href="" id="divimportacion" class="list-group-item">
				<span class="fa fa-support"></span>Acciones</a>	
					<ul>
						<li><a href="Cargaoperaciones.php" id="divimportacion" class="list-group-item">
						<span class="fa fa"></span>Carga Operaciones</a></li>
					</ul>
					<ul>
						<li><a href="Operaciones.php" id="divimportacion" class="list-group-item">
						<span class="fa fa"></span>Realizar Operacion</a></li>
					</ul>
				</li>
				<a href="Fichero.php" id="divimportacion" class="list-group-item">
					<span class="fa fa-file-text-o"></span>Ficheros
				</a>
				<a href="Noticias.php" id="divimportacion" class="list-group-item">
					<span class="fa fa-desktop"></span>Noticias
				</a> 
				 
				<a href="reporteEjecutivos.php" id="divimportacion" class="list-group-item">
					<span class="fa fa-desktop"></span>Reporte Ejecutivos
				</a> 
				<a href="reporteComisiones.php" id="divimportacion" class="list-group-item">
					<span class="fa fa-desktop"></span>Reporte Comisiones
				</a> 
				<?php }
				else {?>
				<a href="ClienteOperaciones.php" id="divimportacion" class="list-group-item">
					<span class="fa fa-support"></span>Operaciones
				</a>
				<?PHP 
				if($_SESSION['accionario']==1){
				?>
				
				<a href="ClientePortafolios.php" id="divimportacion" class="list-group-item">
					<span class="fa fa-line-chart"></span>Acciones
				</a>
				<?php 
				}
				?>
				<a href="ClienteGraficas.php" id="divimportacion" class="list-group-item">
					<span class="fa fa-line-chart"></span>Graficas
				</a>
				<a href="ClienteFichero.php" id="divimportacion" class="list-group-item">
					<span class="fa fa-file-text-o"></span>Ficheros
				</a>
				<a href="ClienteNoticias.php" id="divimportacion" class="list-group-item">
					<span class="fa fa-desktop"></span>Noticias
				</a>
				
				
				<?php } ?>
			</div>
		</div>
	</div>
</body>
</html>