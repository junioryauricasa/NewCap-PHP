<?php
require_once 'conexion.class.php';

class Usuario{

	private $idUsuario;
	private $nombres;
	private $apellidos;
	private $direccion;
	private $dni;
	private $telefono;
	private $correo;
	private $usuario;
	private $password;
	private $estado;
	private $TipoUsuario;

	public function getIdUsuario() {
    	return $this->idUsuario;
    }
    public function setIdUsuario($idUsuario) {
    	$this->idUsuario = $idUsuario;
    }

    public function getNombres() {
    	return $this->nombres;
    }
    public function setNombres($nombres) {
    	$this->nombres = $nombres;
    }

    public function getApellidos() {
    	return $this->apellidos;
    }
    public function setApellidos($apellidos) {
    	$this->apellidos = $apellidos;
    }

    public function getDireccion() {
    	return $this->direccion;
    }
    public function setDireccion($direccion) {
    	$this->direccion = $direccion;
    }

    public function getDNI() {
    	return $this->dni;
    }
    public function setDNI($dni) {
    	$this->dni = $dni;
    }

    public function getTelefono() {
    	return $this->telefono;
    }
    public function setTelefono($telefono) {
    	$this->telefono = $telefono;
    }

    public function getCorreo() {
    	return $this->correo;
    }
    public function setCorreo($correo) {
    	$this->correo = $correo;
    }

    public function getUsuario() {
    	return $this->usuario;
    }
    public function setUsuario($usuario) {
    	$this->usuario = $usuario;
    }

    public function getPassword() {
    	return $this->password;
    }
    public function setPassword($password) {
    	$this->password = $password;
    }

    public function getEstado() {
    	return $this->estado;
    }
    public function setEstado($estado) {
    	$this->estado = $estado;
    }

    public function getTipoUsuario() {
    	return $this->TipoUsuario;
    }
    public function setTipoUsuario($TipoUsuario) {
    	$this->TipoUsuario = $TipoUsuario;
    }

	function __construct() {
		$this->con = new DBManager();
		$this->con->conectar();
	}
	/*function obtenerUsuario($dato){
		$this->con->conectar();
		$query = "SELECT usuario,nombre,cargo FROM usuario 
				where usuario like '%".$dato."%' or nombre like '%".$dato."%' or cargo like '%".$dato."%';";
		$arreglo = mysql_query($query);
        return $arreglo;
	}*/

	function ValidarUsuario($usuario,$password){
		$this->con->conectar ();
		//$consulta = "SELECT * FROM usuarios where usuario ='" . $usuario . "' and password=" . $pass . "";
		$consulta = "SELECT * FROM usuarios where usuario = '" .$usuario."' and password = '".$password."' and estado = 1";
		//echo var_dump($consulta);
		$query = mysql_query ( $consulta );
		return $query;
	}

	function ObtenerBandejaUsuarios($idUsuario,$usuario,$dni)
	{
		$this->con->conectar(); 

		$query="SELECT * FROM usuarios where 1=1 ";

        if(!empty($idUsuario))
        {
            $query.="and idUsuario = ".$idUsuario."";
        }

		if(!empty($usuario))
		{
			$query.="and usuario LIKE '%".$usuario."%'";
		}

		if(!empty($dni))
		{
			$query.="and dni = '".$dni."'";
		}

		$arreglo = mysql_query($query);
		//echo var_dump($query);  
    	return $arreglo;	
	}
function ObtenerBandejaUsuariosAcciones($idUsuario,$usuario,$dni)
	{
		$this->con->conectar(); 

		$query="SELECT * FROM usuarios where accionario=1 ";

        if(!empty($idUsuario))
        {
            $query.="and idUsuario = ".$idUsuario."";
        }

		if(!empty($usuario))
		{
			$query.="and usuario LIKE '%".$usuario."%'";
		}

		if(!empty($dni))
		{
			$query.="and dni = '".$dni."'";
		}

		$arreglo = mysql_query($query);
		//echo var_dump($query);  
    	return $arreglo;	
	}
    function ObtenerUsuario($idUsuario)
    {
        $this->con->conectar(); 
        //echo var_dump($dni);  
        //echo var_dump($query);  
        if(!empty($idUsuario))
        {
            $query="SELECT * FROM usuarios where 1=1 ";
            $query.="and idUsuarios = ".$idUsuario."";
        }
        $arreglo = mysql_query($query);
        //echo var_dump($query);  
        return $arreglo;    
    }

