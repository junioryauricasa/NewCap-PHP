<?php
//session_start();
include('../Modelo/Fondo.class.php');
$objeto = new Fondo();

$action = $_POST['accion'];

if($action == 'CrearFondo')
{
	$result = $objeto->CrearFondo($_POST['NombreFondo'],$_POST['ValorCuotaInicial'],$_POST['NumeroCuotas']);
	echo$result;
}
elseif($action == 'ObtenerHistorialFondo')
{
	$result = $objeto->ObtenerHistorialFondo($_POST['idFondo']);
	$count = $objeto->ObtenerNumeroHistorial($_POST['idFondo']);

	$conteo = $count["conteo"];
	$index = 0;

	while ( $var = mysql_fetch_array($result)){
		$index = $index + 1;
		$filas .= "
		<tr>
				<td>".$var['fecha']."</td>
				<td>".$var['valorcuota']."</td>";
		if($index == (int)$conteo)
		{
				$filas .= "<td><a href=# onclick='EliminarHistorialFondo(".$var['idHistorialValorCuota'].")'>
					<i class='fa fa-trash'> </i>
				</a>
				</td>";
		}
		else
		{
			$filas .= "<td> - </td>";
		}
		$filas .="</tr>
		";
		
	}
	echo$filas;
}
elseif($action == 'EliminarHistorialFondo')
{
	$result = $objeto->EliminarHistorialFondo($_POST['idFondoHistorial']);
	echo$result;
}
elseif($action == 'AgregarValorCuota')
{
	$result = $objeto->AgregarValorCuota($_POST['idFondo'],$_POST['ValorCuota'],$_POST['Fecha']);
	echo$result;
}
elseif($action == 'EliminarFondo')
{
	$result = $objeto->EliminarFondo($_POST['idFondo']);
	echo$result;
}
else{	
	echo "No se ejecuto lo solicitado";
}
?>