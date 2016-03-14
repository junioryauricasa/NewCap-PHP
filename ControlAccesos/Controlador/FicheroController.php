<?php
//session_start();
include('../Modelo/Fichero.class.php');
$objeto = new Fichero();

$action = $_POST['accion'];

if($action == 'AgregarFichero')
{
	$result = $objeto->AgregarFichero($_POST['nombre'],$_POST['descripcion'],$_POST['Path']);
	echo$result;
}
elseif($action == 'ObtenerFicheros')
{
	$result = $objeto->ObtenerFicheros($_POST['FechaIni'],$_POST['FechaFin']);
	$filas = "";
	while ( $var = mysql_fetch_array($result)){
		$filas .= "
		<tr> 
				<td width='28px'></td>
				<td>".$var['fecha']."</td>
				<td>".$var['Nombre']."</td>
				<td>".$var['descripcion']."</td>
				<td><a href=# onclick='DescargarArchivo('".$var['Link']."')'>
														<i class='fa fa-download'> </i>
												</a>
											</td>
				<td><a href=# onclick='AbrirPopupEliminar(".$var['idficheros'].")''>
														<i class='fa fa-trash'> </i>
					</a>
				</td>
		</tr>
		";
	}
	echo$filas;
}
elseif($action == 'ObtenerFicherosClientes')
{
	$result = $objeto->ObtenerFicherosClientes($_POST['FechaIni'],$_POST['FechaFin']);
	$filas = "";
	while ( $var = mysql_fetch_array($result)){
		$filas .= "
		<tr> 
				<td width='28px'></td>
				<td>".$var['fecha']."</td>
				<td>".$var['Nombre']."</td>
				<td>".$var['descripcion']."</td>
				<td><a href=# onclick='DescargarArchivo('".$var['Link']."')'>
														<i class='fa fa-download'> </i>
												</a>
											</td>
		</tr>
		";
	}
	echo$filas;
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