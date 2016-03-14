<?php
require_once 'conexion.class.php';

class Custodio{

	function __construct() {
		$this->con = new DBManager();
		$this->con->conectar();
	}
	function ObtenerCustodios()
	{
		$this->con->conectar(); 

		$query="SELECT idCustodios,codigo,nombre,estado
                FROM custodios
                WHERE estado=1";

		$arreglo = mysql_query($query);
    	return $arreglo;	
	}
	function CrearCustodio($CodigoCustodio,$NombreCustodio)
    {
        $this->con->conectar(); 

        $query = "insert into custodios(codigo,nombre,estado)
                values('".$CodigoCustodio."','".$NombreCustodio."',1)";
        mysql_query($query);
            $var = mysql_insert_id();
            return  $var;
    }
	
	function EliminarCustodio($idCustodio)
    {
        $this->con->conectar(); 

        $query = "UPDATE custodios SET ESTADO = 0 
        WHERE idCustodios = " .$idCustodio."";
        //echo var_dump($query);

        $arreglo = mysql_query($query);

        return $arreglo;    
    }

/*
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
	*/
}