<?php
session_start ();
if ($_SESSION['usuario']) {
	include 'Modelo/Noticias.class.php';

	$Noticias = new Noticias();
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
								Noticias</strong> <span class="pull-right"><span
								id="oprincipal" class="fa fa-chevron-circle-up"></span>						
						</div>
						<div class="panel-body">
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
	
									<table >
									<?php
									$query = $Noticias->ObtenerNoticiaDia();
									while ( $var = mysql_fetch_array ( $query ) ) {
										$i ++;
									?>	
									<tr>
									  <td><h3><?php echo nl2br(stripslashes($var['nombre'])); ?></h3></td>
									</tr>	
									<tr>
									  <td><h5><?php echo$var['fecha']; ?></h5></td>
									</tr>
									<tr>
									  <td valign="top"><img src="<?php echo substr($var['imagen'],3);?>" style="width:300px"/></td>
									  <td><h5><?php echo nl2br(stripslashes($var['descripcion'])); ?></h5></td>
									  
									</tr>
									<tr>
										<td><hr></td>
									</tr>
									<?php }?>
									</table>
							

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
								Noticia</label>
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
								<label for="inputEmail1" class="col-lg-2 control-label">Imagen:</label>
								<div class="col-lg-4">
									<input type="file" id="File" class="form-control" style="width:460px">
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
										onclick="AgregarNoticia()">
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

	function AgregarNoticia()
	{
		var nombre = $('#txtNombre').val();
		var descripcion = $('#txtDescripcion').val();
		var fd = new FormData();
        fd.append("File", document.getElementById('File').files[0]);

        if(nombre != "" && descripcion != "")
        {
			$.ajax({
				url: "Util/NoticiasUpload.php",
				type: "POST",
				data:  fd,
				contentType: false,
			    cache: false,
				processData:false,
				success:  function(response){
				    if(response != "error")
				    {
				        RegistrarNoticia(response);
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

	function RegistrarNoticia(path)
	{
		var nombre = $('#txtNombre').val();
		var descripcion = $('#txtDescripcion').val();
		var accion = "AgregarNoticia";
		var parametros = {"accion":accion,"nombre":nombre,"descripcion":descripcion,"Path":path};
		$.ajax({
				data:  parametros,
				url:   'Controlador/NoticiasController.php',
				type:  'post',
				success:  function(response){
					mensajeDiv('idMensajeU', 1, "Se guardo exitosamente");
				},
				error: function(data, errorThrown){
				}
		});	
	}

	function AbrirPopupEliminar(idNoticia)
	{
		var answer = confirm("Esta Seguro que quiere eliminar la noticia?")
		if (answer){
			var accion = "EliminarNoticia";
		    var parametros = {"accion":accion,"idNoticia":idNoticia};
			$.ajax({
				data:  parametros,
				url:   'Controlador/NoticiasController.php',
				type:  'post',
				success:  function(response){
					refresh();
				},
				error: function(data, errorThrown){
				}
			});	
		}
	}

	function ObtenerNoticias()
	{
		var FechaIni = $('#txtFechaInicio').val();
		var FechaFin = $('#txtFechaFin').val();
		var accion = "ObtenerNoticias";
		var parametros = {"accion":accion,"FechaIni":FechaIni,"FechaFin":FechaFin};
		$.ajax({
			        data:  parametros,
			        url:   'Controlador/NoticiasController.php',
			        type:  'post',
			        success:  function(response){
			        	$('#BandejaNoticias').html(response);
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