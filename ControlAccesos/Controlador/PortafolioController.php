<?php
//session_start();
include('../Modelo/Portafolio.class.php');
$objeto = new Portafolio();

$action = $_POST['accion'];
/*
if($action == 'ObtenerPortafolio')
{
	$result = $objeto->ObtenerPortafolio($_POST['Usuario']);
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
elseif($action == 'EliminarAporte')
{
	//echo var_dump($_POST['idUsuario']);  
	$result = $objeto->EliminarAporte($_POST['idAporte']);
	
	echo$filas;
}
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
}
else{	
	echo "No se ejecuto lo solicitado";
}*/
?>