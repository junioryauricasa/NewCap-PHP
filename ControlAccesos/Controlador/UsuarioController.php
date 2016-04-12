<?php
//session_start();
include ('../Modelo/Usuario.class.php');
include ('../Modelo/Custodio.class.php');
include ('../Modelo/Fondo.class.php');
include ('../Modelo/Ejecutivo.class.php');
$objeto = new Usuario();
$usuario = new Usuario();
$Fondo = new Fondo();
$Custodio = new Custodio();
$Ejecutivo = new Ejecutivo();

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

elseif($action == 'EditarUsuarioComision')
{
	$result = $objeto->EditarUsuarioComision($_POST['Nombres'],$_POST['Apellidos'],$_POST['Direccion'],
									$_POST['DNI'],$_POST['Telefono'],$_POST['Correo'],
									$_POST['Usuario'],$_POST['Password'],$_POST['idUsuario'],$_POST['Estadoaccion'],
									$_POST['Custodio'],$_POST['Ncr'],$_POST['Ejecutivo1'],
									$_POST['Clearing'],$_POST['Ejecutivo2'],$_POST['Total'],
									$_POST['Ejecutivo3'],$_POST['Minimo'],$_POST['Codigo'],
									$_POST['EjecutivoSaldo1'],$_POST['EjecutivoSaldo2'],$_POST['EjecutivoSaldo3']);
	echo$result;
}

