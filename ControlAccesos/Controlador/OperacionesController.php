<?php
//session_start();
include('../Modelo/Operaciones.class.php');
$objeto = new Operaciones();

$action = $_POST['accion'];
if($action == 'AgregarOperacion')
{
	$result = $objeto->AgregarOperacion($_POST['idUsuario'],$_POST['Tipo'],$_POST['Monto']);
	echo$result;
}


if($action == 'ObtenerOperaciones')
{
	$result = $objeto->ObtenerAportes($_POST['FechaIni'],$_POST['FechaFin'],$_POST['Fondo'],
									$_POST['Usuario']);
	$filas = "";
	if ($result)
	{
		while ( $var = mysql_fetch_array($result)) {
			$filas .= "
			<tr> 
					<td width='28px'></td>
					<td>".$var['fecha']."</td>
					<td>".$var['usuario']."</td>
					<td>".$var['NOMBRE']."</td>
					<td>".$var['cantidad']."</td>
					<td>".$var['saldoanterior']."</td>
					<td>".$var['saldoactual']."</td>
					<td>".$var['NcuotasAgregado']."</td>
					<td>".$var['NcuotasAnterior']."</td>
					<td>".$var['NcuotasActual']."</td>
					<td>
						<a href=# onclick='AbrirPopupEliminar(".$var['idoperaciones'].")'>
							<i class='fa fa-trash'> </i>
						</a>
					</td>
			</tr>
			";
		}
	}
	echo$filas;
}
if($action == 'ObtenerOperacionesActuales')
{
	$result = $objeto->ObtenerOperacionesActuales($_POST['FechaIni'],$_POST['FechaFin'],"","","");
	$filas = "";
	if ($result)
	{
		while ( $var = mysql_fetch_array($result)) {
			
			if($var['TipoOperacion']== "D")
				$rd = "Deposito";
			if($var['TipoOperacion']== "R")
				$rd = "Retiro";
			if($var['TipoOperacion']== "B")
				$rd = "Buy";
			if($var['TipoOperacion']== "S")
				$rd = "Sell";
			
			$filas .= "
			<tr>
					<td width='28px'></td>
					<td>".$var['fechaHora']."</td>
					<td>".$var['descripcion']."</td>
					<td>".$rd."</td>
					<td>".number_format($var['cantidad'],2,'.',',')."</td>
					<td>".number_format($var['precio'],2,'.',',')."</td>
					<td>".number_format($var['saldoFinal'],2,'.',',')."</td>

					<td>
						-
					</td>
			</tr>
			";
		}
	}
	echo$filas;
}
elseif($action == 'ObtenerSaldoActual')
{
	$result = $objeto->ObtenerSaldoActual($_POST['idUsuario']);
	$filas = "";
	if ($result)
	{
		while ( $var = mysql_fetch_array($result)) {
			$filas = "<input type='text' id='txtSaldo' class='form-control' value='".$var['saldoActual']."' readonly>";
		}
	}
	echo$filas;
}

elseif($action == 'EliminarOperacion')
{
	//echo var_dump($_POST['idUsuario']);  
	$result = $objeto->EliminarOperacion($_POST['idOperacion']);
	
	echo$filas;
}
/*
elseif($action == 'AgregarAporte')
{
	$result = $objeto->AgregarAporte($_POST['idFondo'],$_POST['idUsuario'],$_POST['Aporte'],$_POST['NCuotaAdd']);
	echo$result;
}
elseif($action == 'ObtenerFondos')
{
	$result = $objeto->ObtenerFondos($_POST['idUsuario']);
	$filas = "";
	if ($result)
	{
		while ( $var = mysql_fetch_array($result)) {
			$filas .= "
			<option value=".$var['idFondos']." >".$var['nombre']."</option>";
		}
	}
	echo$filas;
}*/
else{	
	echo "No se ejecuto lo solicitado";
}
?>