<?php
require_once 'conexion.class.php';

class Aportes{

	function __construct() {
		$this->con = new DBManager();
		$this->con->conectar();
	}


	function ObtenerAportes($FechaIni,$FechaFin,$Fondo,$Usuario)
	{
		$this->con->conectar(); 
        $query="SELECT O.fecha,
                           U.usuario,
                           F.NOMBRE,
                           O.cantidad,
                           O.saldoactual,
                           O.saldoanterior,
                           O.idoperaciones,
                           F.IDFONDOS,
                           UF.ncuotas,
                           O.NcuotasAgregado,
                           O.NcuotasAnterior,
                           O.NcuotasActual,
                           U.idUsuarios
                    FROM operaciones O
                    JOIN fondos F ON O.Fondos_idFondos = F.IDFONDOS
                    JOIN usuarios U ON O.Usuarios_idUsuarios = U.idUsuarios
                    JOIN usuarios_fondos UF ON UF.Usuarios_idUsuarios = U.idUsuarios and UF.Fondos_idFondos = F.IDFONDOS
                    WHERE O.tipo = 'APORTE'
                    AND O.ESTADO = 1 
                    AND F.ESTADO = 1
                    AND U.ESTADO = 1
                    AND UF.ESTADO = 1 ";

        if(!empty($FechaIni) && !empty($FechaFin))
        {
            $query.=" AND O.fecha BETWEEN '".$FechaIni."' AND '".$FechaFin."'";
        }
        if(!empty($Fondo))
        {
            $query.=" AND F.NOMBRE LIKE '%".$Fondo."%'";
        }
        if(!empty($Usuario))
        {
            $query.=" AND U.usuario LIKE '%".$Usuario."%'";
        }

        $query.=" ORDER BY O.fecha DESC ";    

        $arreglo = "";
		$arreglo = mysql_query($query);
    	return $arreglo;
	}

    function EliminarAporte($idAporte)
    {
        $this->con->conectar(); 

        $query = "UPDATE operaciones SET ESTADO = 0 WHERE idoperaciones = " .$idAporte."";

        $arreglo = mysql_query($query);

        return $arreglo;
    }

    function AgregarAporte($idFondo,$idUsuario,$Aporte,$ncuotasadd)
    {
        $this->con->conectar(); 

        $query1 = "SELECT O.fecha,
                           U.usuario,
                           F.NOMBRE,
                           O.cantidad,
                           O.saldoactual,
                           O.saldoanterior,
                           O.idoperaciones,
                           F.IDFONDOS,
                           UF.ncuotas,
                           O.NcuotasAgregado,
                           O.NcuotasAnterior,
                           U.idUsuarios
                    FROM operaciones O
                    JOIN fondos F ON O.Fondos_idFondos = F.IDFONDOS
                    JOIN usuarios U ON O.Usuarios_idUsuarios = U.idUsuarios
                    JOIN usuarios_fondos UF ON UF.Usuarios_idUsuarios = U.idUsuarios and UF.Fondos_idFondos = F.IDFONDOS
                    WHERE 1 = 1
                    AND O.ESTADO = 1 
                    AND F.ESTADO = 1
                    AND U.ESTADO = 1
                    AND UF.ESTADO = 1
                    AND F.IDFONDOS = ".$idFondo." 
                    AND U.idUsuarios = ".$idUsuario." 
                    ORDER BY O.fecha DESC 
                    LIMIT 1";

        $queryUsuFon = "SELECT ncuotas,saldoactual
                        FROM usuarios_fondos
                        WHERE ESTADO = 1
                        AND Usuarios_idUsuarios = ".$idUsuario." 
                        AND Fondos_idFondos = ".$idFondo." 
                        LIMIT 1";         

        $arregloUsuFon = mysql_query($queryUsuFon);
        $arreglo = mysql_query($query1);

        $SalActualUsuarioFondos = 0;
        $NumRow = mysql_num_rows($arreglo);
        if($NumRow < 1)
        {
            while ( $var = mysql_fetch_array($arregloUsuFon)) {
                $ncuotasFist = $var['ncuotas'];
            }
            $NuevoNCuotas = $ncuotasFist + $ncuotasadd;   
            $queryInsert = "INSERT INTO operaciones (tipo,fecha,saldoanterior,cantidad,saldoactual
                                                    ,Fondos_idFondos,Usuarios_idUsuarios,estado,NcuotasAgregado,NcuotasAnterior,NcuotasActual)
                            VALUES ('APORTE',NOW(),0,".$Aporte.",".$Aporte.",".$idFondo.",".$idUsuario.",1,".$ncuotasadd.",".$ncuotasFist.",".$NuevoNCuotas.")";
            $SalActualUsuarioFondos = $Aporte;   
                          
        }
        else
        {
            while ( $var = mysql_fetch_array($arreglo)) {
                $cantidad = $var['cantidad'];
                $saldoactual = $var['saldoactual'];
                $saldoanterior = $var['saldoanterior'];
            }

            while ( $var = mysql_fetch_array($arregloUsuFon)) {
                $ncuotasFist = $var['ncuotas'];
            }

            $NuevoNCuotas = $ncuotasFist + $ncuotasadd;
            $NuevaCantidad = floatval($Aporte);
            $NuevoSalActual = floatval($saldoactual) + floatval($Aporte);
            $NuevoSalAnterior = floatval($saldoactual);
            $SalActualUsuarioFondos = $NuevoSalActual;
            $queryInsert = "INSERT INTO operaciones (tipo,fecha,saldoanterior,cantidad,saldoactual
                                                            ,Fondos_idFondos,Usuarios_idUsuarios,estado,NcuotasAgregado,NcuotasAnterior,NcuotasActual)
                            VALUES ('APORTE',NOW(),".$NuevoSalAnterior.",".$NuevaCantidad.",".$NuevoSalActual."
                                    ,".$idFondo.",".$idUsuario.",1,".$ncuotasadd.",".$ncuotasFist.",".$NuevoNCuotas.")";
            
        }
        echo var_dump($queryInsert);
        mysql_query($queryInsert);

        $queryUpdate = "UPDATE usuarios_fondos 
                        SET saldoactual = ".$SalActualUsuarioFondos.",
                        ncuotas = ".$NuevoNCuotas." 
                        WHERE Usuarios_idUsuarios = ".$idUsuario." 
                        AND Fondos_idFondos = ".$idFondo." ";
        mysql_query($queryUpdate);
        return  "";
    }

    function ObtenerFondos($idUsuario)
    {
        $query="SELECT F.idFondos, F.nombre FROM fondos F 
            JOIN usuarios_fondos UF ON UF.Fondos_idFondos = F.idFondos 
            WHERE UF.Usuarios_idUsuarios = ".$idUsuario." AND UF.estado = 1";
        //echo var_dump($dni);

        $arreglo = mysql_query($query);
        return $arreglo;
    }
}