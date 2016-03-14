<?php
include('../Modelo/Usuario.class.php');
$entidad = new Usuario();
$action = $_POST['accion'];
if ($action == 'validaUsuarioLogin'){
	$item =mysql_fetch_array($entidad ->ValidarUsuario($_POST['usuario'],$_POST['password']));
	//$item =$entidad ->ValidarUsuario($_POST['usuario'],$_POST['password']);
	//$item=$_POST['usuario'].'**'.$_POST['password'];
	//echo var_dump($item);
	//echo$item;

	if($item!=""){
		echo$item["nombres"].'**'.$item["apellidos"].'**'.$item["correo"];
		//echo$item;
	}
}elseif ($action == 'Editar'){
	$rol->setIdentRol($_POST['identRol']);
	$rol->setNombre($_POST['nombre']);
	$rol->setEstado($_POST['estado']);
	$rol->actualizarRol();
	echo "Se modifico con exito";
}else{
	echo "No se ejecuto lo solicitado";
}
?>