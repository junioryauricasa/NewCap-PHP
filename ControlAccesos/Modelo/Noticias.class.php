<?php
require_once 'conexion.class.php';

class Noticias{

	function __construct() {
		$this->con = new DBManager();
		$this->con->conectar();
	}

    function AgregarNoticia($nombre,$descripcion,$path)
    {
        $this->con->conectar(); 

        $query="INSERT INTO noticias(fecha,nombre,imagen,descripcion,estado)
                VALUES(NOW(),'".$nombre."','".$path."','".$descripcion."',1)";
        $arreglo = mysql_query($query);
        return $arreglo;    
    }

	function ObtenerNoticias($FechaIni,$FechaFin)
	{
		$this->con->conectar();

		$query="SELECT * FROM noticias
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

    function ObtenerNoticiaDia()
    {
        $this->con->conectar();

        $query="SELECT * FROM noticias
                WHERE estado = 1 ";
        //echo var_dump($dni);
        $query.="ORDER BY fecha desc ";

        $arreglo = mysql_query($query);
        return $arreglo;
    }

	function EliminarNoticia($idNoticia)
    {
        $this->con->conectar(); 

        $query = "UPDATE noticias SET estado = 0 
        WHERE idnoticias = " .$idNoticia."";
        echo var_dump($query);

        $arreglo = mysql_query($query);

        return $arreglo;    
    }
}