elseif($action == 'EliminarUsuario')
{
	$result = $objeto->EliminarUsuario($_POST['idUsuario']);
	echo$result;
}
elseif($action == 'EliminarUsuario2')
{
	$result = $objeto->EliminarUsuario2($_POST['idUsuario']);
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
elseif($action == 'ObtenerDatosUsuario'){
	$idUsuario = $_POST['idUsuario'];
	
	$query="select b.idEjecutivos,b.nombre,a.comision,a.estado  from usuarios_ejecutivos a left join ";
	$query.="ejecutivos b on a.idEjecutivos= b.idEjecutivos where idUsuarios = ".$idUsuario."  and a.estado = 1";

	$arreglo = mysql_query($query);
	
	/*
	$queryUser="select a.idUsuarios,a.codigo,b.nc,b.clearing, b.total, b.minimo, c.idCustodios,c.nombre as custodio, a.accionario, ";
	$queryUser.="a.nombres,a.apellidos,a.direccion,a.dni,a.telefono, a.correo,a.usuario,a.password from usuarios a inner join ";
	$queryUser.="usuarios_valores b inner join custodios c on a.idUsuarios = b.idUsuarios and a.idCustodio = c.idCustodios ";
	$queryUser.="where a.idUsuarios = ".$idUsuario." and a.estado = 1 ";
	*/
	$queryUser= "select f.idUsuarios,f.codigo,f.nc,f.clearing, f.total, f.minimo, f.idCustodio,  f.accionario,
 f.nombres,f.apellidos,f.direccion,f.dni,f.telefono, f.correo,f.usuario,f.password, c.nombre as custodio from ( select a.idUsuarios,a.codigo,b.nc,b.clearing, b.total, b.minimo, a.idCustodio,  a.accionario,";
	$queryUser.="		a.nombres,a.apellidos,a.direccion,a.dni,a.telefono, a.correo,a.usuario,a.password from usuarios a inner join ";
	$queryUser.="		usuarios_valores b on a.idUsuarios = b.idUsuarios where a.idUsuarios =  ".$idUsuario.") f ";
	$queryUser.="		left join custodios c on f.idCustodio = c.idCustodios";

	$arregloUser = mysql_query($queryUser );
	$dusuario = mysql_fetch_array ( $arregloUser )

	//$idUsuario y de que distrito eres mi estimada Yaneth
	?>
	
	
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"
							aria-hidden="true" onclick="refresh()">&times;</button>
						<h4 class="modal-title">
							<span class="fa fa-user-plus"></span><label id="lblTitulo">
							
							Editar Valores de usuario</label>
						</h4>
					</div>
					<div class="modal-body" style="padding-bottom: 0px !important;">
						<div id="idMensajeD"></div>
						<!-- FORM -->
						<form class="bs-example form-horizontal u-action-error">
						
										
						
							<div class="form-group">
								<label for="inputEmail1" class="col-lg-2 control-label">Nombres:</label>
								<div class="col-lg-4">
									<input type="text" id="txtNombresE" class="form-control" value ="<?php echo $dusuario['nombres'] ?>">
								</div>
								<label for="inputEmail1" class="col-lg-2 control-label">Apellidos:</label>
								<div class="col-lg-4">
									<input type="text" id="txtApellidosE" class="form-control" value ="<?php echo $dusuario['apellidos'] ?>">
								</div>
							</div>	
							<div class="form-group">
								<label for="inputEmail1" class="col-lg-2 control-label">Direccion:</label>
								<div class="col-lg-4">
									<input type="text" id="txtDireccionE" class="form-control" value ="<?php echo $dusuario['direccion'] ?>">
								</div>
								<label for="inputEmail1" class="col-lg-2 control-label">DNI:</label>
								<div class="col-lg-4">
									<input type="text" id="txtDNIE" class="form-control" value ="<?php echo $dusuario['dni'] ?>">
								</div>
							</div>	
							<div class="form-group">
								<label for="inputEmail1" class="col-lg-2 control-label">Telefono:</label>
								<div class="col-lg-4">
									<input type="text" id="txtTelefonoE" class="form-control" value ="<?php echo $dusuario['telefono'] ?>">
								</div>
								<label for="inputEmail1" class="col-lg-2 control-label">Correo:</label>
								<div class="col-lg-4">
									<input type="text" id="txtCorreoE" class="form-control"  value ="<?php echo $dusuario['correo'] ?>">
								</div>
							</div>	
							<div class="form-group">
								<label for="inputEmail1" class="col-lg-2 control-label">Usuario:</label>
								<div class="col-lg-4">
									<input type="text" id="txtUsuarioE" class="form-control"  value ="<?php echo $dusuario['usuario'] ?>">
								</div>
								<label for="inputEmail1" class="col-lg-2 control-label">Password:</label>
								<div class="col-lg-4">
									<input type="text" id="txtPasswordE" class="form-control" value ="<?php echo $dusuario['password'] ?>">
								</div>
							</div>	

						

							<!-- Capa a ocultar  -->
							<input type="hidden" id="txtUsuarioE" value="<?php echo $idUsuario ?>" >
							<div class="form-group">
								<label for="inputEmail1" class="col-lg-2 control-label">Accionario:</label>
								<div class="col-lg-4">
									<input type="checkbox" id="txtAccionE" value="1" 
									<?php 
									if($dusuario['accionario']==1){
									?>
									checked="checked"
									<?php } ?> onchange="ValoresAccionesE()">
									
									<input type="hidden" id="txtEstadoAccionE" value="0" >	
									
								</div>
							</div>	
							<div class="form-group">
								<label for="inputEmail1" class="col-lg-2 control-label">Custodio:</label>
								<div class="col-lg-4">
									<select id="txtCustodioE" class="form-control">
									<option value="0"  selected>Seleccionar</option>
									<?php 
									if(!(empty($dusuario['idCustodio']))){
									?>
									<option value="<?php echo $dusuario['idCustodio']; ?>"  selected><?php echo $dusuario['custodio']; ?></option>
									<?php
									}
									$query = $Custodio->ObtenerCustodios();
									//echo $query;
									while ( $var = mysql_fetch_array ( $query ) ) {
										$i ++;
									?>	
										<option value="<?php echo$var['idCustodios']; ?>"><?php echo$var['nombre']; ?></option>
									<?php }?>
									</select>
								</div>			
								<label for="inputEmail1" class="col-lg-2 control-label">Codigo:</label>
								<div class="col-lg-4">
									<input type="text" id="txtCodigoE" class="form-control" value="<?php echo $dusuario['codigo']; ?>">
								</div>
							</div>	
							<div class="form-group">
								<label for="inputEmail1" class="col-lg-2 control-label">Ejecutivo1:</label>
								<div class="col-lg-4">
									<select id="txtEjecutivo1E" class="form-control" >
									<option value="0"  selected>Seleccionar</option>
									<?php 
									$xvar = mysql_fetch_array($arreglo);
									if(!(empty($xvar['idEjecutivos']))){
									?>
									<option value="<?php echo $xvar['idEjecutivos']; ?>"  selected><?php echo $xvar['nombre']; ?></option>
									<?php
									}
									$query = $Ejecutivo->ObtenerEjecutivos();
									//echo $query;
									while ( $var = mysql_fetch_array ( $query ) ) {
										$i ++;
									?>	
										<option value="<?php echo$var['idEjecutivos']; ?>"><?php echo$var['nombre']; ?></option>
									<?php }?>
									</select>
								</div>
								<label for="inputEmail1" class="col-lg-2 control-label">Comision</label>
								<div class="col-lg-4">
									<input type="text" id="txtEjecutivo1ESaldo" class="form-control"  value="<?php echo $xvar['comision']; ?>" style="width:70px">
								</div>
								
								
							</div>	
							<div class="form-group">
								<label for="inputEmail1" class="col-lg-2 control-label">Ejecutivo2:</label>
								<div class="col-lg-4">
									<select id="txtEjecutivo2E" class="form-control">
									<option value="0"  selected>Seleccionar</option>
									<?php 
									$xvar = mysql_fetch_array($arreglo);
									if(!(empty($xvar['idEjecutivos']))){
									?>
									<option value="<?php echo $xvar['idEjecutivos']; ?>"   selected><?php echo $xvar['nombre']; ?></option>
									
									<?php
									}
									$query = $Ejecutivo->ObtenerEjecutivos();
									//echo $query;
									while ( $var = mysql_fetch_array ( $query ) ) {
										$i ++;
									?>	
										<option value="<?php echo$var['idEjecutivos']; ?>"><?php echo$var['nombre']; ?></option>
									<?php }?>
									</select>
								</div>
									<label for="inputEmail1" class="col-lg-2 control-label">Comision</label>
									<div class="col-lg-4">
									<input type="text" id="txtEjecutivo2ESaldo" class="form-control"  value="<?php echo $xvar['comision']; ?>" style="width:70px">
									</div>
							</div>	
							<div class="form-group">
								<label for="inputEmail1" class="col-lg-2 control-label">Ejecutivo3:</label>
								<div class="col-lg-4">
									<select id="txtEjecutivo3E" class="form-control">
									<option value="0"  selected>Seleccionar</option>
									<?php 
									$xvar = mysql_fetch_array($arreglo);
									if(!(empty($xvar['idEjecutivos']))){
									?>
									
									<option value="<?php echo $xvar['idEjecutivos']; ?>"  selected><?php echo $xvar['nombre']; ?></option>
									
									<?php
									}
									$query = $Ejecutivo->ObtenerEjecutivos();
									//echo $query;
									while ( $var = mysql_fetch_array ( $query ) ) {
										$i ++;
									?>	
										<option value="<?php echo$var['idEjecutivos']; ?>"><?php echo$var['nombre']; ?></option>
									<?php }?>
									</select>
								</div>
								<label for="inputEmail1" class="col-lg-2 control-label">Comision</label>
									<div class="col-lg-4">
									<input type="text" id="txtEjecutivo3ESaldo" class="form-control"  value="<?php echo $xvar['comision']; ?>" style="width:70px">
								</div>
							</div>	
							<div class="form-group">
								<label for="inputEmail1" class="col-lg-2 control-label">NC:</label>
								<div class="col-lg-4">
									<input type="text" id="txtNcE" class="form-control"  value="<?php echo $dusuario['nc']; ?>" onchange="CalcularTotal()">
								</div>
								<label for="inputEmail1" class="col-lg-2 control-label">Clearing:</label>
								<div class="col-lg-4">
									<input type="text" id="txtClearingE" class="form-control"  value="<?php echo $dusuario['clearing']; ?>"  onchange="CalcularTotal()">
								</div>		
							</div>	
							<div class="form-group">
								<label for="inputEmail1" class="col-lg-2 control-label">Total:</label>
								<div class="col-lg-4">
									<input type="text" id="txtTotalE" class="form-control"  value="<?php echo $dusuario['total']; ?>" readonly>
								</div>				
								<label for="inputEmail1" class="col-lg-2 control-label">Minimo:</label>
								<div class="col-lg-4">
									<input type="text" id="txtMinimoE" class="form-control" value="<?php echo $dusuario['minimo']; ?>">
								</div>			
							</div>	

							
							<!--

							-->
							<!-- Fin de capa a ocultar -->

							
							<!-- /FORM -->
					
					</div>
					<div class="modal-footer">
						<input type="hidden" id="txtAccion" value="Registro"> <input
							type="hidden" id="txtIdentSolicitud" /> <input type="hidden"
							id="hdnEquipo">
							
						<table align="right">
							<tr>
								<td>&nbsp;&nbsp;</td>
								<td>
									<button class="btn btn-primary" type="button"
										onclick="EditarUsuarioComision()">
										<span class="fa fa-save"></span> Guardar
									</button>
								</td>
								<td>&nbsp;&nbsp;</td>
								<td>
									<button data-dismiss="modal" class="btn btn-default" type="button"
										onclick="refresh()">
										<span class="fa fa-close"></span>Cerrar
									</button>
								</td>
							</tr>
						</table>	
						
						
						</form>					
					</div>
				</div>
				<!-- /.modal-content -->
			</div>

	<?php
	
}
else{	
	echo "No se ejecuto lo solicitado";
}
?>