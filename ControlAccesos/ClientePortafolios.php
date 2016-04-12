<?php
session_start ();
if ($_SESSION['usuario']) {
	include 'Modelo/Operaciones.class.php';
	include 'Modelo/Clientes.class.php' ;
	include 'Modelo/Usuario.class.php' ;
	include 'Modelo/Portafolio.class.php' ;
	$Operaciones = new Operaciones();
	$Clientes = new Clientes();
	$portafolio =  new Portafolio();
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
	<title>New Capital - Fondos</title>
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
								Portafolio</strong> <span class="pull-right"><span id="oprincipal" class="fa fa-chevron-circle-up"></span>						
						</div>
						<div class="panel-body">
							<div class="nav">
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
											<th>Codigo</th>
											<th>Descripcion</th>
											<th>Cantidad</th>

										</tr>
									</thead>
									<tbody id="BandejaOperaciones">
										<?php
										$ct=0;
										$query = $portafolio->ObtenerPortafolio($_SESSION['idUsuario']);
										while ( $var = mysql_fetch_array ( $query ) ) {
											$i ++;
										?>
										<tr>
											<td width="28px"></td>
											<td><?php echo$var['codigo']; ?></td>
											<td><?php echo$var['descripcion']; ?></td>
											<td><?php echo$var['cantidad']; ?></td>
										</tr>
										<?php }?>
									</tbody>
								</table>
								<!-- /GRID -->
							</div>
							<div>
										
							</div>
						</div>
					<div class="panel-heading">
							<strong><span id="omenu" class="fa fa-chevron-circle-left"></span>
								Cash: </strong> <?php 
								$query = $portafolio->obtenerCash($_SESSION['idUsuario']);
								$var1 = mysql_fetch_array ( $query );
								echo number_format($var1['saldoActual'],2,'.',',');
								?><span class="pull-right"><span id="oprincipal" class="fa fa-chevron-circle-up"></span>
													
						</div>
					
					<div class="panel-heading">
							<strong><span id="omenu" class="fa fa-chevron-circle-left"></span>
								Movimientos</strong> <span class="pull-right"><span id="oprincipal" class="fa fa-chevron-circle-up"></span>						
						</div>
						
						<div class="panel-body">
							<div class="nav">
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
											<th>Fecha y Hora</th>
											<th>Activo</th>
											<th>Tipo</th>
											<th>Cantidad</th>
											<th>Precio</th>
											<th>Comision</th>
											<th>Total</th>
											<th>SaldoFinal</th>
										</tr>
									</thead>
									<tbody id="BandejaOperaciones">
										<?php
										$ct=0;
										$query = $Operaciones->ObtenerOperacionesActuales('','','',$_SESSION['idUsuario'],'');
										while ( $var = mysql_fetch_array ( $query ) ) {
											$i ++;
										?>
										<tr>
											<td width="28px"></td>
											<td><?php echo$var['fechaHora']; ?></td>
											<td><?php echo $var['descripcion']; ?></td>
											<td><?php 
											if($var['TipoOperacion']== "D")
												echo "Deposito";
											if($var['TipoOperacion']== "R")
												echo "Retiro";
											if($var['TipoOperacion']== "B")
												echo "Buy";
											if($var['TipoOperacion']== "S")
													echo "Sell";
											 ?></td>
											
											<td><?php echo number_format($var['cantidad'],2,'.',','); ?></td>
											<td><?php echo number_format($var['preciou'],2,'.',','); ?></td>
											<td><?php echo number_format($var['comision'],2,'.',','); ?></td>
											<td><?php echo number_format($var['precio'],2,'.',','); ?></td>
											
											<td><?php echo number_format($var['saldoFinal'],2,'.',','); ?></td>
											<?php 
											if($var['tipo'] == "APORTE")
											{	
											$ct = $ct+ $var['NcuotasAgregado'];
											}
else{$ct = $ct- $var['NcuotasAgregado'];}
 ?>
											<?php
											if($var['tipo'] == "APORTE")
											{
												$queryVA = $Clientes->ObtenerValorCuotaActual($var['idFondos']);
												$ValorCuotaActual = 0;
												$ValorCuotaFecha = 0;
												while( $varVA = mysql_fetch_array($queryVA))
												{
													$ValorCuotaActual = $varVA['valorcuota'];
												}
												$queryVF = $Clientes->ObtenerValorFechaAporte($var['idFondos'],$var['fecha']);
												while( $varVF = mysql_fetch_array($queryVF))
												{
													$ValorCuotaFecha = $varVF['valorcuota'];
												}
												$ValorFinal = ($ValorCuotaActual - $ValorCuotaFecha) * $var['NcuotasAgregado'];
												$valorprueba = $ValorCuotaActual." - ".$ValorCuotaFecha;
											?>
												<td><?php echo$ValorFinal; ?>%</td>
											<?php 
											}else{?>
											<?php }?>
										</tr>
										<?php }?>
									</tbody>
								</table>
								<!-- /GRID -->
							</div>
							<div>
								<?php
										$queryOA = $Clientes->ObtenerOperacioneAporte($_SESSION['idUsuario']);
										while ( $varOA = mysql_fetch_array ( $queryOA ) ) {
										?>
											<?php // echo$varOA['nombre']; ?>
											<?php 
												$TotalRentabilidad = 0;
												$pruebax = "";
												
												$queryPrinc = $Clientes->ObtenerOperacioneAporteFondo($varOA['idFondos']);
												$Dividir = 0;
												while ( $varPrinc = mysql_fetch_array ( $queryPrinc ) ) {
													$queryVA = $Clientes->ObtenerValorCuotaActual($varPrinc['idFondos']);
													$ValorCuotaActual = 0;
													$ValorCuotaFecha = 0;
													while( $varVA2 = mysql_fetch_array($queryVA))
													{
														$ValorCuotaActual = $varVA2['valorcuota'];
													}
													$queryVF = $Clientes->ObtenerValorFechaAporte($varPrinc['idFondos'],$varPrinc['fecha']);
													while( $varVF2 = mysql_fetch_array($queryVF))
													{
														$ValorCuotaFecha = $varVF2['valorcuota'];
													}
													//$ValorFinal2 = ($ValorCuotaActual - $ValorCuotaFecha) * $varOA['NcuotasAgregado'];
													//$ValorFinal2 = ($ValorCuotaActual - $ValorCuotaFecha) * $varOA['NcuotasActual'];
													$TotalRentabilidad = $TotalRentabilidad + $ValorFinal2;
													$pruxd = $ValorCuotaActual." - ".$ValorCuotaFecha;
													$Dividir++;
										
													$Resultado = $ValorCuotaActual * $varOA['NcuotasActual'];
													$Resultado1 = $ValorCuotaActual*$ct;
													
												}
												$TotalRentabilidad = $TotalRentabilidad / $Dividir;
											?>
											 <?php //echo $ct ?>	
											<?php //echo$Resultado1; ?>
										<?php }?>
										
										<?PHP 
										$objeto = new Usuario();
										$result = $objeto->ObtenerFondosAsignados($_SESSION['idUsuario']);
										while ( $var = mysql_fetch_array($result)) {
											?>
											<h3><?PHP echo $var['nombre']; ?></h3>
											<h4><?PHP echo "Cuotas Total: ".number_format($var['ncuotas'],7,'.',','); ?></h4>
											<h4><?PHP echo "Saldo Total: ".number_format($var['saldoactual'],7,'.',','); ?></h4>
											
											<?PHP
										}
										?>
										
							</div>
						</div>
					
					
							
					
					</div>
				</div>
			</div>
		</div>
		<!-- SOLICITUDES INTENAS -->
		<!-- Modal Agregar Solicitud Interna -->
		<div class="modal fade" id="myModalAddFichero" tabindex="-1"
			role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"
							aria-hidden="true" onclick="refresh()">&times;</button>
						<h4 class="modal-title">
							<span class="fa fa-user-plus"></span><label id="lblTitulo">Agregar
								Fichero</label>
						</h4>
					</div>
					<div class="modal-body" style="padding-bottom: 0px !important;">
						<div id="idMensajeU"></div>
						<!-- FORM -->
						<form class="bs-example form-horizontal u-action-error">
							<div class="form-group">
								<label for="inputEmail1" class="col-lg-2 control-label">Nombre:</label>
								<div class="col-lg-4">
									<input type="text" id="txtNombre" class="form-control">
								</div>
								<label for="inputEmail1" class="col-lg-2 control-label">Descripcion:</label>
								<div class="col-lg-4">
									<input type="text" id="txtDescripcion" class="form-control">
								</div>
							</div>	
							<div class="form-group">
								<label for="inputEmail1" class="col-lg-2 control-label">Archivo:</label>
								<div class="col-lg-4">
									<input type="file" id="txtFile" class="form-control" style="width:460px">
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
										onclick="AgregarFichero()">
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
	
	</body>
	</html>
	<script src="static/scripts/jquery.doubletap.js"></script>
	<script src="static/scripts/bootstrap.js"></script>
	<script src="static/scripts/main.js"></script>
	<script>
	$().ready(function () {

	});

	function AbrirPopupCrearFichero()
	{
		$('#myModalAddFichero').modal('show');
	}

	function AgregarFichero()
	{
		debugger;
		var nombre = $('#txtNombre').val();
		var descripcion = $('#txtDescripcion').val();
		var file_data = $('#txtFile').prop('files')[0];
		//var file_data = document.getElementById('txtFile').files[0].getAsBinary();
		
		var accion = "AgregarFichero";
		var parametros = {"accion":accion,"file_data":file_data};
		$.ajax({
			        data:  parametros,
			        url:   'Controlador/FicheroController.php',
			        type:  'post',
			        success:  function(response){
			        	debugger;
			        	//alert(response);
			        },
			        error: function(data, errorThrown){
			        	debugger;
			        	alert(errorThrown);
			        }
		});
	}

	function AbrirPopupEliminar(idFichero)
	{
		var answer = confirm("Esta Seguro que quiere eliminar el Fichero?")
		if (answer){
			var accion = "EliminarFichero";
		    var parametros = {"accion":accion,"idFichero":idFichero};
			$.ajax({
				data:  parametros,
				url:   'Controlador/FicheroController.php',
				type:  'post',
				success:  function(response){
					refresh();
				},
				error: function(data, errorThrown){
				}
			});	
		}
	}

	function ObtenerFicheros()
	{
		var FechaIni = $('#txtFechaInicio').val();
		var FechaFin = $('#txtFechaFin').val();
		var accion = "ObtenerFicheros";
		var parametros = {"accion":accion,"FechaIni":FechaIni,"FechaFin":FechaFin};
		$.ajax({
			        data:  parametros,
			        url:   'Controlador/FicheroController.php',
			        type:  'post',
			        success:  function(response){
			        	$('#BandejaFichero').html(response);
			        },
			        error: function(data, errorThrown){
			        }
		});
	}

	</script>
<?php }else {
    header("Location: index.php");
}
?>