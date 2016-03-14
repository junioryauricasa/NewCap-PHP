<?php
require_once 'conexion.class.php';

class Clientes{

	function __construct() {
		$this->con = new DBManager();
		$this->con->conectar();
	}

	function ObtenerOperacione($idUsuario)
	{
		$this->con->conectar(); 

		$query="SELECT 
                    O.fecha,
                    F.nombre,
                    O.tipo,
                    O.cantidad,
                    O.NcuotasAgregado,
                    F.idFondos
                FROM operaciones O
                    JOIN fondos F ON O.Fondos_idFondos = F.IDFONDOS
                    JOIN usuarios U ON O.Usuarios_idUsuarios = U.idUsuarios
                    JOIN usuarios_fondos UF ON UF.Usuarios_idUsuarios = U.idUsuarios and UF.Fondos_idFondos = F.IDFONDOS
                    WHERE 1= 1
                    AND O.ESTADO = 1 
                    AND F.ESTADO = 1
                    AND U.ESTADO = 1
                    AND UF.ESTADO = 1
                    AND UF.Usuarios_idUsuarios = ".$idUsuario." ";
        //echo var_dump($dni);    
        $query.="ORDER BY O.fecha DESC";
		$arreglo = mysql_query($query);
    	return $arreglo;	
	}

    function ObtenerOperacioneAporteFondo($idFondos)
    {
        $this->con->conectar(); 

        $query="SELECT 
                    O.fecha,
                    F.nombre,
                    O.tipo,
                    O.cantidad,
                    O.NcuotasAgregado,
                    F.idFondos
                FROM operaciones O
                    JOIN fondos F ON O.Fondos_idFondos = F.IDFONDOS
                    JOIN usuarios U ON O.Usuarios_idUsuarios = U.idUsuarios
                    JOIN usuarios_fondos UF ON UF.Usuarios_idUsuarios = U.idUsuarios and UF.Fondos_idFondos = F.IDFONDOS
                    WHERE 1= 1
                    AND O.ESTADO = 1 
                    AND F.ESTADO = 1
                    AND U.ESTADO = 1
                    AND UF.ESTADO = 1
                    AND O.tipo = 'APORTE'
                    AND F.IDFONDOS = ".$idFondos." ";
        //echo var_dump($dni);    
        $query.=" ";
        $arreglo = mysql_query($query);
        return $arreglo;    
    }

    function ObtenerOperacioneAporte($idUsuario)
    {
        $this->con->conectar(); 

        $query="SELECT 
                    O.fecha,
                    F.nombre,
                    O.tipo,
                    O.cantidad,
                    O.NcuotasAgregado,
                    O.NcuotasActual,
                    F.idFondos
                FROM operaciones O
                    JOIN fondos F ON O.Fondos_idFondos = F.IDFONDOS
                    JOIN usuarios U ON O.Usuarios_idUsuarios = U.idUsuarios
                    JOIN usuarios_fondos UF ON UF.Usuarios_idUsuarios = U.idUsuarios and UF.Fondos_idFondos = F.IDFONDOS
                    WHERE 1= 1
                    AND O.ESTADO = 1 
                    AND F.ESTADO = 1
                    AND U.ESTADO = 1
                    AND UF.ESTADO = 1
                    AND O.tipo = 'APORTE'
                    AND UF.Usuarios_idUsuarios = ".$idUsuario." ";
        //echo var_dump($dni);    
        $query.="GROUP BY F.idFondos";
        $arreglo = mysql_query($query);
        return $arreglo;    
    }

    function ObtenerValorCuotaActual($idFondos)
    {
        $this->con->conectar(); 

        $query="SELECT F.idFondos, F.nombre, hv.valorcuota, hv.fecha 
                FROM fondos F 
                JOIN historialvalorcuota hv ON F.idFondos = hv.Fondos_idFondos 
                WHERE F.estado = 1 AND hv.fecha = (SELECT MAX(fecha) FROM historialvalorcuota 
                WHERE Fondos_idFondos = hv.Fondos_idFondos AND ESTADO = 1)
                AND F.idFondos = ".$idFondos." ";
        $query.=" GROUP BY F.IDFONDOS ";

        $arreglo = mysql_query($query);
        return $arreglo;    
    }

    function ObtenerValorFechaAporte($idFondos,$Fecha)
    {
        $this->con->conectar(); 
        $FechaCorta = substr ($Fecha , 0,10);
        $query="SELECT * FROM historialvalorcuota
                WHERE Fondos_idFondos = ".$idFondos." ";
        $query.="AND fecha BETWEEN '".$FechaCorta." 00:00:00' AND '".$FechaCorta." 23:59:59'";

        $arreglo = mysql_query($query);
        return $arreglo;    
    }

    function ObtenerGrafico($idUsuario,$idFondos,$FechaIni,$FechaFin)
    {
        $this->con->conectar(); 

        $query="SELECT DATE_FORMAT( H.fecha,'%d %b') as fecha,
                       H.valorcuota,
                       F.nombre
                FROM historialvalorcuota H
                JOIN fondos F ON F.idFondos = H.Fondos_idFondos
                JOIN usuarios_fondos UF ON UF.Fondos_idFondos = F.idFondos
                WHERE H.Estado = 1
                AND F.idFondos = ".$idFondos."
                AND UF.Usuarios_idUsuarios = ".$idUsuario." ";
        //echo var_dump($dni);
        if(!empty($FechaIni) && !empty($FechaFin))
        {
            $query.=" AND H.fecha BETWEEN '".$FechaIni."' AND '".$FechaFin."'";
        } 
        $query.="GROUP BY H.fecha,H.valorcuota,F.nombre 
                ORDER BY H.fecha ";
        $arreglo = mysql_query($query);
        return $arreglo;    
    }

	function EliminarFichero($idFichero)
    {
        $this->con->conectar(); 

        $query = "UPDATE ficheros SET estado = 0 
        WHERE idficheros = " .$idFichero."";
        echo var_dump($query);

        $arreglo = mysql_query($query);

        return $arreglo;    
    }
}