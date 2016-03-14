<?php
//session_start();
include('../Modelo/Rescate.class.php');
$objeto = new Rescates();

$action = $_POST['accion'];

if($action == 'ObtenerRescates')
{
	$result = $objeto->ObtenerRescates($_POST['FechaIni'],$_POST['FechaFin'],$_POST['Fondo'],
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
					<td>".$var['nombre']."</td>
					<td>".$var['cantidad']."</td>
					<td>".$var['castigo']."</td>
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
	//echo var_dump($filas);
	echo$filas;
}
elseif($action == 'EliminarRescate')
{
	//echo var_dump($_POST['idUsuario']);  
	$result = $objeto->EliminarRescate($_POST['idAporte']);
	
	echo$filas;
}
elseif($action == 'AgregarAporte')
{
	$result = $objeto->AgregarAporte($_POST['idFondo'],$_POST['idUsuario'],$_POST['Aporte']);
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
}
elseif($action == 'ObtenerRescatable')
{
	$result = $objeto->ObtenerRescatable($_POST['idUsuario'],$_POST['idFondo']);
	echo$result;
}
elseif($action == 'AgregarRescate')
{
	$result = $objeto->AgregarRescate($_POST['idFondo'],$_POST['idUsuario'],$_POST['Rescate'],$_POST['Castigo'],
										$_POST['SaldoActual'],$_POST['NCuotaAdd']);
	echo$result;
}
else{	
	echo "No se ejecuto lo solicitado";
}
?>