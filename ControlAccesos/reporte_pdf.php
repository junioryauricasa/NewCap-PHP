<?php
session_start ();
if ($_SESSION['usuario']) {
	include 'Modelo/Solicitud.class.php';
	$solicitud = new Solicitud ();
	require_once("dompdf/dompdf_config.inc.php");
	$codigoHTML='';
	
	$codigoHTML.='	
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Documento sin tÃ­tulo</title>
	</head>
	<body>
	';
	$identSolicitud = $_GET ['ident_solicitud'];
			$sql=mysql_query("select (SELECT  GROUP_CONCAT(ident_equipo SEPARATOR ', ')  FROM solicitud_equipo se where se.ident_solicitud = so.ident_solicitud and se.ident_001_estado = 1) as equipos,
					(SELECT  GROUP_CONCAT(es.nombre SEPARATOR ', ')  FROM solicitud_equipo se inner join equipo es on se.ident_equipo = es.ident_equipo
					where se.ident_solicitud = so.ident_solicitud and se.ident_001_estado = 1) as equiposNombres,
					so.ident_solicitud, tipo, sub_tipo, usuario, so.ident_tecnologia, te.nombre as tecnologia,
					justificacion, comentario, ident_002_estado, es.descripcion as estado, so.fecha_registro,
					so.fecha_aprobacion_g_solicitante, so.fecha_aprobacion_tecnologia, so.fecha_aprobacion_g_tecnologia,
					so.fecha_atencion_tecnologia, so.fecha_atencion_vpn, so.gerencia_solicitante, so.gerencia_tecnologia,
					so.fecha_aprobacion_j_tecnologia, jefe_tecnologia, so.ident_005_privilegio, pr.descripcion as privilegio
					,su.ident_solicitud_usuario,su.empresa,su.nombre,su.cargo,su.area,su.gerencia,su.correo,su.celular
					from solicitud so inner join tecnologia te on so.ident_tecnologia = te.ident_tecnologia
					inner join parametro es on es.ident_parametro = so.ident_002_estado
					inner join parametro pr on pr.ident_parametro = so.ident_005_privilegio
					left join solicitud_usuario su on su.ident_solicitud=so.ident_solicitud
					where so.ident_solicitud = $identSolicitud");
	while($res=mysql_fetch_array($sql)){
		$codigoHTML.='
		<label for="inputEmail1" class="col-lg-4 control-label"> Tipo Solicitud:</label>
		<label for="inputEmail1" class="col-lg-4 control-label">'.$res['tipo'].'</label>
		<br>
		<label for="inputEmail1" class="col-lg-4 control-label"> Tecnología :</label>
		<label for="inputEmail1" class="col-lg-4 control-label">'.$res['tecnologia'].'</label>
		<br>
		<label for="inputEmail1" class="col-lg-4 control-label"> Equipo :</label>
		<label for="inputEmail1" class="col-lg-4 control-label">'.$res['equiposNombres'].'</label>
		<br>		
		<label for="inputEmail1" class="col-lg-4 control-label">Justificación :</label>
									<textarea id="txtComentario" class="form-control" rows=""
											cols="">'.$res['justificacion'].'</textarea>
		<br>											
		<label for="inputEmail1" class="col-lg-4 control-label">Comentario :</label>
								<textarea id="txtComentario" class="form-control" rows=""
											cols="">'.$res['comentario'].'</textarea>
		<br>											
		<label for="inputEmail1" class="col-lg-4 control-label">Privilegio :</label>
		<label for="inputEmail1" class="col-lg-4 control-label">'.$res['privilegio'].'</label>';
	}
	$codigoHTML.='
	</body>
	</html>';
	//echo $codigoHTML;
	$codigoHTML=utf8_encode($codigoHTML);
	$dompdf=new DOMPDF();
	$dompdf->load_html($codigoHTML);
	ini_set("memory_limit","128M");
	$dompdf->render();
	$dompdf->stream("Reporte_solicitud.pdf");
}else {
	header("Location: index.php");
}
?>
