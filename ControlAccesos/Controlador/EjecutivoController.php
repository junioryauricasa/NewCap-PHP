<?php
//session_start();
include('../Modelo/Ejecutivo.class.php');
$objeto = new Ejecutivo();

$action = $_POST['accion'];

if($action == 'CrearEjecutivo')
{
	$result = $objeto->CrearEjecutivo($_POST['NombreEjecutivo'],$_POST['ValorComision']);
	echo$result;
}
else if($action == 'EliminarEjecutivo')
{
	$result = $objeto->EliminarEjecutivo($_POST['idEjecutivo']);
	echo$result;
}
else{	
	echo "No se ejecuto lo solicitado";
}
?>