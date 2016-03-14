<?php
require_once 'conexion.class.php';

class Fichero{

	function __construct() {
		$this->con = new DBManager();
		$this->con->conectar();
	}

    function AgregarFichero($nombre,$descripcion,$path)
    {
        $this->con->conectar(); 

        $query="INSERT INTO ficheros(fecha,Nombre,Link,descripcion,estado)
                VALUES(NOW(),'".$nombre."','".$path."','".$descripcion."',1)";
        $arreglo = mysql_query($query);
        return $arreglo;    
    }

	function ObtenerFicheros($FechaIni,$FechaFin)
	{
		$this->con->conectar(); 

		$query="SELECT * FROM ficheros
                WHERE estado = 1 ";
        //echo var_dump($dni);
        if(!empty($FechaIni) && !empty($FechaFin))
        {
            $query.=" AND fecha BETWEEN '".$FechaIni."' AND '".$FechaFin."'";
        }        
        $query.="ORDER BY fecha desc";
		$arreglo = mysql_query($query);
    	return $arreglo;	
	}

    function ObtenerFicherosClientes($FechaIni,$FechaFin)
    {
        $this->con->conectar(); 

        $query="SELECT * FROM ficheros
                WHERE estado = 1 ";
        //echo var_dump($dni);
        if(!empty($FechaIni) && !empty($FechaFin))
        {
            $query.=" AND fecha BETWEEN '".$FechaIni."' AND '".$FechaFin."'";
        }        
        $query.="ORDER BY fecha";
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