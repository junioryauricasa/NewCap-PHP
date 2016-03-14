<?php
require_once 'conexion.class.php';

class reporteEjecutivo{

	function __construct() {
		$this->con = new DBManager();
		$this->con->conectar();
	}
	function ObtenerreporteEjecutivo($idEjecutivo,$fechainicio,$fechafin)
	{
		$this->con->conectar();
		
		$query="SELECT b.fechaCarga,(select descripcion from activo WHERE idActivo=b.idActivo) as activo,
		precio,cantidad,a.comision, (precio*cantidad*comision) as Comision FROM usuarios_ejecutivos a 
		inner join operacionesacciones b on a.idUsuarios = b.idCliente
		where 1 = 1 ";

		if(!empty($idEjecutivo))
		{
			$query.="and a.idEjecutivos = ".$idEjecutivo."";
		}
	
		if(!empty($fechainicio))
		{
			$query.="and b.fechaCarga BETWEEN '".$fechainicio."' and '".$fechafin."'";
		}
		
		$query.="order by b.idOperaciones desc";

		$arreglo = mysql_query($query);
		//echo var_dump($query);
		return $arreglo;
	}
	
}