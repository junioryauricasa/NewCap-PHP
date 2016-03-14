<?php
//session_start();
include('../Modelo/Clientes.class.php');
$objeto = new Clientes();

$action = $_POST['accion'];

if($action == 'AgregarFichero')
{
	$file = $_POST['file_data'];
	echo var_dump($file);
	echo$file;
}
elseif($action == 'ObtenerOperacione')
{
	$result = $objeto->ObtenerOperacione($_POST['idUsuario']);
	$filas = "";
	if($result)
	{
		$num = mysql_num_rows($result);
		if($num > 0)
		{
			while ( $var = mysql_fetch_array($result)){
				$filas .= "
				<tr> 
					<td>".$var['fecha']."</td>
					<td>".$var['tipo']."</td>
					<td>".$var['cantidad']."</td>
				</tr>
				";
			}
		}
	}
	echo$filas;
}
elseif($action == 'ObtenerGrafico')
{
	$result = $objeto->ObtenerGrafico($_POST['idUsuario'],$_POST['idFondos'],$_POST['FechaIni'],$_POST['FechaFin']);
	$data[0] = array('Fecha','ValorCuota');
	$index = 1;
	if($result)
	{
		while ( $var = mysql_fetch_array($result)){
			$data[$index] = array($var['fecha'],(double)$var['valorcuota']);
			$index++;	
		}
	}
	echo json_encode($data);

}
elseif($action == 'EliminarFichero')
{
	$result = $objeto->EliminarFichero($_POST['idFichero']);
	echo$result;
}
else{	
	echo "No se ejecuto lo solicitado";
}
?>