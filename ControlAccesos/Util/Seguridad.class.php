<?php
include 'Modelo/Usuario.class.php';
session_start();
class Seguridad {
	function validarUsuario($usuario,$password){
		$validar = new Usuario();
		$roles = array();
		$query = $validar->ValidarUsuario($usuario,$password);
		if($query!=null){
			if(mysql_num_rows($query)>0){

				$informacion = mysql_fetch_array($query);
				
				$_SESSION['usuario'] = $usuario;
				$_SESSION['nombre'] = $informacion['nombres'];
				$_SESSION['Apellido'] = $informacion['apellidos'];
				$_SESSION['Direccion'] = $informacion['direccion'];
				$_SESSION['DNI'] = $informacion['dni'];
				$_SESSION['Telefono'] = $informacion['telefono'];
				$_SESSION['Correo'] = $informacion['correo'];
				$_SESSION['TipoUsuario'] = $informacion['TipoUsuario'];
				$_SESSION['idUsuario'] = $informacion['idUsuarios'];
				$_SESSION['accionario'] = $informacion['accionario'];

				//echo var_dump($_SESSION['nombre']);
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	function verificarRol($array,$rol){
		foreach ($array as $item){
			if($item==$rol){
				return true;
			}
		}
		return false;
	}
}
?>