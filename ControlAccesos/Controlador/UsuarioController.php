<?php
//session_start();
include('../Modelo/Usuario.class.php');
$objeto = new Usuario();

$action = $_POST['accion'];
if ($action == 'ObtenerBandejaUsuarios') {
	//echo var_dump($_POST['DNI']);  
	$result = $objeto->ObtenerBandejaUsuarios($_POST['idUsuario'],$_POST['usuario'],$_POST['DNI']);
	$filas = "";
	while ( $var = mysql_fetch_array($result)) {
		$filas .= "
		<tr ondblclick='BuscarUsuario(".$var['idUsuarios'].")'> 
				<td width='28px'></td>
				<td>".$var['nombres']."</td>
				<td>".$var['apellidos']."</td>
				<td>".$var['direccion']."</td>
				<td>".$var['dni']."</td>
				<td>".$var['telefono']."</td>
				<td>".$var['correo']."</td>
				<td>".$var['usuario']."</td>
				<td>".$var['password']."</td>
				<td>";
					if($var['estado']==1){
					$filas .="Activo";
					} 
					else{ 	
					$filas .="Inactivo";
					}				
				$filas .= "</td>
				<td>";
					
					if($var['TipoUsuario']==1){
					$filas .="Administrador";
					} 
					else{	
					$filas .="Cliente";
					}
				$filas .= "</td>
				<td><a href=# onclick='AbrirPopupVerOperaciones(".$var['idUsuarios'].")'>
					<i class='fa fa-search-plus'> </i>
				</a>
				</td>
				<td><a href=# onclick='AbrirPopupAsignarFondos(".$var['idUsuarios'].")'>
					<i class='fa fa-chevron-circle-up'> </i>
				</a>
				</td>
		</tr>
		";

	}
	echo$filas;
}
elseif($action == 'CrearUsuario')
{
	$result = $objeto->CrearUsuario($_POST['Nombres'],$_POST['Apellidos'],$_POST['Direccion'],
									$_POST['DNI'],$_POST['Telefono'],$_POST['Correo'],
									$_POST['Usuario'],$_POST['Password'],$_POST['Estadoaccion'],
									$_POST['Custodio'],$_POST['Ncr'],$_POST['Ejecutivo1'],
									$_POST['Clearing'],$_POST['Ejecutivo2'],$_POST['Total'],
									$_POST['Ejecutivo3'],$_POST['Minimo'],$_POST['Codigo'],
									$_POST['EjecutivoSaldo1'],$_POST['EjecutivoSaldo2'],$_POST['EjecutivoSaldo3']);									
	echo$result;
}
elseif($action == 'ObtenerUsuario')
{
	//echo var_dump($_POST['idUsuario']);  
	$result = $objeto->ObtenerUsuario($_POST['idUsuario']);
	while ( $var = mysql_fetch_array($result)) {
		$filas .= $var['nombres']."**".$var['apellidos']."**".$var['direccion']."**".
					$var['dni']."**".$var['telefono']."**".$var['correo']."**".
					$var['usuario']."**".$var['idUsuarios']."";
	}
	echo$filas;
}
elseif($action == 'EditarUsuario')
{
	$result = $objeto->EditarUsuario($_POST['Nombres'],$_POST['Apellidos'],$_POST['Direccion'],
									$_POST['DNI'],$_POST['Telefono'],$_POST['Correo'],
									$_POST['Usuario'],$_POST['idUsuario']);
	echo$result;
}
elseif($action == 'EliminarUsuario')
{
	$result = $objeto->EliminarUsuario($_POST['idUsuario']);
	echo$result;
}
elseif($action == 'ObtenerFondosAsignados')
{
	$result = $objeto->ObtenerFondosAsignados($_POST['idUsuario']);
	//echo var_dump(mysql_fetch_array($result));
	while ( $var = mysql_fetch_array($result)) {
		$filas .= "
		<tr> 
				<td>".$var['nombre']."</td>
				<td>".$var['saldoactual']."</td>
				<td>".$var['ncuotas']."</td>
				<td><a href=# onclick='EliminarFondoUsuario(".$var['Fondos_idFondos'].",".$var['Usuarios_idUsuarios'].")'>
					<i class='fa fa-trash'> </i>
				</a>
				</td>
		</tr>
		";
	}
	echo$filas;
}

elseif($action == 'EliminarFondoUsuario')
{
	$result = $objeto->EliminarFondoUsuario($_POST['idUsuario'],$_POST['idFondo']);
	//echo var_dump(mysql_fetch_array($result));
	echo$result;
}
elseif($action == 'AgregarFondoUsuario')
{
	$result = $objeto->AgregarFondoUsuario($_POST['idUsuario'],$_POST['idFondo'],$_POST['NumeroCuotas']);
	echo$result;
}
else{	
	echo "No se ejecuto lo solicitado";
}
?>