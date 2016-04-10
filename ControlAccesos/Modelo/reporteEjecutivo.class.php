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
		
		$query="select a.idComision,a.idEjecutivo,a.idCliente,a.fecha,b.nombre,a.comision from comisiones a inner join 
				ejecutivos b on a.idEjecutivo= b.idEjecutivos
				where 1 = 1 ";

		if(!empty($idEjecutivo))
		{
			$query.="and a.idEjecutivo = ".$idEjecutivo."";
		}
	
		if(!empty($fechainicio))
		{
			$query.=" and b.fecha BETWEEN '".$fechainicio."' and '".$fechafin."'";
		}
		
		$query.=" order by a.idComision desc";

		$arreglo = mysql_query($query);
		//echo var_dump($query);
		return $arreglo;
	}
	function ObtenerreporteComisiones($idCliente,$fechainicio,$fechafin)
	{
		$this->con->conectar();
		
		$query="select a.idOperaciones,a.fechaCarga,a.comision, a.idCliente, b.usuario from operacionesacciones a inner join
		usuarios b on a.idCliente=b.idUsuarios where 1 = 1 ";

	
		if(!empty($idCliente))
		{
			$query.="and b.usuario = ".$idCliente."";
		}
	
		if(!empty($fechainicio))
		{
			$query.=" and a.fechacarga BETWEEN '".$fechainicio."' and '".$fechafin."'";
		}
	
		$query.=" order by a.idOperaciones desc";
	
		$arreglo = mysql_query($query);
		//echo var_dump($query);
		return $arreglo;
	}
}