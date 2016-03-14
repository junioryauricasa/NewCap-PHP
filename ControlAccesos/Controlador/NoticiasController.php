<?php
//session_start();
include('../Modelo/Noticias.class.php');
$objeto = new Noticias();

$action = $_POST['accion'];

if($action == 'AgregarNoticia')
{
	$result = $objeto->AgregarNoticia(addslashes($_POST['nombre']),addslashes($_POST['descripcion']),$_POST['Path']);
	echo$result;
}
elseif($action == 'ObtenerNoticias')
{
	$result = $objeto->ObtenerNoticias($_POST['FechaIni'],$_POST['FechaFin']);
	$filas = "";
	while ( $var = mysql_fetch_array($result)){
		$imagen = substr($var['imagen'],3);
		$filas .= "
		<tr> 
				<td width='28px'></td>
				<td>".$var['fecha']."</td>
				<td>".$var['nombre']."</td>
				<td>".$var['descripcion']."</td>
				<td><img src=".$imagen." width='40px' height='40px' /></td>
				<td><a href=# onclick='AbrirPopupEliminar(".$var['idnoticias'].")''>
														<i class='fa fa-trash'> </i>
					</a>
				</td>
		</tr>
		";
	}
	echo$filas;
}
elseif($action == 'EliminarNoticia')
{
	$result = $objeto->EliminarNoticia($_POST['idNoticia']);
	echo$result;
}
else{	
	echo "No se ejecuto lo solicitado";
}
?>