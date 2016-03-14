<?php
//session_start();
include('../Modelo/Activo.class.php');
$objeto = new Activo();

$action = $_POST['accion'];

if($action == 'CrearActivo')
{
	$result = $objeto->CrearActivo($_POST['CodigoActivo'],$_POST['NombreActivo']);
	echo$result;
}
else if($action == 'EliminarActivo')
{
	$result = $objeto->EliminarActivo($_POST['idActivo']);
	echo$result;
}
else{	
	echo "No se ejecuto lo solicitado";
}
?>