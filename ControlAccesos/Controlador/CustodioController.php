<?php
//session_start();
include('../Modelo/Custodio.class.php');
$objeto = new Custodio();

$action = $_POST['accion'];

if($action == 'CrearCustodio')
{
	$result = $objeto->CrearCustodio($_POST['CodigoCustodio'],$_POST['NombreCustodio']);
	echo$result;
}
else if($action == 'EliminarCustodio')
{
	$result = $objeto->EliminarCustodio($_POST['idCustodio']);
	echo$result;
}
else{	
	echo "No se ejecuto lo solicitado";
}
?>