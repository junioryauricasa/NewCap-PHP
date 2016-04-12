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
			$query.=" and a.fecha BETWEEN '".$fechainicio."' and '".$fechafin."'";
		}
		
		$query.=" order by a.idComision desc";
		//echo $query;
		$arreglo = mysql_query($query);
		//echo var_dump($query);
		return $arreglo;
	}
	function CountObtenerreporteEjecutivo($idEjecutivo,$fechainicio,$fechafin)
	{
		$this->con->conectar();
		$scomision=0;
	
		$query="select a.idComision,a.idEjecutivo,a.idCliente,a.fecha,b.nombre,a.comision from comisiones a inner join
				ejecutivos b on a.idEjecutivo= b.idEjecutivos
				where 1 = 1 ";
	
		if(!empty($idEjecutivo))
		{
			$query.="and a.idEjecutivo = ".$idEjecutivo."";
		}
	
		if(!empty($fechainicio))
		{
			$query.=" and a.fecha BETWEEN '".$fechainicio."' and '".$fechafin."'";
		}
	
		$query.=" order by a.idComision desc";
		//echo $query;
		$darreglo = mysql_query($query);

		while($arreglo = mysql_fetch_array($darreglo )){
			$scomision = $scomision + $arreglo['comision'];
		}
		
		//echo var_dump($query);
		return $scomision;
	}
	function ObtenerreporteComisiones($fechainicio,$fechafin)
	{
		$this->con->conectar();
		
		$query="select a.idOperaciones,a.fechaHora,a.comision, a.idCliente, b.usuario from operacionesacciones a inner join
		usuarios b on a.idCliente=b.idUsuarios where 1 = 1 ";

	
		if(!empty($idCliente))
		{
			$query.="and b.usuario = ".$idCliente."";
		}
	
		if(!empty($fechainicio))
		{
			$query.=" and a.fechaHora BETWEEN '".$fechainicio."' and '".$fechafin."'";
		}
	
		$query.=" order by a.idOperaciones desc";
	
		$arreglo = mysql_query($query);
		//echo var_dump($query);
		return $arreglo;
	}
	function CountObtenerreporteComisiones($fechainicio,$fechafin)
	{
		$this->con->conectar();
		$scomision=0;
		$query="select a.idOperaciones,a.fechaHora,a.comision, a.idCliente, b.usuario from operacionesacciones a inner join
		usuarios b on a.idCliente=b.idUsuarios where 1 = 1 ";
	
	
		if(!empty($idCliente))
		{
			$query.="and b.usuario = ".$idCliente."";
		}
	
		if(!empty($fechainicio))
		{
			$query.=" and a.fechaHora BETWEEN '".$fechainicio."' and '".$fechafin."'";
		}
	
		$query.=" order by a.idOperaciones desc";
	
		//echo var_dump($query);
		$darreglo = mysql_query($query);

		while($arreglo = mysql_fetch_array($darreglo )){
			$scomision = $scomision + $arreglo['comision'];
		}
		
		//echo var_dump($query);
		return $scomision;
	}
}