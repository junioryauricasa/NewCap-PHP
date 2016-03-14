<?php
session_start ();
if ($_SESSION['usuario']) {
	include 'Modelo/reporteEjecutivo.class.php';
	include 'Modelo/Ejecutivo.class.php';

	$reporteEjecutivo = new reporteEjecutivo();
	$Ejecutivo = new Ejecutivo();
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
	<title>New Capital - Custodios</title>
	<script type="text/javascript">
	$(document).ready(function () {
	    
	});
	
	function activar(div) {
	    try {
	        $('#tab1').css("display", "none");
	        $('#tab2').css("display", "none");
	        $('#tab1E').css("display", "none");
	        $('#tab2E').css("display", "none");
	        $('#litab1').removeClass('active');
	        $('#litab2').removeClass('active');
	        $('#litab1E').removeClass('active');
	        $('#litab2E').removeClass('active');
	        $('#' + div).css("display", "block");
	        $('#li' + div).addClass('active');
	    }
	    catch (err) {
	        alertPopup(err.Message);
	    }
	}
	</script>
	</head>
	<body>
		<div class="container">
	<?php include('Cabecera.php'); ?>
	<div class="row">
	<?php include('Menu.php');?>
	<input type="hidden" id="txtGerenteSolicitante" value="<?php echo$gerente['USUARIO'];?>" />
	<input type="hidden" id="txtGerenteSolicitanteNombre" value="<?php echo$gerente['NOMBRE'];?>" />
	<input type="hidden" id="txtGerenteSolicitanteCargo" value="<?php echo$gerente['CARGO'];?>" />
	<div class="col-md-10" id="contenedorprincipal">
					<div class="panel panel-default" id="importacion">
						<div class="panel-heading">
							<strong><span id="omenu" class="fa fa-chevron-circle-left"></span>
								Reporte De Ejecutivos</strong> <span class="pull-right"><span
								id="oprincipal" class="fa fa-chevron-circle-up"></span>						
						</div>
						<div class="panel-body">
							<div class="nav">
								<nav id="bprincipal" class="navbar navbar-default navbar-inverse"
									role="navigation">
									<div class="navbar-collapse  navbar-filter">
									<label for="inputEmail1" style="margin-right:20px; margin-left:20px;">Ejecutivo: </label>
										<select id="txtEjecutivo1R" style="height:23px; width:150px" >
										<option value="0"  selected>Seleccionar</option>
										<?php
										$query = $Ejecutivo->ObtenerEjecutivos();
										//echo $query;
										while ( $var = mysql_fetch_array ( $query ) ) {
											$i ++;
										?>	
											<option value="<?php echo$var['idEjecutivos']; ?>"><?php echo$var['nombre']; ?></option>
										<?php }?>
										</select>
										<label for="inputEmail1" style="margin-right:20px; margin-left:20px;">Fecha Inicial :</label>
										<input type="date" style="height:23px; width:150px" value="" id="txtFechaInicio" name="txtFechaInicio">
										<label for="inputEmail1" style="margin-right:20px; margin-left:20px;">Fecha Final :</label>
										<input type="date" style="height:23px; width:150px" value="" id="txtFechaFin" name="txtFechaFin" >
										</a> &nbsp;&nbsp; <a class="btn btn-default"
											data-toggle="modal" href="#" onclick="Ejecutarreporte()"> <span
											class="fa fa-user-plus"></span> Buscar
										</a> &nbsp;&nbsp; 
									</div>
									<br>
								</nav>	
							</div>
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
	
							<div class="table-responsive u-table-search">
								<!-- GRID -->
								<table id="principal"
									class="table table-bordered table-striped table-hover table-responsive ">
									<thead>
										<tr>
											<th>Fecha Operacion</th>
											<th>Activo</th>
											<th>Precio</th>
											<th>Cantidad</th>
											<th>Comision</th>
											<th>Total</th>
										</tr>
									</thead>
									<tbody id="BandejaUsuarios">
									<?php
									$query = $reporteEjecutivo->ObtenerreporteEjecutivo("", "", "");
									//echo $query;
									while ( $var = mysql_fetch_array ( $query ) ) {
										$i ++;
									?>	
										<tr>
											<td><?php echo$var['fechaCarga']; ?></td>
											<td><?php echo$var['activo']; ?></td>
											<td><?php echo$var['precio']; ?></td>
											<td><?php echo$var['cantidad']; ?></td>
											<td><?php echo$var['comision']; ?></td>
											<td><?php echo round($var['Comision'],3); ?></td>
										</tr>
									<?php }?>
									</tbody>
								</table>
								<!-- /GRID -->
							</div>
							<div class="nav">
								<div class="pull-right">
									<ul class="pagination">
									
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- SOLICITUDES INTENAS -->
		<!-- Modal Agregar Solicitud Interna -->
		<div class="modal fade" id="myModalAddFondo" tabindex="-1"
			role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"
							aria-hidden="true" onclick="refresh()">&times;</button>
						<h4 class="modal-title">
							<span class="fa fa-user-plus"></span><label id="lblTitulo">Crear
								Custodio</label>
						</h4>
					</div>
					<div class="modal-body" style="padding-bottom: 0px !important;">
						<div id="idMensajeU"></div>
						<!-- FORM -->
						<form class="bs-example form-horizontal u-action-error">
							<div class="form-group">
								<label for="inputEmail1" class="col-lg-2 control-label" style="width: 150px; margin-left: 100px;">Codigo:</label>
								<div class="col-lg-4">
									<input type="text" id="txtCodigoCustodio" class="form-control">
								</div>
							</div>	
							<div class="form-group">
								<label for="inputEmail1" class="col-lg-2 control-label" style="width: 150px; margin-left: 100px;">Nombre:</label>
								<div class="col-lg-4">
									<input type="text" id="txtNombreCustodio" class="form-control">
								</div>
							</div>	
													
							<!-- /FORM -->
					
					</div>
					<div class="modal-footer">
						<table align="right">
							<tr>
								<td>&nbsp;&nbsp;</td>
								<td>
									<button class="btn btn-primary" type="button"
										onclick="CrearCustodio()">
										<span class="fa fa-save"></span> Guardar
									</button>
								</td>
								<td>&nbsp;&nbsp;</td>
								<td>
									<button data-dismiss="modal" class="btn btn-default" type="button"
										onclick="refresh()">
										<span class="fa fa-close"></span>Cerrar
									</button>
								</td>
							</tr>
						</table>	
						
						
						</form>					
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
		<!-- /.modal -->
	
		<!-- Modal Ver Solicitud Interna -->
		<div class="modal fade" id="myModalVerHistorial" tabindex="-1"
			role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"
							aria-hidden="true" onclick="refresh()">&times;</button>
						<h4 class="modal-title">
							<label id="lblTitulo">Historial Valor Cuota</label>
						</h4>
					</div>
					<div class="modal-body" style="padding-bottom: 0px !important;">
						<div id="idMensajeC"></div>
						<!-- FORM -->
						<form class="bs-example form-horizontal u-action-error">
							<div class="form-group">
								
								<label for="inputEmail1" class="col-lg-2 control-label">Monto :</label>
								<div class="col-lg-4">
									<input type="text" id="txtNuevoMonto" class="form-control">
								</div>
							</div>
							<div class="form-group">
								
								<label for="inputEmail1" class="col-lg-2 control-label">Fecha :</label>
								<div class="col-lg-4">
									<input type="date" id="txtFechaValorCuota" value="<?php echo date('Y-m-d'); ?>" class="form-control">
								</div>
								<button class="btn btn-primary" type="button"
										onclick="AgregarValorCuota()">
										 Agregar
									</button>
							</div>
							<div class="form-group">

								<div class="col-lg-4">
									<input type="text" id="txtIdFondo" class="form-control" style="display:none" >
								</div>	

							</div>	
							<div class="table-responsive u-table-search">
								<!-- GRID -->
								<table id="idHistorialGrid"
									class="table table-bordered table-striped table-hover table-responsive ">
									<thead>
										<tr>
											<th>Fecha</th>
											<th>Valor Cuota</th>
											<th>Eliminar</th>
										</tr>
									</thead>
									<tbody id="bodyHistorialGrid">
									
									</tbody>
								</table>
								<!-- /GRID -->
							</div>
							<!-- /FORM -->
					
					</div>
					<div class="modal-footer">
						</form>					
					</div>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
		</div>
		<!-- /.modal -->
		
		<!-- SOLICITUDES EXTENAS -->

		<div class="modal fade" id="myModalVerExterna" tabindex="-1"
			role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog2">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"
							aria-hidden="true" onclick="refresh()">&times;</button>
						<h4 class="modal-title">
							<span class="fa fa-user-plus"></span>Solicitud Externa
						</h4>
					</div>
					<div class="modal-body" style="padding-bottom: 0px !important;">
						<div id="idMensaje"></div>
						<!-- FORM -->
						<form class="bs-example form-horizontal u-action-error">
							<div id="tabs_container">
								<ul id="tabs">
									<li id='litab1E' class="active">
										<a class="nadaborde" href="#" onclick="activar('tab1E')">General</a>
									</li>
									<li id='litab2E'>
										<a class="nadaborde" href="#" onclick="activar('tab2E')">Equipos</a>
									</li>
								</ul>
							</div>
							<div id="tab1E" class="tab_content" style="display: block;">
								<div class="borderTab">
									<br>
										<div class="form-group">
										<label for="inputEmail1" class="col-lg-2 control-label"> Tipo
											Solicitud:</label>
										<div class="col-lg-4">
											<select id="cboTipoSolicitudVE" class="form-control" disabled="disabled">
											
										</select>
										</div>
									</div>
							<hr>
							<div class="form-group">
								<label for="inputEmail1" class="col-lg-2 control-label">Empresa:</label>
								<div class="col-lg-4">
									<input type="text" id="txtEmpresaVE" class="form-control"disabled="disabled">
								</div>
								<label for="inputEmail1" class="col-lg-2 control-label">Nombre:</label>
								<div class="col-lg-4">
									<input type="text" id="txtNombreVE" class="form-control"disabled="disabled">
								</div>
							</div>	
							<div class="form-group">
								<label for="inputEmail1" class="col-lg-2 control-label">Cargo:</label>
								<div class="col-lg-4">
									<input type="text" id="txtCargoVE" class="form-control"disabled="disabled">
								</div>
								<label for="inputEmail1" class="col-lg-2 control-label">Ã�rea:</label>
								<div class="col-lg-4">
									<input type="text" id="txtAreaVE" class="form-control"disabled="disabled">
								</div>
							</div>	
							<div class="form-group">
								<label for="inputEmail1" class="col-lg-2 control-label">Gerencia:</label>
								<div class="col-lg-4">
									<input type="text" id="txtGerenciaVE" class="form-control"disabled="disabled">
								</div>
								<label for="inputEmail1" class="col-lg-2 control-label">Correo:</label>
								<div class="col-lg-4">
									<input type="email" id="txtCorreoVE" class="form-control"disabled="disabled">
								</div>
							</div>	
							<div class="form-group">
								<label for="inputEmail1" class="col-lg-2 control-label">Celular:</label>
								<div class="col-lg-4">
									<input type="text" id="txtCelularVE" class="form-control" disabled="disabled">
								</div>							
							</div>	
							<hr>
							<div class="form-group">
								<label for="inputEmail1" class="col-lg-2 control-label">
									TecnologÃ­a:</label>
								<div class="col-lg-4">
									<select id="cboTecnologiaVE" class="form-control" disabled="disabled">
											
									</select>
								</div>							
										<label for="inputEmail1" class="col-lg-2 control-label">
											Privilegio :</label>
										<div class="col-lg-4">
											<select id="cboPrivilegioVE" class="form-control" disabled="disabled">
											
										</select>
										</div>
									</div>		
									<div class="form-group">
										<label for="inputEmail1" class="col-lg-2 control-label">
											JustificaciÃ³n :</label>
										<div class="col-lg-4">
											<!--<input type="text" id="txtJustificacionE" class="form-control" required autofocus style="width: 150%; height: 60px;">-->
											<textarea id="txtJustificacionVE" class="form-control" rows=""
												cols="" disabled="disabled"></textarea>
										</div>
										<label for="inputEmail1" class="col-lg-2 control-label">
											Comentario :</label>
										<div class="col-lg-4">
											<!--<input type="text" id="txtComentario" class="form-control"	required autofocus>-->
											<textarea id="txtComentarioVE" class="form-control" rows=""
												cols="" disabled="disabled"></textarea>
										</div>
									</div>									
									<div id="divRechazoE"  class="form-group" style="display:none">
										<label for="inputEmail1" class="col-lg-2 control-label">
											JustficaciÃ³n Rechazo :</label>
										<div class="col-lg-4">
											<!--<input type="text" id="txtComentario" class="form-control"	required autofocus>-->
											<textarea id="txtJustificacionRechazoEditarE" class="form-control" rows=""
												cols="" disabled="disabled"></textarea>
										</div>
									</div>								
									<div id="divCondicionesE" class="form-group">
										<label for="inputEmail1" class="col-lg-2 control-label">
											Condiciones :</label>
										<div class="col-lg-4">
											<textarea id="txtCondicionesE" class="form-control" rows=""
												cols="" readonly>He leido las condiciones de privacidad, He leido las condiciones de privacidad, sdsadsa</textarea>
										</div>
									</div>
									<!-- /FORM -->
	
								</div>
	
							</div>
							<div id="tab2E" class="tab_content" style="display: none;">
								<div class="borderTab" style="padding: 10px">
									<table id="tblEquipos"
									class="table table-bordered table-striped table-hover table-responsive ">
										<thead>
											<tr>
												<td>Item</td>
												<td>Equipo</td>
												<td>IP</td>
											</tr>
										</thead>
										<tbody>										
										</tbody>
									</table>
								</div>
							</div>
					
					</div>
					<div class="modal-footer">
						<button class="btn btn-primary" id='btnRechazar3'type="button" onclick="rechazar('VE')">
							<span class="fa fa-warning"></span> Rechazar
						</button>
						<input type="hidden" id="txtAccion" value="Registro" />
						<input type="hidden" id="txtEstadoE" value="3" /> 
						<input type="hidden" id="txtIdentSolicitudVE" /> 
						<input type="hidden" id="hdnEquipo" />
						<button class="btn btn-primary .rechazado" id="btnGuardarVE" type="button"
							onclick="guardarInterna()">
							<span class="fa fa-save"></span> Guardar
						</button>
					</form>
					<button data-dismiss="modal" class="btn btn-default" type="button"
						onclick="refresh()">
						<span class="fa fa-close"></span>Cerrar
					</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
		</div>
		<!-- Modal Rechazo -->
		<div class="modal fade" id="myModalRechazo" tabindex="-1"
			role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
			<div class="modal-dialog2">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"
							aria-hidden="true" onclick="refresh()">&times;</button>
						<h4 class="modal-title">
							<span class="fa fa-user-plus"></span><label id="lblTituloE">Rechazar Solicitud</label>
						</h4>
					</div>
					<div class="modal-body" style="padding-bottom: 0px !important;">
						<!-- FORM -->
						<form class="bs-example form-horizontal u-action-error">
							<div class="form-group">
								<label for="inputEmail1" class="col-lg-2 control-label">
									JustificaciÃ³n :</label>
								<div class="col-lg-10">
									<!--<input type="text" id="txtJustificacion" class="form-control" required autofocus style="width: 150%; height: 60px;">-->
									<textarea id="txtJustificacionRechazo" class="form-control" rows=""
										cols="" required="required"></textarea>
								</div>
							</div>
							<!-- /FORM -->
					
					</div>
					<div class="modal-footer">
						
						<button class="btn btn-primary" type="button"
							onclick="guardarRechazo()">
							<span class="fa fa-save"></span> Guardar
						</button>
						</form>
						<button data-dismiss="modal" class="btn btn-default" type="button"
							onclick="cerrarRechazo()">
							<span class="fa fa-close"></span>Cerrar
						</button>
						<input type="hidden" id="txtIdentSolicitudRechazo" value="">
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
		<!-- /.modal -->
		<!-- /.modal -->
	</body>
	</html>
	<script src="static/scripts/jquery.doubletap.js"></script>
	<script src="static/scripts/bootstrap.js"></script>
	<script src="static/scripts/main.js"></script>
	<script>
	$().ready(function () {
		
	});

		
	function AbrirPopupCrearCustodio()
	{
		$('#myModalAddFondo').modal('show');  myModalVerHistorial
	}

	function Ejecutarreporte()
	{
		var Ejecutivo = $('#txtEjecutivo1R').val();
		var FechaInicio= $('#txtFechaInicio').val();
		var FechaFin = $('#txtFechaFin').val();
		var accion = "ListarReporteEjecutivo";
		debugger;
		if(Ejecutivo!="" && FechaInicio !=""&& FechaFin !=""  )
		{
			var parametros = {"accion":accion,"Ejecutivo":Ejecutivo,"FechaInicio":FechaInicio,"FechaFin":FechaFin};
			$.ajax({
			        data:  parametros,
			        url:   'Controlador/ReporteController.php',
			        type:  'post',
			        success:  function(response){
			        	//mensajeDiv('idMensajeU', 1, "Se guardo exitosamente");
			        	$("#BandejaUsuarios").html(response);
			        },
			        error: function(data, errorThrown){
			        	mensajeDiv('idMensajeU', 2, "Ocurrio un error.");
			        }
				});
		}
		else
		{
			mensajeDiv('idMensajeU', 2, "Completar todos los campos");
		}
	}
	/*
	function AbrirPopupEliminar(idCustodio)
	{
		var answer = confirm("Esta Seguro que quiere eliminar el Custodio?")
		if (answer){
			var accion = "EliminarCustodio";
		    var parametros = {"accion":accion,"idCustodio":idCustodio};
			$.ajax({
				data:  parametros,
				url:   'Controlador/CustodioController.php',
				type:  'post',
				success:  function(response){
					refresh();
				},
				error: function(data, errorThrown){
				}
			});	
		}
	}



	function AbrirPopupHistorial(idFondos)
	{
		$('#txtIdFondo').val(idFondos);
		ObtenerHistorialFondo(idFondos);
		$('#myModalVerHistorial').modal('show');
	}

	function ObtenerHistorialFondo(idFondos)
	{
		var accion = "ObtenerHistorialFondo";
		var parametros = {"accion":accion,"idFondo":idFondos};
		$.ajax({
			        data:  parametros,
			        url:   'Controlador/FondoController.php',
			        type:  'post',
			        success:  function(response){
			        	$('#bodyHistorialGrid').html(response);
			        },
			        error: function(data, errorThrown){
			        }
		});
	}
	function EliminarHistorialFondo(idFondoHistorial)
	{
		var idFondo = $('#txtIdFondo').val();
		var accion = "EliminarHistorialFondo";
		var parametros = {"accion":accion,"idFondoHistorial":idFondoHistorial};
		$.ajax({
			        data:  parametros,
			        url:   'Controlador/FondoController.php',
			        type:  'post',
			        success:  function(response){
			        	ObtenerHistorialFondo(idFondo);
			        },
			        error: function(data, errorThrown){
			        }
		});	
	}

	function AgregarValorCuota()
	{
		var NuevoMonto = $('#txtNuevoMonto').val();
		var idFondo = $('#txtIdFondo').val();
		var Fecha = $('#txtFechaValorCuota').val();
		var accion = "AgregarValorCuota";
		debugger;
		if(Fecha=="")
		{
			var Fech = new Date();
			Fecha = Fech;
		}
		if(NuevoMonto!="" && idFondo!="" && Fecha!="")
		{
			var parametros = {"accion":accion,"ValorCuota":NuevoMonto,"idFondo":idFondo,"Fecha":Fecha};

			$.ajax({
			        data:  parametros,
			        url:   'Controlador/FondoController.php',
			        type:  'post',
			        success:  function(response){
			        	mensajeDiv('idMensajeC', 1, "Se guardo exitosamente");
			        	ObtenerHistorialFondo(idFondo);
			        },
			        error: function(data, errorThrown){
			        	mensajeDiv('idMensajeC', 2, "Ocurrio un error.");
			        }
				});
		}
		else
		{
			mensajeDiv('idMensajeC', 2, "Completar todos los campos");
		}
	}

	function AbrirPopupEliminar(idFondo)
	{
		var answer = confirm("Esta Seguro que quiere eliminar el Fondo?")
		if (answer){
			var accion = "EliminarFondo";
		    var parametros = {"accion":accion,"idFondo":idFondo};
			$.ajax({
				data:  parametros,
				url:   'Controlador/FondoController.php',
				type:  'post',
				success:  function(response){
					refresh();
				},
				error: function(data, errorThrown){
				}
			});	
		}
	}
*/
	</script>
<?php }else {
    header("Location: index.php");
}
?>