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
elseif ($action == 'countListarReporteEjecutivo') {
	//echo var_dump($_POST['DNI']);

	$result = $objeto->CountObtenerreporteEjecutivo($_POST['Ejecutivo'],$_POST['FechaInicio'],$_POST['FechaFin']);

	$filas = "<table align='right'>";
	$filas .= "<tr>";
	$filas .= "<td><strong><h3>Total:</h3></strong> </td>";
    $filas .= "<td><strong><h3>".$result."</h3></strong> </td>";
    $filas .= "<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>";
    $filas .= "</tr>";
    $filas .= "</table>";
	echo $filas;
}
else if ($action == 'ListarReporteComision') {
	//echo var_dump($_POST['DNI']);

	$result = $objeto->ObtenerreporteComisiones($_POST['FechaInicio'],$_POST['FechaFin']);

	$filas = "";
	while ( $var = mysql_fetch_array($result)) {
		$filas .= "
		<tr>
				<td>".$var['fechaHora']."</td>
				<td>".$var['usuario']."</td>
				<td>".$var['comision']."</td>
		</tr>
		";

	}
	echo$filas;
}
elseif ($action == 'countListarReporteComision') {
	//echo var_dump($_POST['DNI']);

	$result = $objeto->CountObtenerreporteComisiones($_POST['Ejecutivo'],$_POST['FechaInicio'],$_POST['FechaFin']);

	$filas = "<table align='right'>";
	$filas .= "<tr>";
	$filas .= "<td><strong><h3>Total:</h3></strong> </td>";
	$filas .= "<td><strong><h3>".$result."</h3></strong> </td>";
	$filas .= "<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>";
	$filas .= "</tr>";
	$filas .= "</table>";
	echo $filas;
}