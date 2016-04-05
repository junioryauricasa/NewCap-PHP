<?php
require_once 'conexion.class.php';

class Portafolio{

	function __construct() {
		$this->con = new DBManager();
		$this->con->conectar();
	}


	function ObtenerPortafolio($Usuario)
	{
		$this->con->conectar(); 
        $query="select a.idCliente,b.descripcion,a.cantidad from portafolios a inner join activo b on a.idActivo=b.idActivo where a.estado = 1 and a.cantidad1<>0  ";
        if(!empty($Usuario))
        {
            $query.=" AND a.idCliente LIKE '%".$Usuario."%'";
        }

        $query.=" ORDER BY a.idPortafolio DESC ";    

        $arreglo = "";
		$arreglo = mysql_query($query);
    	return $arreglo;
	}
	function obtenerCash($Usuario){
		$this->con->conectar();
		$query="select saldoActual from estadocuenta where idCliente =  ".$Usuario;
		$arreglo = "";
		$arreglo = mysql_query($query);
		return $arreglo;
	}

}