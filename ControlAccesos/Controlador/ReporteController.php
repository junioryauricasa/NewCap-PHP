<?php
include('../Modelo/reporteEjecutivo.class.php');
$objeto = new reporteEjecutivo();
$action = $_POST['accion'];

if ($action == 'ListarReporteEjecutivo') {
	//echo var_dump($_POST['DNI']);

	$result = $objeto->ObtenerreporteEjecutivo($_POST['Ejecutivo'],$_POST['FechaInicio'],$_POST['FechaFin']);
	
	$filas = "";
	while ( $var = mysql_fetch_array($result)) {
		$filas .= "
		<tr>
				<td>".$var['fecha']."</td>
				<td>".$var['nombre']."</td>
				<td>".$var['comision']."</td>
		</tr>
		";

	}
	echo$filas;
}
else if ($action == 'ListarReporteComision') {
	//echo var_dump($_POST['DNI']);

	$result = $objeto->ObtenerreporteComisiones($_POST['idCliente'],$_POST['FechaInicio'],$_POST['FechaFin']);

	$filas = "";
	while ( $var = mysql_fetch_array($result)) {
		$filas .= "
		<tr>
				<td>".$var['fecha']."</td>
				<td>".$var['usuario']."</td>
				<td>".$var['comision']."</td>
		</tr>
		";

	}
	echo$filas;
}