    function CrearUsuario($Nombres,$Apellidos,$Direccion,$DNI
                          ,$Telefono,$Correo,$Usuario,$Password,$estadoaccion,
						  $custodio,$ncr,$ejecutivo1,$clearing,$ejecutivo2,$total,$ejecutivo3,$minimo,$codigo,
    					  $ejecutivo1Comision1,$ejecutivo1Comision2,$ejecutivo1Comision3)
    {
        $this->con->conectar(); 

        if($estadoaccion=="0"){
		
			$query = "insert into usuarios(codigo,nombres,apellidos,direccion,dni,telefono,correo,usuario,password,estado,TipoUsuario,accionario,idCustodio)
					values('0', '".$Nombres."', '".$Apellidos."', '".$Direccion."', '".$DNI."'
						  ,'".$Telefono."', '".$Correo."', '".$Usuario."', '".$Password."',1,2,0,0)";
			mysql_query($query);
			
			$registroinicial = mysql_insert_id();
			
			$query2 = "insert into usuarios_valores(idUsuarios,nc,clearing,total,minimo,estado)
					values('".$registroinicial."', '0', '0', '0'
						  ,'0',1)";
			mysql_query($query2);
			
			if($ejecutivo1!="0"){
				$query3 = "insert into usuarios_ejecutivos(idUsuarios,idEjecutivos,comision,minima,estado)
					values('".$registroinicial."', '".$ejecutivo1."', '".$ejecutivo1Comision1."', '0',1)";
				mysql_query($query3);
			}else{
				$query3 = "insert into usuarios_ejecutivos(idUsuarios,idEjecutivos,comision,minima,estado)
					values('".$registroinicial."', '0', '0', '0',1)";
				mysql_query($query3);
			}
			if($ejecutivo2!="0"){
			
				$query3 = "insert into usuarios_ejecutivos(idUsuarios,idEjecutivos,comision,minima,estado)
					values('".$registroinicial."', '".$ejecutivo2."', '".$ejecutivo1Comision2."', '0',1)";
				mysql_query($query3);
			}else{
				$query3 = "insert into usuarios_ejecutivos(idUsuarios,idEjecutivos,comision,minima,estado)
					values('".$registroinicial."', '0', '0', '0',1)";
				mysql_query($query3);
			}
				
			if($ejecutivo3!="0"){
			
				$query3 = "insert into usuarios_ejecutivos(idUsuarios,idEjecutivos,comision,minima,estado)
					values('".$registroinicial."', '".$ejecutivo3."', '".$ejecutivo1Comision3."', '0',1)";
				mysql_query($query3);
			}else{
				$query3 = "insert into usuarios_ejecutivos(idUsuarios,idEjecutivos,comision,minima,estado)
					values('".$registroinicial."', '0', '0', '0',1)";
				mysql_query($query3);
			}
			
			$query4 = "insert into estadocuenta(idCliente,saldoActual)
					values('".$registroinicial."',0)";
			mysql_query($query4);
			
			$var = $registroinicial;
			
		}else{
			
			$query = "insert into usuarios(codigo,nombres,apellidos,direccion,dni,telefono,correo,usuario,password,estado,TipoUsuario,accionario,idCustodio)
					values('".$codigo."', '".$Nombres."', '".$Apellidos."', '".$Direccion."', '".$DNI."'
						  ,'".$Telefono."', '".$Correo."', '".$Usuario."', '".$Password."',1,2,1,$custodio)";
			mysql_query($query);
			
			$registroinicial = mysql_insert_id();
			$query2 = "insert into usuarios_valores(idUsuarios,nc,clearing,total,minimo,estado)	
					values('".$registroinicial."', '".$ncr."', '".$clearing."', '".$total."'
						  ,'".$minimo."',1)";
			mysql_query($query2);	
			
			if($ejecutivo1!="0"){
			$query3 = "insert into usuarios_ejecutivos(idUsuarios,idEjecutivos,comision,minima,estado)	
					values('".$registroinicial."', '".$ejecutivo1."', '".$ejecutivo1Comision1."', '0',1)";
			mysql_query($query3);
			}else{
				$query3 = "insert into usuarios_ejecutivos(idUsuarios,idEjecutivos,comision,minima,estado)
					values('".$registroinicial."', '0', '0', '0',1)";
				mysql_query($query3);
			}
			if($ejecutivo2!="0"){
				
			$query3 = "insert into usuarios_ejecutivos(idUsuarios,idEjecutivos,comision,minima,estado)	
					values('".$registroinicial."', '".$ejecutivo2."', '".$ejecutivo1Comision2."', '0',1)";
			mysql_query($query3);
			}else{
				$query3 = "insert into usuarios_ejecutivos(idUsuarios,idEjecutivos,comision,minima,estado)
					values('".$registroinicial."', '0', '0', '0',1)";
				mysql_query($query3);
			}
			
			if($ejecutivo3!="0"){
				
			$query3 = "insert into usuarios_ejecutivos(idUsuarios,idEjecutivos,comision,minima,estado)	
					values('".$registroinicial."', '".$ejecutivo3."', '".$ejecutivo1Comision3."', '0',1)";
			mysql_query($query3);
			}else{
				$query3 = "insert into usuarios_ejecutivos(idUsuarios,idEjecutivos,comision,minima,estado)
					values('".$registroinicial."', '0', '0', '0',1)";
				mysql_query($query3);
			}
			
			$query4 = "insert into estadocuenta(idCliente,saldoActual)	
					values('".$registroinicial."',0)";
			mysql_query($query4);
				
			$var = $registroinicial;
				
			
		}	
			
		return  $var;	
    }

