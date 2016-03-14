<?php
session_start ();
if ($_SESSION['usuario']) {
	include 'Modelo/Aportes.class.php';
	include 'Modelo/Rescate.class.php';
	include 'Modelo/Fondo.class.php';
	include 'Modelo/Usuario.class.php';

	$Aporte = new Aportes();
	$Fondo = new Fondo();
	$Usuario = new usuario();
	$Rescate = new Rescates();

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
	<title>New Capital - Rescate</title>
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
								Rescates</strong> <span class="pull-right"><span
								id="oprincipal" class="fa fa-chevron-circle-up"></span>						
						</div>
						<div class="panel-body">
							<div class="nav">
								<nav id="bprincipal" class="navbar navbar-default navbar-inverse"
									role="navigation">
									<div class="navbar-collapse  navbar-filter">
										<label for="inputEmail1" style="margin-right:20px; margin-left:20px;">Fecha Inicial :</label>
										<input type="date" style="height:23px; width:150px" value="" id="txtFechaInicio" name="txtFechaInicio">
										<label for="inputEmail1" style="margin-right:20px; margin-left:20px;">Fecha Final :</label>
										<input type="date" style="height:23px; width:150px" value="" id="txtFechaFin" name="txtFechaFin" >
										&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; 	
										<a class="btn btn-default" data-toggle="modal"
											href="#" onclick="FiltrarAportes();"> <span class="fa fa-search fa-2"></span>
											Buscar
										</a> &nbsp;&nbsp; 
									</div>
									<div class="navbar-collapse  navbar-filter">
										<label for="inputEmail1" style="margin-right:20px; margin-left:57px;">Fondo :</label>
										<input type="text" value="" id="txtFondo" name="txtFondo"
										placeholder="Filtrar Fondo"> 
										<label for="inputEmail1" style="margin-right:20px; margin-left:40px;">Usuario :</label>
										<input type="text" value="" id="txtUsuario" name="txtUsuario"
										placeholder="Filtrar Usuario">
										&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
										<a class="btn btn-default"
											data-toggle="modal" href="#" onclick="AbrirPopupAgregarAporte()"> <span
											class="fa fa-user-plus"></span> Agregar Rescate
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
											<th></th>
											<th>Fecha</th>
											<th>Usuario</th>
											<th>Fondo</th>
											<th>Rescate</th>
											<th>Castigo</th>
											<th>Saldo</th>
											<th>Rescate Cuotas</th>
											<th>NCuotas Anterior</th>
											<th>NCuotas Actual</th>
											<th>Eliminar</th>
										</tr>
									</thead>
									<tbody id="BandejaAportes">
									<?php
									$query = $Rescate->ObtenerRescates('','','','');
									//echo $query;
									while ( $var = mysql_fetch_array ( $query ) ) {
										$i ++;
									?>	
										<tr>
											<td width="28px"></td>
											<td><?php echo$var['fecha']; ?></td>
											<td><?php echo$var['usuario']; ?></td>
											<td><?php echo$var['nombre']; ?></td>
											<td><?php echo$var['cantidad']; ?></td>
											<td><?php echo$var['castigo']; ?></td>
											<td><?php echo$var['saldoactual']; ?></td>
											<td><?php echo$var['NcuotasAgregado']; ?></td>
											<td><?php echo$var['NcuotasAnterior']; ?></td>
											<td><?php echo$var['NcuotasActual']; ?></td>
											<td>
												<a href=# onclick="AbrirPopupEliminar(<?php echo$var['idoperaciones']; ?>)">
													<i class="fa fa-trash"> </i>
												</a>
											</td>
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
		<div class="modal fade" id="myModalAgregarAporte" tabindex="-1"
			role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"
							aria-hidden="true" onclick="refresh()">&times;</button>
						<h4 class="modal-title">
							<span class="fa fa -"></span><label id="lblTituloE">Agregar Rescate</label>
						</h4>
					</div>
					<div class="modal-body" style="padding-bottom: 0px !important;">
						<div id="idMensajeAF"></div>
						<!-- FORM -->
						<form class="bs-example form-horizontal u-action-error">
							<div class="form-group">
								<label for="inputEmail1" class="col-lg-2 control-label"> Usuario:</label>
								<div class="col-lg-4">
									<select id="cboUsuarios" class="form-control" onchange="ObtenerFondos();">
										<?php									
										$queryFon = $Usuario->ObtenerBandejaUsuarios('','','');
										while ( $var = mysql_fetch_array ( $queryFon ) ) {
											$i ++;
											?>		
								           	<option value="<?php echo$var['idUsuarios'];?>"><?php echo$var['usuario'];?></option>
										<?php }?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail1" class="col-lg-2 control-label"> Fondo:</label>
								<div class="col-lg-4">
									<select id="cboFondos" class="form-control" onchange="ObtenerRescatable();">
										
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail1" class="col-lg-2 control-label">Monto Rescatable:</label>
								<div class="col-lg-4">
									<input type="text" id="txtRescatable" class="form-control" disabled>
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail1" class="col-lg-2 control-label">Monto Rescate:</label>
								<div class="col-lg-4">
									<input type="text" id="txtRescate" class="form-control" >
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail1" class="col-lg-2 control-label">Monto Castigo:</label>
								<div class="col-lg-4">
									<input type="text" id="txtCastigo" class="form-control" >
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail1" class="col-lg-2 control-label">NCuotas:</label>
								<div class="col-lg-4">
									<input type="text" id="txtNcuotas" class="form-control" >
								</div>
								<button class="btn btn-primary .estado" type="button"
										onclick="AgregarRescate()" >
										<span class="fa fa-save"></span> Agregar
								</button>	
							</div>
							<!-- /FORM -->
					
					</div>
					<div class="modal-footer" >
						
						</form>					
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
		<!-- /.modal -->
	
	</body>
	</html>
	<script src="static/scripts/jquery.doubletap.js"></script>
	<script src="static/scripts/bootstrap.js"></script>
	<script src="static/scripts/main.js"></script>
	<script>
	$().ready(function () {

	});

	function AbrirPopupAgregarAporte()
	{
		$('#myModalAgregarAporte').modal('show'); 
		ObtenerFondos();
		//ObtenerRescatable();
	}

	function FiltrarAportes()
	{
		var FechaIni = $('#txtFechaInicio').val();
		var FechaFin = $('#txtFechaFin').val();
		var Fondo = $('#txtFondo').val();
		var Usuario = $('#txtUsuario').val(); 
		var accion = "ObtenerRescates";
		var parametros = {"accion":accion,"FechaIni":FechaIni, 
						  "FechaFin":FechaFin,"Fondo":Fondo,"Usuario":Usuario};
		$.ajax({
			        data:  parametros,
			        url:   'Controlador/RescateController.php',
			        type:  'post',
			        success:  function(response){
			        	$('#BandejaAportes').html(response);
			        },
			        error: function(data, errorThrown){
			        }
		});
	}

	function AgregarRescate()
	{
		debugger;
		var idFondo = $('#cboFondos').val();
		var idUsuario = $('#cboUsuarios').val();
		var Rescate = $('#txtRescate').val();
		var Castigo = $('#txtCastigo').val();
		var Rescatable = $('#txtRescatable').val();
		var Ncuotas = $('#txtNcuotas').val();
		var accion = "AgregarRescate";
		if(idFondo!="" && idUsuario!="" && Rescate!=""
			&& Castigo!="" && Rescatable!="" && Ncuotas!="")
		{
			var NuevoSaldo = parseFloat(Rescatable) - (parseFloat(Rescate) + parseFloat(Castigo));
			alert(NuevoSaldo);
			if(NuevoSaldo >= 0)
			{
				var parametros = {"accion":accion,"idFondo":idFondo,"idUsuario":idUsuario,
								"Rescate":Rescate,"Castigo":Castigo,"SaldoActual":NuevoSaldo,"NCuotaAdd":Ncuotas};
				$.ajax({
				        data:  parametros,
				        url:   'Controlador/RescateController.php',
				        type:  'post',
				        success:  function(response){
				        	//alert(response);
				        	mensajeDiv('idMensajeAF', 1, "Se guardo exitosamente");
				        },
				        error: function(data, errorThrown){
				        	alert(errorThrown);
				        	mensajeDiv('idMensajeAF', 2, "Ocurrio un error.");
				        }
					});
			}
			else
			{
				mensajeDiv('idMensajeU', 2, "El total no tiene que exceder el monto rescatable");
			}
		}
		else
		{
			mensajeDiv('idMensajeU', 2, "Completar todos los campos");
		}
	}

	function AbrirPopupEliminar(idAporte)
	{
		var answer = confirm("Esta Seguro que quiere eliminar el Rescate?")
		if (answer){
			var accion = "EliminarRescate";
		    var parametros = {"accion":accion,"idAporte":idAporte};
			$.ajax({
				data:  parametros,
				url:   'Controlador/RescateController.php',
				type:  'post',
				success:  function(response){
					refresh();
				},
				error: function(data, errorThrown){
				}
			});	
		}
	}

	function ObtenerFondos()
	{
		debugger;
		var idUsuario = $('#cboUsuarios').val();
		var accion = "ObtenerFondos";
		var parametros = {"accion":accion,"idUsuario":idUsuario};
		$.ajax({
			        data:  parametros,
			        url:   'Controlador/AportesController.php',
			        type:  'post',
			        success:  function(response){
			        	$('#cboFondos').html(response);
			        	ObtenerRescatable();
			        },
			        error: function(data, errorThrown){
			        }
		});
	}

	function ObtenerRescatable()
	{
		debugger;
		var idFondo = $('#cboFondos').val();
		var idUsuario = $('#cboUsuarios').val();
		var accion = "ObtenerRescatable";
		if((idFondo!="" || idFondo != null) && (idUsuario!="" || idUsuario != null))
		{
			var parametros = {"accion":accion,"idFondo":idFondo,"idUsuario":idUsuario};

			$.ajax({
			        data:  parametros,
			        url:   'Controlador/RescateController.php',
			        type:  'post',
			        success:  function(response){
			        	$('#txtRescatable').val(response);
			        },
			        error: function(data, errorThrown){
			        	alert(errorThrown);
			        }
				});
		}
	}

	</script>
<?php }else {
    header("Location: index.php");
}
?>