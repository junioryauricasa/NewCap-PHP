<?php
session_start ();
if ($_SESSION['usuario']) {
	include 'Modelo/Fichero.class.php';
	

	$Fichero = new Fichero();

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
	<title>New Capital - Ficheros</title>
	<script type="text/javascript">

	
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
								Ficheros</strong> <span class="pull-right"><span
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
											onclick="ObtenerFicheros()"> <span class="fa fa-search fa-2"></span>
											Buscar
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
											<th>Nombre</th>
											<th>Descripción</th>
											<th>Download</th>
										</tr>
									</thead>
									<tbody id="BandejaFichero">
										<?php
										$query = $Fichero->ObtenerFicherosClientes('','');
										//echo $query;
										while ( $var = mysql_fetch_array ( $query ) ) {
											$i ++;
										?>
										<tr>
											<td width="28px"></td>
											<td><?php echo$var['fecha']; ?></td>
											<td><?php echo$var['Nombre']; ?></td>
											<td><?php echo$var['descripcion']; ?></td>
											<td><a onclick="DescargarArchivo('<?php echo$var['Link']; ?>')">
														<i class="fa fa-download"> </i>
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
									<input type="file" id="File" name="userImage" class="form-control" style="width:460px">
								</div>
							</div>			
					</div>
					<div class="modal-footer">
						<table align="right">
							<tr>
								<td>&nbsp;&nbsp;</td>
								<td>
									<button class="btn btn-primary" type="button"
										onclick="AgregarFichero()">
										<span class="fa fa-save"></span> Guardar
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
		$(document).ready(function (e) {
	$("#uploadForm").on('submit',(function(e) {
		debugger;
		var aa = new FormData(this);
		e.preventDefault();
		$.ajax({
        	url: "upload.php",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,
			success: function(data)
		    {
			$("#targetLayer").html(data);
		    },
		  	error: function()
	    	{
	    	}
	   });
	}));
});

	function AbrirPopupCrearFichero()
	{
		$('#myModalAddFichero').modal('show');
	}

	function AgregarFichero()
	{
		var nombre = $('#txtNombre').val();
		var descripcion = $('#txtDescripcion').val();
		var fd = new FormData();
        fd.append("File", document.getElementById('File').files[0]);

        if(nombre != "" && descripcion != "")
        {
			$.ajax({
				url: "Util/upload.php",
				type: "POST",
				data:  fd,
				contentType: false,
			    cache: false,
				processData:false,
				success:  function(response){
				    if(response != "error")
				    {
				        RegistrarFichero(response);
				    }
				},
				error: function(data, errorThrown){
				    alert(errorThrown);
				}
			});
		}
		else
		{
			alert("Por favor llenar todos los campos");
		}
	}

	function RegistrarFichero(path)
	{
		var nombre = $('#txtNombre').val();
		var descripcion = $('#txtDescripcion').val();
		var accion = "AgregarFichero";
		var parametros = {"accion":accion,"nombre":nombre,"descripcion":descripcion,"Path":path};
		$.ajax({
				data:  parametros,
				url:   'Controlador/FicheroController.php',
				type:  'post',
				success:  function(response){
					mensajeDiv('idMensajeU', 1, "Se guardo exitosamente");
				},
				error: function(data, errorThrown){
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
		var accion = "ObtenerFicherosClientes";
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

	function DescargarArchivo(Path)
	{
		var URL = Path.substring(3);
		var actual = window.location.href;
		var corte = actual.substring(0,actual.length-18);
		var Descarga = corte + URL;
		var win = window.open(Descarga);
  		win.focus();
	}

	</script>
<?php }else {
    header("Location: index.php");
}
?>