    function EditarUsuario($Nombres,$Apellidos,$Direccion,$DNI
                          ,$Telefono,$Correo,$Usuario,$idUsuario)
    {
        $this->con->conectar(); 

        $query = "update usuarios set nombres='".$Nombres."',
                                      apellidos='".$Apellidos."', 
                                      direccion='".$Direccion."', 
                                      dni='".$DNI."',
                                      telefono='".$Telefono."',
                                      correo='".$Correo."',
                                      usuario='".$Usuario."'
                                      where idUsuarios =".$idUsuario."";
        //echo var_dump($query);                              
        mysql_query($query);
            $var = mysql_insert_id();
            return  $var;
    }
    function EditarUsuarioComision($Nombres,$Apellidos,$Direccion,$DNI
                          ,$Telefono,$Correo,$Usuario,$Password,$idUsuario,$estadoaccion,
						  $custodio,$ncr,$ejecutivo1,$clearing,$ejecutivo2,$total,$ejecutivo3,$minimo,$codigo,
    					  $ejecutivo1Comision1,$ejecutivo1Comision2,$ejecutivo1Comision3)
    {
    	$this->con->conectar();
    	
    	if($estadoaccion==1){
    		$query = "update usuarios set accionario='1',
    								  nombres='".$Nombres."',
                                      apellidos='".$Apellidos."', 
                                      direccion='".$Direccion."', 
                                      dni='".$DNI."',
                                      telefono='".$Telefono."',
                                      correo='".$Correo."',
                                      usuario='".$Usuario."',
                                      password='".$Password."',		
    								  codigo='".$codigo."' ,
                                      idCustodio='".$custodio."' 
                                      where idUsuarios =".$idUsuario."";
    		mysql_query($query);
    	}else{
    		$query = "update usuarios set accionario='0',
    								  nombres='".$Nombres."',
                                      apellidos='".$Apellidos."', 
                                      direccion='".$Direccion."', 
                                      dni='".$DNI."',
                                      telefono='".$Telefono."',
                                      correo='".$Correo."',
                                      usuario='".$Usuario."',
                                      password='".$Password."',	
                                      idCustodio='".$custodio."',
                                      codigo='".$codigo."'
                                      where idUsuarios =".$idUsuario."";
    		mysql_query($query);
    	}
    
    	$query = "update usuarios_valores set  nc='".$ncr."',
                                      			clearing='".$clearing."',
                                      			total='".$total."',
                                      			minimo='".$minimo."'
                                      			where idUsuarios =".$idUsuario."";
    	mysql_query($query);
    	
    	$query = "update usuarios_ejecutivos set  estado='0'
                                      			where idUsuarios =".$idUsuario."";
    	
    	mysql_query($query);
    	
    	if($ejecutivo1!="0"){
    		$query3 = "insert into usuarios_ejecutivos(idUsuarios,idEjecutivos,comision,minima,estado)
					values('".$idUsuario."', '".$ejecutivo1."', '".$ejecutivo1Comision1."', '0',1)";
    		mysql_query($query3);
    	}else{
    		$query3 = "insert into usuarios_ejecutivos(idUsuarios,idEjecutivos,comision,minima,estado)
					values('".$idUsuario."', '0', '0', '0',1)";
    		mysql_query($query3);
    	}
    	if($ejecutivo2!="0"){
    	
    		$query3 = "insert into usuarios_ejecutivos(idUsuarios,idEjecutivos,comision,minima,estado)
					values('".$idUsuario."', '".$ejecutivo2."', '".$ejecutivo1Comision2."', '0',1)";
    		mysql_query($query3);
    	}else{
    		$query3 = "insert into usuarios_ejecutivos(idUsuarios,idEjecutivos,comision,minima,estado)
					values('".$idUsuario."', '0', '0', '0',1)";
    		mysql_query($query3);
    	}
    		
    	if($ejecutivo3!="0"){
    	
    		$query3 = "insert into usuarios_ejecutivos(idUsuarios,idEjecutivos,comision,minima,estado)
					values('".$idUsuario."', '".$ejecutivo3."', '".$ejecutivo1Comision3."', '0',1)";
    		mysql_query($query3);
    	}else{
    		$query3 = "insert into usuarios_ejecutivos(idUsuarios,idEjecutivos,comision,minima,estado)
					values('".$idUsuario."', '0', '0', '0',1)";
    		mysql_query($query3);
    	}

    	return  $var;
    }
    function EliminarUsuario($idUsuario)
    {
        $this->con->conectar(); 

        $query = "update usuarios set estado = 0  where idUsuarios =".$idUsuario."";                    
        mysql_query($query);
            $var = mysql_insert_id();
            return  $var;
    }

