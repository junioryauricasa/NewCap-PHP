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
	<title>New Capital - Noticias</title>
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
											href="#" onclick="ObtenerNoticias()"> <span class="fa fa-search fa-2"></span>
											Buscar
										</a> &nbsp;&nbsp; 
										<a class="btn btn-default" data-toggle="modal"
											href="#" onclick="AbrirPopupCrearFichero()"> <span class="fa fah fa-2"></span>
											Agregar Noticia
										</a> 
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
											<th>Imagen</th>
											<th>Eliminar</th>
										</tr>
									</thead>
									<tbody id="BandejaNoticias">
										<?php
										$query = $Noticias->ObtenerNoticias('','');
										//echo $query;
										while ( $var = mysql_fetch_array ( $query ) ) {
											$i ++;
										?>
										<tr>
											<td width="28px"></td>
											<td><?php echo$var['fecha']; ?></td>
											<td align="left"><div style='text-align:left;'><?php echo nl2br($var['nombre']); ?></div></td>
											<td align="left"><div style='text-align:left;'><?php echo nl2br($var['descripcion']); ?></div></td>
											<td><img src="<?php echo substr($var['imagen'],3); ?>" width="40px" height="40px" /></td>
											<td><a href=# onclick="AbrirPopupEliminar(<?php echo$var['idnoticias']; ?>)">
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
								<textarea id="txtNombre" cols="60" rows="4" class="form-control" style="width:180px"></textarea>
								</div>
							</div>	
							<div class="form-group">
							<label for="inputEmail1" class="col-lg-2 control-label">Descripcion:</label>
								<div class="col-lg-4">
								<textarea id="txtDescripcion" cols="140" rows="12" class="form-control" style="width:480px"></textarea>
									<!--<input type="text" id="txtDescripcion" class="form-control">-->
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail1" class="col-lg-2 control-label">Imagen:</label>
								<div class="col-lg-4">
									<input type="file" id="File" class="form-control" style="width:480px">
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