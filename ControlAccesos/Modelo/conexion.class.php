<?php
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 'On');

class DBManager {

    var $conect;
    var $BaseDatos;
    var $Servidor;
    var $Usuario;
    var $Clave;

    function DBManager() {
        $this->BaseDatos = "db_newcapital";
        $this->Servidor = "localhost";
        $this->Usuario = "root";
        $this->Clave = "";
    }
    
    function conectar() {
        if (!($con = @mysql_connect($this->Servidor, $this->Usuario, $this->Clave))) {
            echo"<h1> [:(] Error al conectar a la base de datos</h1>".$this->BaseDatos." ".$this->Servidor." ".$this->Usuario." ".$this->Clave;
            exit();
        }
        if (!@mysql_select_db($this->BaseDatos, $con)) {
            echo "<h1> [:(] Error al seleccionar la base de datos</h1>";
            exit();
        }
        $this->conect = $con;
        return true;
    }

    function conectarSQL() {
        $conn = mssql_connect("Sandy-PC","sandy","sandy") or die(mssql_get_last_message());
        mssql_select_db("NcfFondosMutuosWeb",$conn)or die(mssql_error());
        return true;
    }
    
}

?>
