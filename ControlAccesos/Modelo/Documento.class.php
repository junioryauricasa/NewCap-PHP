<?php
require_once 'conexion.class.php';

class Documento {
    private $identDocumento;
    private $nombre;
    private $ruta;
    private $ident006TipoDocumento;
    private $tipoDocumento;
    private $ident003Estado;
    private $estado;
    private $con;

	function __construct() {
        $this->con = new DBManager();
        $this->con->conectar();
    }
    public function getIdentDocumento() {
    	return $this->identDocumento;
    }
    public function setIdentDocumento($identDocumento) {
    	$this->identDocumento = $identDocumento;
    }
    public function getNombre() {
    	return $this->nombre;
    }
    public function setNombre($nombre) {
    	$this->nombre = $nombre;
    }
    public function getRuta() {
    	return $this->ruta;
    }
    public function setRuta($ruta) {
    	$this->ruta = $ruta;
    }
    public function getIdent006TipoDocumento() {
    	return $this->ident006TipoDocumento;
    }
    public function setIdent006TipoDocumento($ident006TipoDocumento) {
    	$this->ident006TipoDocumento = $ident006TipoDocumento;
    }
    public function getTipoDocumento() {
    	return $this->tipoDocumento;
    }
    public function setTipoDocumento($tipoDocumento) {
    	$this->tipoDocumento = $tipoDocumento;
    }
    public function getIdent003Estado() {
    	return $this->ident003Estado;
    }
    public function setIdent003Estado($ident003Estado) {
    	$this->ident003Estado = $ident003Estado;
    }
    public function getEstado() {
    	return $this->estado;
    }
    public function setEstado($estado) {
    	$this->estado = $estado;
    }

    public function obtenerDocumento($identDocumento, $ident006TipoDocumento,$ident001Estado, $inicio, $limit) {
    	$this->con->conectar();
    	$query = "select ident_documento, nombre, ruta, ident_006_tipo_documento, pat.descripcion as tipoDocumento, 
    	ident_001_estado, pae.descripcion as estado
		from documento doc inner join parametro pat on doc.ident_006_tipo_documento = pat.ident_parametro
		inner join parametro pae on pae.ident_parametro = doc.ident_001_estado
		where (ident_documento = $identDocumento or $identDocumento=0) and
    	(ident_006_tipo_documento=$ident006TipoDocumento or $ident006TipoDocumento=0) and
    	(ident_001_estado=$ident001Estado or $ident001Estado=0) ";
    			if($inicio!=-1){
    			$query .=" limit $inicio,$limit;";
    			}
    			$arreglo = mysql_query($query);
    			return $arreglo;
    }
}
?>