    function ObtenerFondosAsignados($idUsuario)
    {
        $this->con->conectar(); 

        $query="SELECT UF.*, F.nombre , F.valorCuota FROM usuarios_fondos UF 
                JOIN fondos F ON UF.Fondos_idFondos = F.idFondos
                WHERE UF.estado = 1 AND UF.Usuarios_idUsuarios = ".$idUsuario;

        $arreglo = mysql_query($query);
        //echo var_dump($arreglo);
        return $arreglo;    
    }

    function EliminarFondoUsuario($idUsuario,$idFondo)
    {
        $this->con->conectar(); 

        $query="UPDATE usuarios_fondos SET estado = 0 where Usuarios_idUsuarios = ".$idUsuario."
                AND Fondos_idFondos= ".$idFondo." ";

        $arreglo = mysql_query($query);
        return $arreglo;    
    }

    function AgregarFondoUsuario($idUsuario,$idFondo,$NumeroCuotas)
    {
        $this->con->conectar(); 

        $query1="SELECT UF.*, F.nombre , F.valorCuota FROM usuarios_fondos UF 
                JOIN fondos F ON UF.Fondos_idFondos = F.idFondos
                WHERE UF.estado = 1 AND UF.Usuarios_idUsuarios = ".$idUsuario." 
                AND UF.Fondos_idFondos = ".$idFondo."";
        //echo var_dump($query1);        
        $arreglo = mysql_query($query1);
        $num = mysql_num_rows($arreglo);
        if($num <= 0)
        {
            $query = "INSERT INTO usuarios_fondos(Usuarios_idUsuarios,Fondos_idFondos,ncuotas,saldoactual,estado)
                values(".$idUsuario.",".$idFondo.",".$NumeroCuotas.",0,1)";
            $result2 = mysql_query($query);
            return 1;
        }
        else
        {
            return 2;
        }
    }

    function ObtenerRentabilidad($idFondo,$idUsuario)
    {
        $queryActual ="SELECT * FROM historialvalorcuota
                    where Fondos_idFondos = ".$idFondo."
                    ORDER BY fecha DESC
                    LIMIT 1";

        $queryPrimero ="SELECT * FROM historialvalorcuota
                    where Fondos_idFondos = ".$idFondo."
                    ORDER BY fecha ASC
                    LIMIT 1";

        $queryNcuotas = "SELECT UF.*, F.nombre , F.valorCuota FROM usuarios_fondos UF 
                JOIN fondos F ON UF.Fondos_idFondos = F.idFondos
                WHERE UF.estado = 1 AND UF.Usuarios_idUsuarios = ".$idUsuario. "
                AND UF.Fondos_idFondos = ".$idFondo."";

        $arregloActual = mysql_query($queryActual);
        $arregloPrimero = mysql_query($queryPrimero);
        $arregloNcuotas = mysql_query($queryNcuotas);
        $num1 = mysql_num_rows($arregloActual);
        $num2 = mysql_num_rows($arregloPrimero);
        $num3 = mysql_num_rows($arregloNcuotas);

        if($num1 >= 0 && $num2 >= 0 && $num3 >= 0)
        {
            while ( $var = mysql_fetch_array($arregloActual)) {
                $VCA = $var['valorcuota'];
            }
            while ( $var2 = mysql_fetch_array($arregloPrimero)) {
                $VCI = $var2['valorcuota'];
            }
            while ( $var3 = mysql_fetch_array($arregloNcuotas)) {
                $NC = $var3['ncuotas'];
            }
            $VCT = floatval($VCA) - floatval($VCI);
            $VCT = floatval($VCT) * floatval($NC);
        }
        return $VCT;
    }
}