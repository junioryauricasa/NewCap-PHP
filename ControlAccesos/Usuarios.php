<?php
session_start ();
if ($_SESSION['usuario']) {
	include 'Modelo/Usuario.class.php';
	include 'Modelo/Custodio.class.php';
	include 'Modelo/Fondo.class.php';
	include 'Modelo/Ejecutivo.class.php';

	$usuario = new Usuario();
	$Fondo = new Fondo();
	$Custodio = new Custodio();
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
	<title>New Capital - Usuarios</title>
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
								Usuarios</strong> <span class="pull-right"><span
								id="oprincipal" class="fa fa-chevron-circle-up"></span>						
						</div>
						<div class="panel-body">
							<div class="nav">
								<nav id="bprincipal" class="navbar navbar-default navbar-inverse"
									role="navigation">
									<div class="navbar-collapse  navbar-filter">
										<input type="text" value="" id="txtUsuario" name="txtUsuario"
										placeholder="Filtrar Usuario" required autofocus> 
										<input type="text" value="" id="txtDNI" name="txtDNI"
										placeholder="Filtrar DNI" required autofocus> 
										<a class="btn btn-default" data-toggle="modal"
											href="#" onclick="FiltrarUsuarios()"> <span class="fa fa-search fa-2"></span>
											Buscar
										</a> &nbsp;&nbsp; <a class="btn btn-default"
											data-toggle="modal" href="#" onclick="AbrirPoupCrearUsuario()"> <span
											class="fa fa-user-plus"></span> Crear Usuario
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
								<div>
									<small>&nbsp;&nbsp;* Para detalle del registro hacer doble Clic.</small>
								</div>
								<table id="principal"
									class="table table-bordered table-striped table-hover table-responsive ">
									<thead>
										<tr>
											<th></th>
											
											<th>Nombre</th>
											<th>Apellido</th>
											<th>Direccion</th>	
											<th>DNI</th>
											<th>Telefono</th>
											<th>Correo</th>
											<th>Usuario</th>
											<th>Password</th>
											<th>Codigo</th>
											<th>Estado Usuario</th>
											<th>Tipo Usuario</th>
											<th>Operaciones</th>
											<th>Asig. Fondo</th>
										</tr>
									</thead>
									<tbody id="BandejaUsuarios">
									<?php
									$query = $usuario->ObtenerBandejaUsuarios('','','');
									//echo $query;
									while ( $var = mysql_fetch_array ( $query ) ) {
										$i ++;
									?>	
										<tr ondblclick="BuscarUsuario(<?php echo$var['idUsuarios']; ?>)">
											<td width="28px"></td>
											
											<td><?php echo$var['nombres']; ?></td>
											<td><?php echo$var['apellidos']; ?></td>
											<td><?php echo$var['direccion']; ?></td>
											<td><?php echo$var['dni']; ?></td>
											<td><?php echo$var['telefono']; ?></td>
											<td><?php echo$var['correo']; ?></td>
											<td><?php echo$var['usuario']; ?></td>
											<td><?php echo$var['password']; ?></td>
											<td><?php 
											if($var['codigo']=="")
												echo "Sin Codigo";
											else
												echo$var['codigo']; 
											
											?></td>
											<td>
												<?php
												if($var['estado']==1){?>
													Activo
												<?php } 
												 else{ ?>	
													Inactivo
												<?php } ?>				
											</td>
											<td>

												<?php
												if($var['TipoUsuario']==1){?>
													Administrador
												<?php } 
												 else{ ?>	
													Cliente
												<?php } ?>				
											</td>
											<td><a href=# onclick="AbrirPopupVerOperaciones(<?php echo$var['idUsuarios']; ?>)">
													<i class="fa fa-search-plus"> </i>
												</a>
												
												<a href=# onclick="AbrirPopupEditar(<?php echo$var['idUsuarios']; ?>)">
													<i class="fa fa-database"> </i>
												</a>
												
											</td>
											<td><a href=# onclick="AbrirPopupAsignarFondos(<?php echo$var['idUsuarios']; ?>)">
													<i class="fa fa-chevron-circle-up"> </i>
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
		<!-- Modal Agregar Usuarios -->
		<div class="modal fade" id="myModalAddUser" tabindex="-1"
			role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"
							aria-hidden="true" onclick="refresh()">&times;</button>
						<h4 class="modal-title">
							<span class="fa fa-user-plus"></span><label id="lblTitulo">Agregar
								Usuario</label>
						</h4>
					</div>
					<div class="modal-body" style="padding-bottom: 0px !important;">
						<div id="idMensajeU"></div>
						<!-- FORM -->
						<form class="bs-example form-horizontal u-action-error">
						
						
							<div class="form-group">
								<label for="inputEmail1" class="col-lg-2 control-label">Nombres:</label>
								<div class="col-lg-4">
									<input type="text" id="txtNombresR" class="form-control">
								</div>
								<label for="inputEmail1" class="col-lg-2 control-label">Apellidos:</label>
								<div class="col-lg-4">
									<input type="text" id="txtApellidosR" class="form-control">
								</div>
							</div>	
							<div class="form-group">
								<label for="inputEmail1" class="col-lg-2 control-label">Direccion:</label>
								<div class="col-lg-4">
									<input type="text" id="txtDireccionR" class="form-control">
								</div>
								<label for="inputEmail1" class="col-lg-2 control-label">DNI:</label>
								<div class="col-lg-4">
									<input type="text" id="txtDNIR" class="form-control">
								</div>
							</div>	
							<div class="form-group">
								<label for="inputEmail1" class="col-lg-2 control-label">Telefono:</label>
								<div class="col-lg-4">
									<input type="text" id="txtTelefonoR" class="form-control">
								</div>
								<label for="inputEmail1" class="col-lg-2 control-label">Correo:</label>
								<div class="col-lg-4">
									<input type="text" id="txtCorreoR" class="form-control">
								</div>
							</div>	
							<div class="form-group">
								<label for="inputEmail1" class="col-lg-2 control-label">Usuario:</label>
								<div class="col-lg-4">
									<input type="text" id="txtUsuarioR" class="form-control">
								</div>
								<label for="inputEmail1" class="col-lg-2 control-label">Password:</label>
								<div class="col-lg-4">
									<input type="text" id="txtPasswordR" class="form-control">
								</div>
							</div>	


							<div class="form-group">
								<label for="inputEmail1" class="col-lg-2 control-label">Accionario:</label>
								<div class="col-lg-4">
									<input type="checkbox" id="txtAccionR" value="1" onchange="ValoresAcciones()">
									<input type="hidden" id="txtEstadoAccionR" value="0" >
								</div>
							</div>	
							<!-- Capa a ocultar  -->
							<div id='capaoculta' style='display:none;'>
							
							<div class="form-group">
								<label for="inputEmail1" class="col-lg-2 control-label">Custodio:</label>
								<div class="col-lg-4">
									<select id="txtCustodioR" class="form-control">
									<option value="0"  selected>Seleccionar</option>
									<?php
									$query = $Custodio->ObtenerCustodios();
									//echo $query;
									while ( $var = mysql_fetch_array ( $query ) ) {
										$i ++;
									?>	
										<option value="<?php echo$var['idCustodios']; ?>"><?php echo$var['nombre']; ?></option>
									<?php }?>
									</select>
								</div>			
								<label for="inputEmail1" class="col-lg-2 control-label">Codigo:</label>
								<div class="col-lg-4">
									<input type="text" id="txtCodigoR" class="form-control" >
								</div>
							</div>	
							<div class="form-group">
								<label for="inputEmail1" class="col-lg-2 control-label">Ejecutivo1:</label>
								<div class="col-lg-4">
									<select id="txtEjecutivo1R" class="form-control" >
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
								</div>
								<label for="inputEmail1" class="col-lg-2 control-label">Comision</label>
								<div class="col-lg-4">
									<input type="text" id="txtEjecutivo1RSaldo" class="form-control"  value="0" style="width:70px">
								</div>
								
								
							</div>	
							<div class="form-group">
								<label for="inputEmail1" class="col-lg-2 control-label">Ejecutivo2:</label>
								<div class="col-lg-4">
									<select id="txtEjecutivo2R" class="form-control">
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
								</div>
									<label for="inputEmail1" class="col-lg-2 control-label">Comision</label>
									<div class="col-lg-4">
									<input type="text" id="txtEjecutivo2RSaldo" class="form-control"  value="0" style="width:70px">
									</div>
							</div>	
							<div class="form-group">
								<label for="inputEmail1" class="col-lg-2 control-label">Ejecutivo3:</label>
								<div class="col-lg-4">
									<select id="txtEjecutivo3R" class="form-control">
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
								</div>
								<label for="inputEmail1" class="col-lg-2 control-label">Comision</label>
									<div class="col-lg-4">
									<input type="text" id="txtEjecutivo3RSaldo" class="form-control"  value="0" style="width:70px">
								</div>
							</div>	
							<div class="form-group">
								<label for="inputEmail1" class="col-lg-2 control-label">NC:</label>
								<div class="col-lg-4">
									<input type="text" id="txtNcR" class="form-control"  value="0" onchange="CalcularTotal()">
								</div>
								<label for="inputEmail1" class="col-lg-2 control-label">Clearing:</label>
								<div class="col-lg-4">
									<input type="text" id="txtClearingR" class="form-control"  value="0"  onchange="CalcularTotal()">
								</div>		
							</div>	
							<div class="form-group">
								<label for="inputEmail1" class="col-lg-2 control-label">Total:</label>
								<div class="col-lg-4">
									<input type="text" id="txtTotalR" class="form-control"  value="0" readonly>
								</div>				
								<label for="inputEmail1" class="col-lg-2 control-label">Minimo:</label>
								<div class="col-lg-4">
									<input type="text" id="txtMinimoR" class="form-control" value="0">
								</div>			
							</div>	

							</div>
							<!--

							-->
							<!-- Fin de capa a ocultar -->

							
							<!-- /FORM -->
					
					</div>
					<div class="modal-footer">
						<input type="hidden" id="txtAccion" value="Registro"> <input
							type="hidden" id="txtIdentSolicitud" /> <input type="hidden"
							id="hdnEquipo">
							
						<table align="right">
							<tr>
								<td>&nbsp;&nbsp;</td>
								<td>
									<button class="btn btn-primary" type="button"
										onclick="CrearUsuario()">
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
	
		<!-- Modal Ver Editar Usuarios -->
		<div class="modal fade" id="myModalVerUser" tabindex="-1"
			role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"
							aria-hidden="true" onclick="refresh()">&times;</button>
						<h4 class="modal-title">
							<span class="fa fa-user-plus"></span><label id="lblTitulo">Editar Valores de usuario</label>
						</h4>
					</div>
					<div class="modal-body" style="padding-bottom: 0px !important;">
						<div id="idMensajeU"></div>
						<!-- FORM -->
						<form class="bs-example form-horizontal u-action-error">

							<!-- Capa a ocultar  -->
							
							
							<div class="form-group">
								<label for="inputEmail1" class="col-lg-2 control-label">Custodio:</label>
								<div class="col-lg-4">
									<select id="txtCustodioR" class="form-control">
									<option value="0"  selected>Seleccionar</option>
									<?php
									$query = $Custodio->ObtenerCustodios();
									//echo $query;
									while ( $var = mysql_fetch_array ( $query ) ) {
										$i ++;
									?>	
										<option value="<?php echo$var['idCustodios']; ?>"><?php echo$var['nombre']; ?></option>
									<?php }?>
									</select>
								</div>			
								<label for="inputEmail1" class="col-lg-2 control-label">Codigo:</label>
								<div class="col-lg-4">
									<input type="text" id="txtCodigoR" class="form-control" >
								</div>
							</div>	
							<div class="form-group">
								<label for="inputEmail1" class="col-lg-2 control-label">Ejecutivo1:</label>
								<div class="col-lg-4">
									<select id="txtEjecutivo1R" class="form-control" >
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
								</div>
								<label for="inputEmail1" class="col-lg-2 control-label">Comision</label>
								<div class="col-lg-4">
									<input type="text" id="txtEjecutivo1RSaldo" class="form-control"  value="0" style="width:70px">
								</div>
								
								
							</div>	
							<div class="form-group">
								<label for="inputEmail1" class="col-lg-2 control-label">Ejecutivo2:</label>
								<div class="col-lg-4">
									<select id="txtEjecutivo2R" class="form-control">
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
								</div>
									<label for="inputEmail1" class="col-lg-2 control-label">Comision</label>
									<div class="col-lg-4">
									<input type="text" id="txtEjecutivo2RSaldo" class="form-control"  value="0" style="width:70px">
									</div>
							</div>	
							<div class="form-group">
								<label for="inputEmail1" class="col-lg-2 control-label">Ejecutivo3:</label>
								<div class="col-lg-4">
									<select id="txtEjecutivo3R" class="form-control">
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
								</div>
								<label for="inputEmail1" class="col-lg-2 control-label">Comision</label>
									<div class="col-lg-4">
									<input type="text" id="txtEjecutivo3RSaldo" class="form-control"  value="0" style="width:70px">
								</div>
							</div>	
							<div class="form-group">
								<label for="inputEmail1" class="col-lg-2 control-label">NC:</label>
								<div class="col-lg-4">
									<input type="text" id="txtNcR" class="form-control"  value="0" onchange="CalcularTotal()">
								</div>
								<label for="inputEmail1" class="col-lg-2 control-label">Clearing:</label>
								<div class="col-lg-4">
									<input type="text" id="txtClearingR" class="form-control"  value="0"  onchange="CalcularTotal()">
								</div>		
							</div>	
							<div class="form-group">
								<label for="inputEmail1" class="col-lg-2 control-label">Total:</label>
								<div class="col-lg-4">
									<input type="text" id="txtTotalR" class="form-control"  value="0" readonly>
								</div>				
								<label for="inputEmail1" class="col-lg-2 control-label">Minimo:</label>
								<div class="col-lg-4">
									<input type="text" id="txtMinimoR" class="form-control" value="0">
								</div>			
							</div>	

							
							<!--

							-->
							<!-- Fin de capa a ocultar -->

							
							<!-- /FORM -->
					
					</div>
					<div class="modal-footer">
						<input type="hidden" id="txtAccion" value="Registro"> <input
							type="hidden" id="txtIdentSolicitud" /> <input type="hidden"
							id="hdnEquipo">
							
						<table align="right">
							<tr>
								<td>&nbsp;&nbsp;</td>
								<td>
									<button class="btn btn-primary" type="button"
										onclick="CrearUsuario()">
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
		</div>
		<!-- /.modal -->
		<!-- Modal Asginar Fondos -->
		<div class="modal fade" id="myModalAsigFondo" tabindex="-1"
			role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"
							aria-hidden="true" onclick="refresh()">&times;</button>
						<h4 class="modal-title">
							<span class="fa fa -"></span><label id="lblTituloE">Asignar Fondos</label>
						</h4>
					</div>
					<div class="modal-body" style="padding-bottom: 0px !important;">
						<div id="idMensajeAF"></div>
						<!-- FORM -->
						<form class="bs-example form-horizontal u-action-error">
							<div class="form-group">
								<label for="inputEmail1" class="col-lg-2 control-label"> Fondo:</label>
								<div class="col-lg-4">
									<select id="cboFondos" class="form-control" >
										<?php									
										$queryFon = $Fondo->ObtenerFondos();
										while ( $var = mysql_fetch_array ( $queryFon ) ) {
											$i ++;
											?>		
								           	<option value="<?php echo$var['idFondos'];?>"><?php echo$var['nombre'];?></option>
										<?php }?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail1" class="col-lg-2 control-label">N° Cuotas:</label>
								<div class="col-lg-4">
									<input type="text" id="txtNumeroCuotas" class="form-control" >
								</div>
								<button class="btn btn-primary .estado" type="button"
										onclick="AgregarFondoUsuario()" >
										<span class="fa fa-save"></span> Agregar
								</button>	
							</div>
							<hr>
							<div class="col-lg-4">
									<input type="text" id="txtidUsuarioF" class="form-control" style="display:none" >
							</div>	
							<div class="table-responsive u-table-search">
								<!-- GRID -->
								<table id="idFondoAsignar"
									class="table table-bordered table-striped table-hover table-responsive ">
									<thead>
										<tr>
											<th>Fondo</th>
											<th>Saldo</th>
											<th>NCotas</th>
											<th>Eliminar</th>
										</tr>
									</thead>
									<tbody id="bodyFondoAsignarGrid">
									
									</tbody>
								</table>
								<!-- /GRID -->
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
		<!-- Modal Ver Operaciones -->
		<div class="modal fade" id="myModalOperaciones" tabindex="-1"
			role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"
							aria-hidden="true" onclick="refresh()">&times;</button>
						<h4 class="modal-title">
							<span class="fa fa-search fa-2"></span><label id="lblTituloE">Operaciones</label>
						</h4>
					</div>
					<div class="modal-body" style="padding-bottom: 0px !important;">
						<div id="idMensajeAF"></div>
						<!-- FORM -->
						<form class="bs-example form-horizontal u-action-error">
							<div class="col-lg-4">
									<input type="text" id="txtidUsuarioO" class="form-control" style="display:none" >
							</div>	
							<div class="table-responsive u-table-search">
								<!-- GRID -->
								<table id="idOperaciones"
									class="table table-bordered table-striped table-hover table-responsive ">
									<thead>
										<tr>
											<th>Fecha</th>
											<th>Tipo</th>
											<th>Monto</th>
										</tr>
									</thead>
									<tbody id="bodyOperacionesGrid">
									
									</tbody>
								</table>
								<!-- /GRID -->
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
		<!-- /.modal-dialog -->
		</div>
	</body>
	</html>
	<script src="static/scripts/jquery.doubletap.js"></script>
	<script src="static/scripts/bootstrap.js"></script>
	<script src="static/scripts/main.js"></script>
	<script>
	$().ready(function () {

	});
	function ValoresAcciones(){
		if (document.getElementById('txtAccionR').checked) 
		  {
			  document.getElementById('capaoculta').style.display = 'block';
			  $('#txtEstadoAccionR').val("1");
			  

		  } else {
			  document.getElementById('capaoculta').style.display = 'none';
			  $('#txtEstadoAccionR').val("0");
		  }
		
	}
	function CalcularTotal(){
		//txtTotalR
		var ncr = $('#txtNcR').val();
		var clearing = $('#txtClearingR').val();	
		var  num 	= parseFloat(ncr*1000)+parseFloat(clearing*1000);
		$('#txtTotalR').val(num/1000);

		var ncr = $('#txtNcE').val();
		var clearing = $('#txtClearingE').val();	
		var  num 	= parseFloat(ncr*1000)+parseFloat(clearing*1000);
		$('#txtTotalE').val(num/1000);

	}
	function FiltrarUsuarios()
	{
		var Usuario = $('#txtUsuario').val();
		var DNI = $('#txtDNI').val();
		var accion = "ObtenerBandejaUsuarios";

		var parametros = {"accion":accion,"idUsuario":"","usuario":Usuario,"DNI":DNI};
		$.ajax({
		        data:  parametros,
		        url:   'Controlador/UsuarioController.php',
		        type:  'post',
		        success:  function(response){
		        	$("#BandejaUsuarios").html(response);
		        },
		        error: function(data, errorThrown){
		        	alert('ERROR!! '+errorThrown + ' : ' + data);
		        }
			});
	}

	function AbrirPoupCrearUsuario()
	{
		$('#myModalAddUser').modal('show');
	}

	function AbrirPoupEditarUsuario()
	{
		//$('#myModalVerUser').modal('show');
		ObtenerDatosUsuario(idUsuario)
	}
	function AbrirPopupEditar(idUsuario){
		
		//$('#myModalVerUser').modal('show');
		ObtenerDatosUsuario(idUsuario)
	}

	function CrearUsuario()
	{
		var Nombres = $('#txtNombresR').val();
		var Apellidos = $('#txtApellidosR').val();
		var Direccion = $('#txtDireccionR').val();
		var DNI = $('#txtDNIR').val();
		var Telefono = $('#txtTelefonoR').val();
		var Correo = $('#txtCorreoR').val();
		var Usuario = $('#txtUsuarioR').val();
		var Pass = $('#txtPasswordR').val();
		//Campos extras
		
		
		var Estadoaccion = $('#txtEstadoAccionR').val();	
		var Custodio = $('#txtCustodioR').val();
		var Ncr = $('#txtNcR').val();
		var Ejecutivo1 = $('#txtEjecutivo1R').val();
		var Clearing = $('#txtClearingR').val();
		var Ejecutivo2 = $('#txtEjecutivo2R').val();
		var Total = $('#txtTotalR').val();
		var Ejecutivo3 = $('#txtEjecutivo3R').val();
		var Minimo = $('#txtMinimoR').val();
		var Codigo = $('#txtCodigoR').val();

		var EjecutivoSaldo1 = $('#txtEjecutivo1RSaldo').val();
		var EjecutivoSaldo2 = $('#txtEjecutivo2RSaldo').val();
		var EjecutivoSaldo3 = $('#txtEjecutivo3RSaldo').val();

		//Fin de campos extras
		
		
		var accion = "CrearUsuario";
					
			if(Nombres!="" && Apellidos!="" && Direccion!="" && DNI!=""
			   && Telefono!="" && Correo!="" && Usuario!="" && Pass != "" &&  Custodio!= "" &&  Ncr!= "" 
			   &&  Ejecutivo1!= "" &&  Clearing!= "" &&  Ejecutivo2!= "" &&  Total!= "" &&  Ejecutivo3!= "" &&  Minimo!= "" && Estadoaccion!= "")

			{
				var parametros = {"accion":accion,"Nombres":Nombres,"Apellidos":Apellidos,"Direccion":Direccion,
							"DNI":DNI,"Telefono":Telefono,"Correo":Correo,"Usuario":Usuario,
							"Password":Pass,
							"Custodio":Custodio,
							"Ncr":Ncr,
							"Ejecutivo1":Ejecutivo1,
							"Clearing":Clearing,
							"Ejecutivo2":Ejecutivo2,
							"Total":Total,
							"Ejecutivo3":Ejecutivo3,
							"Minimo":Minimo,
							"Estadoaccion":Estadoaccion,
							"Codigo":Codigo,
							"EjecutivoSaldo1":EjecutivoSaldo1,
							"EjecutivoSaldo2":EjecutivoSaldo2,
							"EjecutivoSaldo3":EjecutivoSaldo3};

				$.ajax({
						data:  parametros,
						url:   'Controlador/UsuarioController.php',
						type:  'post',
						success:  function(response){
							mensajeDiv('idMensajeU', 1, "Se guardo exitosamente");
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
	function EditarUsuarioComision()
	{

		var Nombres = $('#txtNombresE').val();
		var Apellidos = $('#txtApellidosE').val();
		var Direccion = $('#txtDireccionE').val();
		var DNI = $('#txtDNIE').val();
		var Telefono = $('#txtTelefonoE').val();
		var Correo = $('#txtCorreoE').val();
		var Usuario = $('#txtUsuarioE').val();
		var Pass = $('#txtPasswordE').val();
		
		var Estadoaccion = $('#txtAccionE').val();	
		var Custodio = $('#txtCustodioE').val();
		var Ncr = $('#txtNcE').val();
		var Ejecutivo1 = $('#txtEjecutivo1E').val();
		var Clearing = $('#txtClearingE').val();
		var Ejecutivo2 = $('#txtEjecutivo2E').val();
		var Total = $('#txtTotalE').val();
		var Ejecutivo3 = $('#txtEjecutivo3E').val();
		var Minimo = $('#txtMinimoE').val();
		var Codigo = $('#txtCodigoE').val();
		var idUsuario = $('#txtUsuarioE').val();
		

		var EjecutivoSaldo1 = $('#txtEjecutivo1ESaldo').val();
		var EjecutivoSaldo2 = $('#txtEjecutivo2ESaldo').val();
		var EjecutivoSaldo3 = $('#txtEjecutivo3ESaldo').val();

		//Fin de campos extras
		
		
		var accion = "EditarUsuarioComision";
					
			if(Nombres!="" && Apellidos!="" && Direccion!="" && DNI!=""
				   && Telefono!="" && Correo!="" && Usuario!="" && Pass != "" && idUsuario != "" &&  Custodio!= "" &&  Ncr!= "" &&  Ejecutivo1!= "" &&  Clearing!= "" &&  Ejecutivo2!= "" && 
					 Total!= "" &&  Ejecutivo3!= "" &&  Minimo!= "" && Estadoaccion!= "")

			{
				var parametros = {"accion":accion,
							"idUsuario":idUsuario,
							"Nombres":Nombres,"Apellidos":Apellidos,"Direccion":Direccion,
							"DNI":DNI,"Telefono":Telefono,"Correo":Correo,"Usuario":Usuario,
							"Password":Pass,
							"Custodio":Custodio,
							"Ncr":Ncr,
							"Ejecutivo1":Ejecutivo1,
							"Clearing":Clearing,
							"Ejecutivo2":Ejecutivo2,
							"Total":Total,
							"Ejecutivo3":Ejecutivo3,
							"Minimo":Minimo,
							"Estadoaccion":Estadoaccion,
							"Codigo":Codigo,
							"EjecutivoSaldo1":EjecutivoSaldo1,
							"EjecutivoSaldo2":EjecutivoSaldo2,
							"EjecutivoSaldo3":EjecutivoSaldo3};

				$.ajax({
						data:  parametros,
						url:   'Controlador/UsuarioController.php',
						type:  'post',
						success:  function(response){
							mensajeDiv('idMensajeU', 1, "Se guardo exitosamente");
							$('#myModalVerUser').hide();
							refresh();
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
	function BuscarUsuario(idUsuario)
	{
		var accion = "ObtenerUsuario";
		var parametros = {"accion":accion,"idUsuario":idUsuario};

		$.ajax({
			        data:  parametros,
			        url:   'Controlador/UsuarioController.php',
			        type:  'post',
			        success:  function(response){
			        	Data = response.split("**");
			        	AbrirPoupEditarUsuario();
			        	$('#txtNombresE').val(Data[0]);
						$('#txtApellidosE').val(Data[1]);
						$('#txtDireccionE').val(Data[2]);
						$('#txtDNIE').val(Data[3]);
						$('#txtTelefonoE').val(Data[4]);
						$('#txtCorreoE').val(Data[5]);
						$('#txtUsuarioE').val(Data[6]);
						$('#txtidUsuarioE').val(Data[7]);	
			        },
			        error: function(data, errorThrown){
			        	//mensajeDiv('idMensajeU', 2, "Ocurrio un error.");
			        }
				});

	}

	function EditarUsuario()
	{
		var Nombres = $('#txtNombresE').val();
		var Apellidos = $('#txtApellidosE').val();
		var Direccion = $('#txtDireccionE').val();
		var DNI = $('#txtDNIE').val();
		var Telefono = $('#txtTelefonoE').val();
		var Correo = $('#txtCorreoE').val();
		var Usuario = $('#txtUsuarioE').val();
		var idUsuario = $('#txtidUsuarioE').val();
		var accion = "EditarUsuario";

		if(Nombres!="" && Apellidos!="" && Direccion!="" && DNI!=""
		   && Telefono!="" && Correo!="" && Usuario!="" && idUsuario != "")
		{
			var parametros = {"accion":accion,"Nombres":Nombres,"Apellidos":Apellidos,"Direccion":Direccion,
						"DNI":DNI,"Telefono":Telefono,"Correo":Correo,"Usuario":Usuario,"idUsuario":idUsuario};

			$.ajax({
			        data:  parametros,
			        url:   'Controlador/UsuarioController.php',
			        type:  'post',
			        success:  function(response){
			        	mensajeDiv('idMensajeE', 1, "Se guardo exitosamente");
			        },
			        error: function(data, errorThrown){
			        	mensajeDiv('idMensajeE', 2, "Ocurrio un error.");
			        }
				});
		}
		else
		{
			mensajeDiv('idMensajeE', 2, "Completar todos los campos");
		}
	}

	function EliminarUsuario()
	{
		debugger;
		var idUsuario = $('#txtidUsuarioE').val();
		var accion = "EliminarUsuario";

		if(idUsuario != "")
		{
			var parametros = {"accion":accion,"idUsuario":idUsuario};

			$.ajax({
			        data:  parametros,
			        url:   'Controlador/UsuarioController.php',
			        type:  'post',
			        success:  function(response){
			        	mensajeDiv('idMensajeE', 1, "Se Elimino exitosamente");
			        },
			        error: function(data, errorThrown){
			        	mensajeDiv('idMensajeE', 2, "Ocurrio un error.");
			        }
				});
		}
		else
		{
			mensajeDiv('idMensajeE', 2, "Completar todos los campos");
		}
	}

	function AbrirPopupAsignarFondos(idUsuario)
	{
		$('#txtidUsuarioF').val(idUsuario);
		ObtenerFondosAsignados(idUsuario);
	}

	function ObtenerFondosAsignados(idUsuario)
	{
		var accion = "ObtenerFondosAsignados";	
		var parametros = {"accion":accion,"idUsuario":idUsuario};

		$.ajax({
			    data:  parametros,
			    url:   'Controlador/UsuarioController.php',
			    type:  'post',
			    success:  function(response){
			        $('#bodyFondoAsignarGrid').html(response);
			        $('#myModalAsigFondo').modal('show');
			    },
			    error: function(data, errorThrown){
			    	//mensajeDiv('idMensajeU', 2, "Ocurrio un error.");
			    }
		});
	}
	function ObtenerDatosUsuario(idUsuario)
	{
		var accion = "ObtenerDatosUsuario";	
		var parametros = {"accion":accion,"idUsuario":idUsuario};

		$.ajax({
			    data:  parametros,
			    url:   'Controlador/UsuarioController.php',
			    type:  'post',
			    success:  function(response){
			        $('#myModalVerUser').html(response);
			        $('#myModalVerUser').modal('show');
			    },
			    error: function(data, errorThrown){
			    	//mensajeDiv('idMensajeU', 2, "Ocurrio un error.");
			    }
		});
	}

	function AbrirPopupVerOperaciones(idUsuario)
	{
		var accion = "ObtenerOperacione";	
		var parametros = {"accion":accion,"idUsuario":idUsuario};

		$.ajax({
			    data:  parametros,
			    url:   'Controlador/ClientesController.php',
			    type:  'post',
			    success:  function(response){
			        $('#bodyOperacionesGrid').html(response);
			        $('#myModalOperaciones').modal('show');
			    },
			    error: function(data, errorThrown){
			    }
		});
	}

	function AgregarFondoUsuario()
	{
		var idUsuario = $('#txtidUsuarioF').val();
		var idFondo = $('#cboFondos').val();
		var NumCuotas = $('#txtNumeroCuotas').val();
		var accion = "AgregarFondoUsuario";
		if(idUsuario!="" && idFondo!="" && NumCuotas!="")
		{
			var parametros = {"accion":accion,"idUsuario":idUsuario,"idFondo":idFondo,"NumeroCuotas":NumCuotas};

			$.ajax({
				    data:  parametros,
				    url:   'Controlador/UsuarioController.php',
				    type:  'post',
				    success:  function(response){
				    	if(response == 1)
				    	{
					    	mensajeDiv('idMensajeAF', 1, "Se Agrego exitosamente");
					    	ObtenerFondosAsignados(idUsuario);
				    	}
				    	else
				    	{
				    		mensajeDiv('idMensajeAF', 2, "El Usuario ya tiene asignado el fondo.");
				    	}
				    },
				    error: function(data, errorThrown){
				    	//mensajeDiv('idMensajeU', 2, "Ocurrio un error.");idMensajeAF
				    }
			});
		}
		else
		{
			alert("Agrege el Numero de Cuotas.");
		}
	}

	function EliminarFondoUsuario(idFondo,idUsuario)
	{
		var accion = "EliminarFondoUsuario";	
		var parametros = {"accion":accion,"idFondo":idFondo,"idUsuario":idUsuario};

		$.ajax({
			    data:  parametros,
			    url:   'Controlador/UsuarioController.php',
			    type:  'post',
			    success:  function(response){
			    	//alert(response);
			    	ObtenerFondosAsignados(idUsuario);
			    },
			    error: function(data, errorThrown){
			    	//mensajeDiv('idMensajeU', 2, "Ocurrio un error.");
			    }
		});
	}

	</script>
<?php }else {
    header("Location: index.php");
}
?>