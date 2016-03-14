<?php
session_start ();
if ($_SESSION['usuario']) {
	include 'Modelo/Clientes.class.php';
	include 'Modelo/Fondo.class.php';

	$Fondo = new Fondo();
	$Clientes = new Clientes();
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

	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

	<script type="text/javascript">
	$(document).ready(function () {
	    CrearGrafica();
	});

	google.load('visualization', '1', {'packages':['corechart']});
      
    // Set a callback to run when the Google Visualization API is loaded.
    google.setOnLoadCallback();

    var datos;

	function CrearGrafica()
	{
    	drawChart();
	}

    function drawChart() {
    	debugger;
     	var idUsuario = $('#txtIdUsuario').val();
		var idFondos = $('#cboFondos').val();
		var NombreFondo = $('#cboFondos option:selected').text();
		//var file_data = document.getElementById('txtFile').files[0].getAsBinary();
		
		var accion = "ObtenerGrafico";

		var FechaIni = $('#txtFechaInicio').val();
		var FechaFin = $('#txtFechaFin').val();

		var parametros = {"accion":accion,"idUsuario":idUsuario,"idFondos":idFondos,"FechaIni":FechaIni,"FechaFin":FechaFin};
		var jsonData = $.ajax({
			data:  parametros,
			url:   'Controlador/ClientesController.php',
			type:  'post',
			dataType:'json',
    		async:false}).responseText;

	    var obj = jQuery.parseJSON(jsonData);

	    /*var arrr = new Array(new Array ('Date','Jun 25','Jun 26','Jun 27','Jun 28'),
	    					 new Array ('Sales',10,11,20,11),
	    					 new Array ('aaa',12,33,21,43));

	    var arrr = new Array(new Array ('Date','Sales'),
	    					 new Array ('2015/10/02',10),
	    					 new Array ('2015/10/03',14),
	    					 new Array ('2015/10/04',19),
	    					 new Array ('2015/10/05',25));*/

        var data = google.visualization.arrayToDataTable(obj);
        var options = {
            title: NombreFondo
        };

        var chart = new google.visualization.LineChart(
                        document.getElementById('chart_div'));
        chart.draw(data, options);
    }
	
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
	<div class="col-md-10" id="contenedorprincipal">
					<div class="panel panel-default" id="importacion">
						<div class="panel-heading">
							<strong><span id="omenu" class="fa fa-chevron-circle-left"></span>
								Graficas</strong> <span class="pull-right"><span
								id="oprincipal" class="fa fa-chevron-circle-up"></span>						
						</div>
						<div class="panel-body">
							<div class="nav">
								<nav id="bprincipal" class="navbar navbar-default navbar-inverse"
									role="navigation">
									<div class="navbar-collapse  navbar-filter">
										<input type="hidden" id="txtIdUsuario" value="<?php echo$_SESSION['idUsuario']?>" style="">
										<label for="inputEmail1" style="margin-right:20px; margin-left:20px;">Fecha Inicial :</label>
										<input type="date" style="height:23px; width:150px" value="" id="txtFechaInicio" name="txtFechaInicio">
										<label for="inputEmail1" style="margin-right:20px; margin-left:20px;">Fecha Final :</label>
										<input type="date" style="height:23px; width:150px" value="" id="txtFechaFin" name="txtFechaFin" >
										<label for="inputEmail1" style="margin-right:20px; margin-left:20px;">Fondo :
										</label>
										<select id="cboFondos" style="height:23px; width:150px" >
											<?php									
											$queryFon = $Fondo->ObtenerFondoUsusario($_SESSION['idUsuario']);
												while ( $var = mysql_fetch_array ( $queryFon ) ) {
													$i ++;
													?>		
										        <option value="<?php echo$var['idFondos'];?>"><?php echo$var['nombre'];?></option>
											<?php }?>
										</select>
										&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; 	
										<a class="btn btn-default" data-toggle="modal"
											href="#" onclick="CrearGrafica()"> <span class="fa fa-search fa-2"></span>
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
							<div id="chart_div" style="width: 900px; height: 500px;"></div>
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

	

	/*function drawChart() {
        	var data = google.visualization.arrayToDataTable(a);

        	var options = {
          	title: 'FONDO',
          	width:900,
            height:500
        	};

        	var grafico = new google.visualization.LineChart(document.getElementById('idGrafica'));
        	grafico.draw(data, options);
      	}
*/

	</script>
<?php }else {
    header("Location: index.php");
}
?>