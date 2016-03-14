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
				<td>".$var['fechaCarga']."</td>
				<td>".$var['activo']."</td>
				<td>".$var['precio']."</td>
				<td>".$var['cantidad']."</td>
				<td>".$var['comision']."</td>
				<td>".$var['Comision']."</td>
		</tr>
		";

	}
	echo$filas;
}