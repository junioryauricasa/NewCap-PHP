<?php
require_once 'conexion.class.php';

class Fondo{

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
	}

	function ValidarUsuario($usuario,$password){
		$this->con->conectar ();
		//$consulta = "SELECT * FROM usuarios where usuario ='" . $usuario . "' and password=" . $pass . "";
		$consulta = "SELECT * FROM usuarios where usuario = '" .$usuario."' and password = '".$password."'";
		//echo var_dump($consulta);
		$query = mysql_query ( $consulta );
		return $query;
	}*/

	function ObtenerFondos()
	{
		$this->con->conectar(); 

		$query="SELECT F.idFondos, F.nombre, hv.valorcuota, hv.fecha 
                FROM fondos F 
                JOIN historialvalorcuota hv ON F.idFondos = hv.Fondos_idFondos 
                WHERE F.estado = 1 AND hv.fecha = (SELECT MAX(fecha) FROM historialvalorcuota 
                WHERE Fondos_idFondos = hv.Fondos_idFondos AND ESTADO = 1)
                GROUP BY F.IDFONDOS ";
        //echo var_dump($dni);

		$arreglo = mysql_query($query);
    	return $arreglo;	
	}

    function ObtenerFondoUsusario($idUsuario)
    {
        $this->con->conectar(); 

        $query="SELECT F.idFondos, F.nombre, hv.valorcuota, hv.fecha 
                FROM fondos F 
                JOIN historialvalorcuota hv ON F.idFondos = hv.Fondos_idFondos 
                JOIN usuarios_fondos UF ON UF.Fondos_idFondos = F.idFondos
                WHERE F.estado = 1 
                AND hv.fecha = (SELECT MAX(fecha) FROM historialvalorcuota 
                WHERE Fondos_idFondos = hv.Fondos_idFondos AND ESTADO = 1)
                AND UF.Usuarios_idUsuarios = ".$idUsuario."
                GROUP BY F.IDFONDOS ";
        //echo var_dump($dni);

        $arreglo = mysql_query($query);
        return $arreglo;    
    }

    function ObtenerNumeroClientes($idFondo)
    {
        $this->con->conectar(); 

        $query = "SELECT count(Usuarios_idUsuarios) as NumeroClientes FROM usuarios_fondos WHERE Fondos_idFondos = " .$idFondo." AND estado = 1";
        //echo var_dump($dni);

        $arreglo = mysql_query($query);

        return mysql_fetch_array($arreglo);    
    }

    function CrearFondo($NombreFondo,$ValorCuotaInicial,$NumeroCuotas)
    {
        $this->con->conectar(); 

        $query = "insert into fondos(nombre,ncuotas,valorcuota,estado)
                values('".$NombreFondo."',".$NumeroCuotas.",".$ValorCuotaInicial.",1)";
        mysql_query($query);
            $var = mysql_insert_id();
            $query2 = "insert into historialvalorcuota(fecha,valorcuota,Fondos_idFondos,estado)
                        values( NOW(),".$ValorCuotaInicial.",".$var.",1)";
        mysql_query($query2); 
            return  $var;
    }

    function ObtenerHistorialFondo($idFondo)
    {
        $this->con->conectar(); 

        $query = "SELECT idHistorialValorCuota,
           valorcuota,
           fecha
        FROM  historialvalorcuota 
        WHERE Fondos_idFondos = " .$idFondo." AND ESTADO = 1 ORDER BY FECHA ASC";
        //echo var_dump($query);

        $arreglo = mysql_query($query);

        return $arreglo;    
    }

    function ObtenerNumeroHistorial($idFondo)
    {
        $this->con->conectar(); 

        $query = "SELECT COUNT(idHistorialValorCuota) as conteo
        FROM  historialvalorcuota 
        WHERE Fondos_idFondos = " .$idFondo." AND ESTADO = 1";
        //echo var_dump($dni);

        $arreglo = mysql_query($query);

        return mysql_fetch_array($arreglo);    
    }

    function EliminarHistorialFondo($idHistorialFondo)
    {
        $this->con->conectar(); 

        $query = "UPDATE historialvalorcuota SET ESTADO = 0 
        WHERE idHistorialValorCuota = " .$idHistorialFondo."";
        //echo var_dump($query);

        $arreglo = mysql_query($query);

        return $arreglo;    
    }

    function AgregarValorCuota($idFondo,$ValorCuota,$Fecha)
    {
        $this->con->conectar(); 

        $query = "insert into historialvalorcuota(fecha,valorcuota,Fondos_idFondos,estado)
                values('".$Fecha."',".$ValorCuota.",".$idFondo.",1)";  
        echo var_dump($query);

        $arreglo = mysql_query($query);

        return $arreglo;    
    }

    function EliminarFondo($idFondo)
    {
        $this->con->conectar(); 

        $query = "UPDATE fondos SET ESTADO = 0 
        WHERE idFondos = " .$idFondo."";
        //echo var_dump($query);

        $arreglo = mysql_query($query);

        return $arreglo;    
    }
}