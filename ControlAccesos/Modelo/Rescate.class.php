<?php
require_once 'conexion.class.php';

class Rescates{

	function __construct() {
		$this->con = new DBManager();
		$this->con->conectar();
	}


	function ObtenerRescates($FechaIni,$FechaFin,$Fondo,$Usuario)
	{
		$this->con->conectar(); 
        $query="SELECT O.fecha,
                           U.usuario,
                           F.nombre,
                           O.cantidad,
                           O.castigo,
                           O.saldoactual,
                           O.idoperaciones,
                           F.idfondos,
                           UF.ncuotas,
                           O.NcuotasAgregado,
                           O.NcuotasAnterior,
                           O.NcuotasActual,
                           U.idUsuarios
                    FROM operaciones O
                    JOIN fondos F ON O.Fondos_idFondos = F.idfondos
                    JOIN usuarios U ON O.Usuarios_idUsuarios = U.idUsuarios
                    JOIN usuarios_fondos UF ON UF.Usuarios_idUsuarios = O.Usuarios_idUsuarios 
                    AND UF.Fondos_idFondos = O.Fondos_idFondos
                    WHERE O.tipo = 'RESCATE'
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

        //echo var_dump($query);
		$arreglo = mysql_query($query);
    	return $arreglo;
	}

    function EliminarRescate($idAporte)
    {
        $this->con->conectar(); 

        $query = "UPDATE operaciones SET ESTADO = 0 WHERE idoperaciones = " .$idAporte."";

        $arreglo = mysql_query($query);

        return $arreglo;    
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

    function ObtenerRescatable($idUsuario,$idFondo)
    {
        $query1 = "SELECT O.fecha,
                           U.usuario,
                           F.NOMBRE,
                           O.cantidad,
                           O.castigo,
                           UF.saldoactual,
                           O.idoperaciones,
                           F.IDFONDOS,
                           U.idUsuarios
                    FROM operaciones O
                    JOIN fondos F ON O.Fondos_idFondos = F.IDFONDOS
                    JOIN usuarios U ON O.Usuarios_idUsuarios = U.idUsuarios
                    JOIN usuarios_fondos UF ON UF.Usuarios_idUsuarios = O.Usuarios_idUsuarios 
                    AND UF.Fondos_idFondos = O.Fondos_idFondos
                    WHERE O.ESTADO = 1 
                    AND F.ESTADO = 1
                    AND U.ESTADO = 1 
                    AND UF.ESTADO = 1
                    AND F.IDFONDOS = ".$idFondo." 
                    AND U.idUsuarios = ".$idUsuario." 
                    ORDER BY O.fecha DESC 
                    LIMIT 1 ";
        $arreglo = mysql_query($query1);      
        //echo var_dump($query1);
        $Resultado = 0;
        if($arreglo)
        {
            $NumRow = mysql_num_rows($arreglo);
            
            if($NumRow >= 1)
            {
                while ( $var = mysql_fetch_array($arreglo)) {
                    $saldoactual = $var['saldoactual'];
                }
                $Resultado = $saldoactual;
            }
        }

        return $Resultado;
    }

    function AgregarRescate($idFondo,$idUsuario,$Rescate,$Castigo,$SaldoActual,$ncuotasadd)
    {
        $this->con->conectar(); 

        $queryUsuFon = "SELECT ncuotas,saldoactual
                        FROM usuarios_fondos
                        WHERE ESTADO = 1
                        AND Usuarios_idUsuarios = ".$idUsuario." 
                        AND Fondos_idFondos = ".$idFondo." 
                        LIMIT 1";          
        $arregloUsuFon = mysql_query($queryUsuFon);

        while ( $var = mysql_fetch_array($arregloUsuFon)) {
                $ncuotasFist = $var['ncuotas'];
            }

        echo var_dump($ncuotasFist);    
        $NuevoNCuotas = $ncuotasFist - $ncuotasadd; 
            
        $queryInsert = "INSERT INTO operaciones (tipo,fecha,cantidad,saldoactual,castigo
                                                    ,Fondos_idFondos,Usuarios_idUsuarios,estado,NcuotasAgregado,NcuotasAnterior,NcuotasActual)
                        VALUES ('RESCATE',NOW(),".$Rescate.",".$SaldoActual.",".$Castigo.",".$idFondo.",".$idUsuario.",1,".$ncuotasadd.",".$ncuotasFist.",".$NuevoNCuotas.")";

        mysql_query($queryInsert);

        $queryUpdate = "UPDATE usuarios_fondos SET saldoactual = ".$SaldoActual." ,
                        ncuotas = ".$NuevoNCuotas." 
                        WHERE Usuarios_idUsuarios = ".$idUsuario." 
                        AND Fondos_idFondos = ".$idFondo." ";

        mysql_query($queryUpdate);       

        return  $queryUpdate;
    }
}