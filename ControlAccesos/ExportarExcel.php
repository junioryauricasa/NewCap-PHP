<?php
session_start ();
if ($_SESSION['usuario']) {
	include 'Modelo/Solicitud.class.php';
	$solicitud = new Solicitud ();
	$fecha = date('Y-m-d_H:i:s');
	header ( "Content-Type: application/vnd.ms-excel" );
	header ( "Expires: 0" );
	header ('Content-type: text/html; charset=utf-8');
	header ( "Cache-Control: must-revalidate, post-check=0, pre-check=0" );
	header ( "content-disposition: attachment;filename=ConsultarSolicitud_$fecha.xls" );
	?>
	<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>ReporteExcel</title>
	
	<style type="text/css">
	.style1 {
		font-family: Verdana, Arial, Helvetica, sans-serif;
		font-weight: bold;
	}
	
	.style2 {
		font-family: Verdana, Arial, Helvetica, sans-serif
	}
	</style>
	</head>
	<body>
		<table border="1">
			<tr>
				<td>Código</td>
				<td>Solicitante</td>
				<td>Tecnología</td>
				<td>Equipo</td>
				<td>Fecha Registro</td>
				<td>Validación G. Solicitante</td>
				<td>Validación Aprobador Tecnología</td>
				<td>Validación J. Tecnología</td>
				<td>Validación G. Tecnología</td>
				<td>Atención Tecnología</td>
				<td>Atención VPN</td>
				<td>Estado</td>
			</tr>
			
			<?php
			
			if ($_GET ['estado'] == '') {
				$estadoGet = 0;
			} else {
				$estadoGet = $_GET ['estado'];
			}
			$fechaInicioGet = '01-01-1900';
			if ($_GET ['fechaInicio'] == '') {
				$fechaInicioGet = '01-01-1900';
			} else {
				$fechaInicioGet = $_GET ['fechaInicio'];
			}
			$fechaFinGet = '01-01-1900';
			if ($_GET ['fechaFin'] == '') {
				$fechaFinGet = '01-01-1900';
			} else {
				$fechaFinGet = $_GET ['fechaFin'];
			}
			$query = $solicitud->obtenerSolicitanteBandeja ( 0, $_GET ['usuario'], $estadoGet, $fechaInicioGet, $fechaFinGet, -1, 0, 1);
			while ( $var = mysql_fetch_array ( $query ) ) {
				$i ++;
				?>									
				<tr>
					<td><?php echo$i; ?></td>
					<td><?php echo$var['usuario']; ?></td>
					<td><?php echo$var['tecnologia']; ?></td>
					<td><?php echo$var['equiposNombres']; ?></td>
					<td><?php echo$var['fecha_registro']; ?></td>
					<td><?php echo$var['fecha_aprobacion_g_solicitante']; ?></td>
					<td><?php echo$var['fecha_aprobacion_tecnologia']; ?></td>
					<td><?php echo$var['fecha_aprobacion_j_tecnologia']; ?></td>
					<td><?php echo$var['fecha_aprobacion_g_tecnologia']; ?></td>
					<td><?php echo$var['fecha_atencion_tecnologia']; ?></td>
					<td><?php echo$var['fecha_atencion_vpn']; ?></td>
					<td><?php echo$var['estado']; ?></td>
				</tr>
			<?php }?>
		</table>
	</body>
	</html>
<?php }else {
    header("Location: index.php");
}
?>