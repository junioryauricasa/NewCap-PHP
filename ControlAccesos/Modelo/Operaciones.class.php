<?php
require_once 'conexion.class.php';

class Operaciones{
	
	function __construct() {
		$this->con = new DBManager();
		$this->con->conectar();
	}
	function AgregarOperacion($idUsuario,$Tipo,$Monto)
    {
        $this->con->conectar(); 
		
		$query1 = "select * from estadocuenta where idCliente = ".$idUsuario;
		$arregloSaldo = mysql_query($query1);
		$var = mysql_fetch_array($arregloSaldo);
        $SaldoActual = $var['saldoActual'];
		
		if($Tipo=='D'){
			
		$NuevoSaldo = $SaldoActual+$Monto;
		
		//Actualizar Saldo
		
		$ActualizarSaldo = "UPDATE estadocuenta SET saldoActual = '".$NuevoSaldo."' WHERE idCliente = '".$idUsuario."'";
						
		mysql_query($ActualizarSaldo);		

		//Grabar historial
		
		$queryInsert = "INSERT INTO historialoperaciones (fechaHora,idUsuarios,TipoOperacion,montoEjecutado,saldoAnterior,nuevoSaldo,estado)
                            VALUES (NOW(),".$idUsuario.",'D',".$Monto.",".$SaldoActual.",".$NuevoSaldo.",1)";
							
		mysql_query($queryInsert);	
		//Registrar actividad
		$hoy = date("Y-m-d");
		$queryInsert = "INSERT INTO operacionesacciones (fechaHora,idActivo,idCliente,tipoOperacion,cantidad,preciou,precio,comision,saldoFinal,estado,fechaCarga)
                            VALUES (NOW(),18,".$idUsuario.",'D',1,".$Monto.",0,0,".$NuevoSaldo.",1,$hoy)";
		
		mysql_query($queryInsert);		
		}else if($Tipo="R"){
			$NuevoSaldo = $SaldoActual-$Monto;
			if($NuevoSaldo>0){
				
				//Actualizar Saldo
				
				$ActualizarSaldo = "UPDATE estadocuenta SET saldoActual = '".$NuevoSaldo."' WHERE idCliente = '".$idUsuario."'";
				
				mysql_query($ActualizarSaldo);
				
				//Grabar historial
				
				$queryInsert = "INSERT INTO historialoperaciones (fechaHora,idUsuarios,TipoOperacion,montoEjecutado,saldoAnterior,nuevoSaldo,estado)
                            VALUES (NOW(),".$idUsuario.",'R',".$Monto.",".$SaldoActual.",".$NuevoSaldo.",1)";
					
				mysql_query($queryInsert);
				//Registrar actividad
				
				$queryInsert = "INSERT INTO operacionesacciones (fechaHora,idActivo,idCliente,tipoOperacion,cantidad,precio,saldoFinal,estado)
                            VALUES (NOW(),19,".$idUsuario.",'R',1,".$Monto.",".$NuevoSaldo.",1)";
				
				mysql_query($queryInsert);
				
			}
			
			
		}
		return  "";
	}	
	function ObtenerOperaciones($FechaIni,$FechaFin,$Fondo,$Usuario)
	{
		$this->con->conectar();
		$query="SELECT a.idHistorialoperaciones,
						a.fechaHora,
						b.usuario,
						a.TipoOperacion,
						a.montoEjecutado,
						a.saldoAnterior,
						a.nuevoSaldo from historialoperaciones a join usuarios b on a.idUsuarios = b.idUsuarios where a.estado = 1 ";
	
		if(!empty($FechaIni) && !empty($FechaFin))
		{
			$query.=" AND a.fechaHora BETWEEN '".$FechaIni."' AND '".$FechaFin."'";
		}
		if(!empty($Tipo))
		{
			$query.=" AND a.tipoOperacion LIKE '%".$Tipo."%'";
		}
		if(!empty($Usuario))
		{
			$query.=" AND b.idUsuarios LIKE '%".$Usuario."%'";
		}
	
		$query.=" ORDER BY a.fechaHora DESC ";
	
		$arreglo = "";
		$arreglo = mysql_query($query);
		return $arreglo;
	}
	function ObtenerOperacionesActuales($FechaIni,$FechaFin,$Fondo,$Usuario)
	{
		$this->con->conectar();
		$query="SELECT a.idOperaciones,
						a.fechaHora,
						b.usuario,
						a.TipoOperacion,
						c.descripcion,
						a.cantidad,
						a.precio,
						a.preciou,
						a.comision,
						a.saldoFinal from operacionesacciones a join usuarios b on a.idCliente = b.idUsuarios 
				join activo c on c.idActivo = a.idActivo
				where a.estado = 1  ";
	
		if(!empty($FechaIni) && !empty($FechaFin))
		{
			$query.=" AND a.fechaHora BETWEEN '".$FechaIni."' AND '".$FechaFin."'";
		}
		if(!empty($Tipo))
		{
			$query.=" AND a.tipoOperacion LIKE '%".$Tipo."%'";
		}
		if(!empty($Usuario))
		{
			$query.=" AND a.idCliente = '".$Usuario."'";
		}

		$query.=" ORDER BY a.idOperaciones DESC ";
	
		$arreglo = "";
		$arreglo = mysql_query($query);
		return $arreglo;
	}
	function ObtenerSaldoActual($idUsuario){
		$query="SELECT idEstadoCuenta,idCliente,saldoActual FROM estadocuenta
            WHERE idCliente = $idUsuario";
		//echo var_dump($dni);
		
		$arreglo = mysql_query($query);
		return $arreglo;
		
	}
	function EliminarOperacion($idAporte)
	{
		$this->con->conectar();
	
		$query = "UPDATE historialoperaciones SET ESTADO = 0 WHERE idHistorialoperaciones = " .$idAporte."";
	
		$arreglo = mysql_query($query);
	
		return $arreglo;
	}
	
}